<style>
    .headline{
        font-size: 24px;
        text-align: center;
    }
    .headline_intro{
        color: #000;
        margin-top: 10px;
        text-align: center;
        margin-bottom: 20px;
    }
    .tagsWrapper{
        margin-top: 10px;
        padding: 22px;
        background: linear-gradient(151deg, rgb(121, 161, 255) 0%, rgb(82, 97, 198) 35%, rgb(56, 73, 230) 100%);
        margin-bottom: 15px;
        border-radius: 12px;
    }
    .eachTag {
        color: #fff;
        border: 1px solid #d9d9d9;
        border-radius: 10px;
        font-size: 14px;
        padding: 2px 10px;
        margin-right: 5px;
    }
    .eachTag:hover{
        color: #fff;
        background: rgba(0, 0, 0, 0.08);
        text-decoration: none;
    }
    .eachTag.active{
        background: rgb(0 0 0 / 24%);
    }
    .threadCardHeader {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .avatar {
        background: #6e7072;
        width: 45px;
        height: 45px;
        border-radius: 16px;
        display: flex;
        justify-content: center;
        align-items: center;
        color: #fff;
        font-size: 24px;
    }
    .thread_title_user_time_wrapper {
        display: flex;
        flex-direction: column;
    }
    .threadTitle{
        margin-bottom: 0px;
    }
    .threadTitle {
        margin-bottom: 3px;
        font-size: 18px;
        color: #000;
        font-weight: 500;
    }
    .thread_user_time_stamp {
        font-size: 14px;
        color: #444343;
    }
    .likes_commentWrapper {
        display: flex;
        gap: 20px;
        align-items: center;
    }
    .likes_commentWrapper a:hover{
        text-decoration: none;
    }
    .commentWrapper{
        display: flex;
        gap: 5px;
        margin: 10px 0px;
    }
</style>
@extends('layout.dashboard')
@section('title')
    Thread 
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <h1 class="headline">Welcome to Opus-Hub</h1>
                <p class="headline_intro">Opus Hub functions as a community platform where students can pose questions to their peers and mentors, receiving responses in the form of replies. This setup promotes collaborative learning and facilitates the sharing of knowledge among participants.</p>
                <a href="{{ route('add_threads') }}" class="btn btn-md btn-primary mb-3">Ask Question</a>
                <div class="tagsWrapper">
                    <div>
                        <a href="{{ route('threads') }}" class="eachTag @if (!$tag_id)
                            active
                        @endif">ALL THREADS</a>
                        @foreach ($tags as $tag)
                            <a href="{{ route('threads', ['tag'=>$tag->id]) }}" class="eachTag @if ($tag_id==$tag->id)
                                active
                            @endif">{{$tag['title']}} </a>
                        @endforeach
                    </div>
                </div>
                {{-- <div class="card">
                    <div class="card-header">
                        
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                          <strong> {{session('success')}}</strong> 
                        </div>
                        @endif
                        
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Sr. No</th>
                                    <th>Title</th>
                                    <th>Tags</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($threads as $key=>$thread)
                                <tr>
                                    <td scope="row">{{$key+1}}</td>
                                    <td>{{$thread['title']}}</td>
                                    <td>
                                        <ul>
                                            @foreach ($thread['tags'] as $tag)
                                            <li>{{$tag['title']}} </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>
                                        <a href="{{ route('edit_thread', ['id'=>$thread['id']]) }}" class="btn btn-sm btn-primary">Edit</a>
                                        <a href="{{ route('delete_thread', $thread['id']) }}" class="btn btn-sm btn-danger">Delete</a>
                                    </td>
                                </tr>    
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-danger text-center">There is no threads.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer text-muted">
                        Footer
                    </div>
                </div> --}}
                @forelse ($threads as $thread)
                <div class="card mb-3">
                    <div class="card-header threadCardHeader">
                        <div class="avatar">
                            <span>{{$thread['user']->name[0]}} </span>
                        </div>
                        <div class="thread_title_user_time_wrapper">
                            <p class="threadTitle">{{$thread['title']}} </p>
                            <div class="thread_user_time_stamp">
                                <span>By {{$thread['user']->name}}</span>
                                <span>|</span>
                                <span>Updated {{$thread->updated_at->format("d-M-Y h:i A")}} </span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <p>{{$thread['description']}} </p>
                    </div>
                    <div class="card-footer text-muted">
                        <div class="likes_commentWrapper">                            
                            <a href="javascript:void(0)" class="thread_like" data-id={{$thread['id']}}>
                                
                                @if ($user->likedThreads->contains($thread))
                                <i class="fa fa-heart text-danger" aria-hidden="true"></i>
                                @else
                                <i class="fa fa-heart-o" aria-hidden="true"></i>
                                @endif
                                
                                <span>{{count($thread->likes)}} </span>
                            </a>
                            <a href="javascript:void(0)">
                                <i class="fa fa-comment-o" aria-hidden="true"></i>
                                <span>{{count($thread->comments)}} </span>
                            </a>
                        </div>
                        <div>
                            <form action="{{ route('thread_comment') }}" method="POST">
                                @csrf
                                <div class="commentWrapper">
                                    <input type="hidden" name="thread_id" value="{{$thread['id']}}">
                                    <input type="text" name="comment" id="" class="form-control" placeholder="Add New Comment">
                                    <button class="btn btn-primary btn-md"><i class="fa fa-paper-plane" ></i></button>
                                </div>
                            </form>
                        </div>
                        <div>
                            <ul>
                                @foreach ($thread->comments()->latest()->take(2)->get() as $comment)
                                    <li>
                                        <span>{{$comment->pivot->comment}}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                @empty
                
                    <h6 class="text-center text-danger mt-4">There is no thread for now.</h6>
                @endforelse
                
            </div>
        </div>
    </div>
    
    <script>
        
        $( document ).ready(function() {
            $(document).on('click','.thread_like',function(e){
                e.preventDefault();
                var $el=$(this);
                var thread_id=$el.data('id');
                if(thread_id){
                    $.ajax({
                        url:"{{ route('threads_like') }}",
                        method:"POST",
                        dataType:"json",
                        data:{thread_id:thread_id,_token:'{{ csrf_token() }}'},
                        success:function(data){
                            if(data.status){
                                swal({
                                    title: "Success!", 
                                    text: data.message, 
                                    type: "success"
                                    },
                                    function(){
                                        window.location.reload();
                                    }
                                );
                            }else{
                                swal({
                                    title: "Error", 
                                    text: data.message, 
                                    type: "error"
                                    },
                                    function(){
                                        window.location.reload();
                                    }
                                );
                            }
                        }
                    })
                }
            });
        });
    </script>
@endsection