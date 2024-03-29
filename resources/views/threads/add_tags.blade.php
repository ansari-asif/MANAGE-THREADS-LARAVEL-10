@extends('layout.dashboard')
@section('title')
    Add Thread Tags 
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <a href="{{ route('threads_tags') }}" class="btn btn-md btn-danger mb-3">Tag List</a>
                <div class="card">
                    <div class="card-header">
                        Add Thread Tag:
                    </div>
                    <div class="card-body">
                        <form action="{{ route('add_threads_tags_submit') }}" method="post">
                            @csrf
                            <div class="form-group">
                              <label for="">Title</label>
                              <input type="text" name="title" id="title" class="form-control" placeholder="Enter Tag Title" aria-describedby="helpId" value="{{old('title')}}">
                              @error('title')
                              <small id="helpId" class="text-danger">{{$message}} </small>
                              @enderror
                            </div>
                            <button type="submit" class="btn btn-md btn-success">Add Tag</button>
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