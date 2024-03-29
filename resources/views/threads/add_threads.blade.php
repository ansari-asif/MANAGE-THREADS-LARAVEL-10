@extends('layout.dashboard')
@section('title')
    Add Thread 
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <a href="{{ route('threads') }}" class="btn btn-md btn-danger mb-3">Threads List</a>
                <div class="card">
                    <div class="card-header">
                        Add Thread:
                    </div>
                    <div class="card-body">
                        <form action="{{ route('add_thread_submit') }}" method="post">
                            @csrf
                            <div class="form-group">
                              <label for="">Title</label>
                              <input type="text" name="title" id="title" class="form-control" placeholder="Enter Title" aria-describedby="helpId" value="{{old('title')}}">
                              @error('title')
                              <small id="helpId" class="text-danger">{{$message}} </small>
                              @enderror
                            </div>
                            <div class="form-group">
                              <label for="">Description</label>
                              <textarea class="form-control" name="description" id="description" rows="3" placeholder="Enter Description">{{old('description')}}</textarea>
                              @error('description')
                                <small class="text-danger">{{$message}} </small>
                              @enderror
                            </div>
                            <div class="form-group">
                              <label for="">Select Tags</label>
                              <select class="form-control multi_select" multiple data-live-search="true" name="tags[]" id="tag">
                                <option value="">Select Tag</option>
                                @foreach ($tags as $tag)
                                    <option value="{{$tag['id']}}">{{$tag['title']}}</option>
                                @endforeach
                              </select>
                            </div>
                            <button type="submit" class="btn btn-md btn-success">Add Thread</button>
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