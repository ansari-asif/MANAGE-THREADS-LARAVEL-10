<?php

namespace App\Http\Controllers;

use App\Models\Thread_comment;
use App\Models\Thread_like;
use App\Models\Threads;
use App\Models\ThreadsTags;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Spatie\FlareClient\View;

class ThreadsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $req)
    {
    
        $tagId=$req->has('tag')?$req->tag:null;
        // echo $tagId;die;
        // $threads=Threads::orderBy('created_at','desc')->get();
        $threads=Threads::when($tagId, function ($query) use ($tagId) {
                $query->whereHas('tags', function ($query) use ($tagId) {
                    $query->where('thread_tags_map.tag_id', $tagId);
                });
            })
            ->orderBy('created_at', 'desc')
            ->get();
        $tags=ThreadsTags::all();
        $user=Auth::user();
        $data=[
            "threads"=>$threads,
            "tags"=>$tags,
            "tag_id"=>$tagId,
            "user"=>$user
        ];
        return view('threads.threads',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $tags=ThreadsTags::all();
        $data['tags']=$tags;
        return view('threads.add_threads',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validator=Validator::make($request->all(),[
            "title"=>"required|min:3",
            "description"=>"required|min:3",
        ]);
        
        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }
        // dd(Auth::user()['id']);
        $validated_data=$validator->validated();
        $validated_data['user_id']=Auth::id();
        $thread=Threads::create($validated_data);
        if($request->has('tags')) {
            $thread->tags()->attach($request->tags);
        }
        return redirect()->route('threads')->with('success', "Thread added successfully.");
    }

    /**
     * Display the specified resource.
     */
    public function show(Threads $threads)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $threads=Threads::find($id);
        
        $threads_tags=$threads->tags->pluck('id')->toArray();
        $data['tags']=ThreadsTags::all();
        $data['threads']=$threads;
        $data['threads_tags']=$threads_tags;
        return view('threads.edit_thread',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $validator=Validator::make($request->all(),[
            "title"=>"required|min:3",
            "description"=>"required|min:3",
        ]);
        
        
        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }
        $threads=Threads::find($id);
        $validated_data=$validator->validated();
        $threads->update($validated_data);

        if ($request->has('tags')) {
            $threads->tags()->sync($request->tags);
        } else {
            $threads->tags()->detach(); // Remove all tags if none provided
        }
        return redirect()->route('threads')->with('success', 'Thread updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $thread = Threads::findOrFail($id);
        $thread->delete();
        return redirect()->route('threads')->with('success', 'Thread deleted successfully.');
    }

    function thread_like(Request $req){
        $thread_id=$req->get('thread_id');
        $user_id=Auth::id();
        
        $response=[
            "status"=>false,
            "message"=>""
        ];
        if($thread_id && $user_id){
            $existingLike=Thread_like::where('thread_id',$thread_id)
                                        ->where('user_id',$user_id)
                                        ->first();
            // dd($existingLike);
            if($existingLike){
                $existingLike->delete();
                $response=[
                    "status"=>true,
                    "message"=>"Thread Unliked successfully."
                ];
            }else{
                $like=new Thread_like();
                $like->thread_id = $thread_id;
                $like->user_id = $user_id;
                $like->save();
                $response=[
                    "status"=>true,
                    "message"=>"Thread Liked successfully."
                ];
            }
        }else{
            $response=[
                "status"=>false,
                "message"=>"Invalid parameters."
            ];
        }
        return response()->json($response);
    }

    function thread_comment(Request $req){
        $thread_id=$req->get('thread_id');
        $comment=$req->get('comment');
        $user_id=Auth::id();
        $response=[
            "status"=>false,
            "message"=>""
        ];
        if($thread_id && $user_id && $comment){
            $commentModel=new Thread_comment();
            $commentModel->thread_id=$thread_id;       
            $commentModel->comment=$comment;       
            $commentModel->user_id=$user_id;
            $commentModel->save();   
            return redirect()->route('threads')->with("message","Comment added successfully");   
        }else{
            return redirect()->route('threads')->with("message","invalid parameter.");   
        }
    }
}
