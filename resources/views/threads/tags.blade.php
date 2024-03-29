@extends('layout.dashboard')
@section('title')
    Thread Tags 
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <a href="{{ route('add_threads_tags') }}" class="btn btn-md btn-danger mb-3">Add Tag</a>
                <div class="card">
                    <div class="card-header">
                        Threads Tags List:
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
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($tags as $key=>$tag)
                                <tr>
                                    <td scope="row">{{$key+1}}</td>
                                    <td>{{$tag['title']}}</td>
                                    <td>
                                        @if ($tag['title'])
                                            Active
                                        @else
                                            Deactive
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('edit_threads_tags', ['id'=>$tag['id']]) }}" class="btn btn-sm btn-primary">Edit</a>
                                        <a href="{{ route('delete_threads_tags', $tag['id']) }}" class="btn btn-sm btn-danger">Delete</a>
                                    </td>
                                </tr>    
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-danger text-center">There is no tags.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer text-muted">
                        Footer
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection