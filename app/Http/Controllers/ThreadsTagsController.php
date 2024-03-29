<?php

namespace App\Http\Controllers;

use App\Models\ThreadsTags;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ThreadsTagsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data=[];
        $tags=ThreadsTags::all();
        $data['tags']=$tags;
        return view('threads/tags',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('threads/add_tags');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validator=Validator::make($request->all(),[
            "title" =>"required|min:4",
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $post_data=$request->all();
        ThreadsTags::create([
            "title" => $post_data['title'],
            "status"=>1
        ]);
        return redirect('/thread-tags')->with("success","Thread tag successfully created.");
    }

    /**
     * Display the specified resource.
     */
    public function show(ThreadsTags $threadsTags)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $tag=ThreadsTags::find($id);
        
        return view('threads.edit_tags',["tag"=>$tag]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $threadsTags=ThreadsTags::find($id);
        $post_data=$request->all();
        $threadsTags->update($post_data);
        return redirect()->route('threads_tags')->with("success","Thread tag successfully updated.");
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $threadsTags=ThreadsTags::find($id);
        $threadsTags->delete();
        return redirect()->route('threads_tags')->with('success','Thread tag Deleted successfully.');
    }
}
