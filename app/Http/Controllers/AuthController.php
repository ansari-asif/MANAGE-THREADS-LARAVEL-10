<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator ;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{
    
    function register(Request $req){
        // dd($req->user()->name);
        return view('auth.register');
    }

    function register_submit(Request $req){
        $validator=Validator::make($req->all(),[
            "name"=>"required|string|max:255",
            "email"=>"required|email",
            "phone"=>"required|string|max:255",
            "password"=>"required|string|min:4|confirmed",
        ]);
        // dd($validator);
        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }
        $post_data=[
            "name"=>$req->name,
            "email"=>$req->email,
            "phone"=>$req->phone,
            "password"=>Hash::make($req->password),
        ];
        $user=User::create($post_data);
        Auth::login($user);
        return redirect('/');
        // return redirect()->intended()
    }
    function login(Request $req){
        // dd($req->user()->name);
        return view('auth.login');
    }

    function login_submit(Request $req){
        $validator=Validator::make($req->all(),[
            "email"=>"required|email",
            "password"=>"required|string|min:4",
        ]);
        // dd($req->all());
        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }
        $credentials = $req->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect('/');
        } 
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    function logout(){
        Auth::logout();
        return redirect('/login');
    }

    function forgot_password(){
        return view('auth/forgot_password');
    }

    function forgot_password_submit(Request $req){
        $post_data=$req->all();
        $req->validate([
            "email" => "required|email",
        ]);
        $status=Password::sendResetLink($req->only('email'));
        // dd($status);
        return $status === Password::RESET_LINK_SENT
                ? back()->with(['status' => __($status)])
                : back()->withErrors(['email' => __($status)]);
    }

    function reset_password(Request $req,$token){
        // dd($req->email);
        $email=$req->email;
        // echo $email;die;
        return view('auth/reset_password',[
            'token' => $token,
            'email' => $email,
        ]);
    }

    function reset_password_submit(Request $req){
        $req->validate([
            "token"=>"required",
            "email"=>"required|email",
            "password"=>"required|min:6|confirmed",
        ]);
        // dd($req->all());
        $status = Password::reset(
            $req->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ]);
     
                $user->save();
     
                event(new PasswordReset($user));
            }
        );
        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }
}


