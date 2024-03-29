@extends('layout.auth')
@section('title')
    Login 
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="offset-md-3 col-md-6">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        Login
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('login_submit')}}">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input type="email" class="form-control" name="email"  placeholder="Enter email" value="{{ old('email')}}">    
                                <small class="text-danger">
                                    @error('email')
                                    {{ $message}}
                                    @enderror
                                </small>                          
                            </div>
                            <div class="form-group">
                              <label for="exampleInputPassword1">Password</label>
                              <input type="password" class="form-control" name="password" placeholder="Password" value="{{ old('password')}}">
                                <small class="text-danger">
                                    @error('password')
                                    {{ $message}}
                                    @enderror
                                </small>
                            </div>
                            <button type="submit" class="btn btn-primary">Login</button>
                          </form>
                          <div class="mt-3">
                            <p><a href="{{ route('register') }}">Create a new account </a></p>
                            <p><a href="{{ route('forgot_password') }}">Forgot password </a></p>
                          </div>
                    </div>
                    <div class="card-footer text-muted">
                        Footer
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection