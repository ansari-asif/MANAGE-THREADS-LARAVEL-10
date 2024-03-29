@extends('layout.dashboard')
@section('title')
    Edit Thread Tags 
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <a href="{{ route('threads_tags') }}" class="btn btn-md btn-danger mb-3">Tag List</a>
                <div class="card">
                    <div class="card-header">
                        Edit Thread Tag:
                    </div>
                    <div class="card-body">
                        <form action="{{ route('update_threads_tags',$tag->id) }}" method="post">
                            @csrf
                            @method('put')
                            <div class="form-group">
                              <label for="">Title</label>
                              <input type="text" name="title" id="title" class="form-control" placeholder="Enter Tag Title" aria-describedby="helpId" value="{{$tag->title}}">
                              @error('title')
                              <small id="helpId" class="text-danger">{{$message}} </small>
                              @enderror
                            </div>
                            <button type="submit" class="btn btn-md btn-success">Update Tag</button>
                        </form>
                    </div>
                    <div class="card-footer text-muted">
                        Footer
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection