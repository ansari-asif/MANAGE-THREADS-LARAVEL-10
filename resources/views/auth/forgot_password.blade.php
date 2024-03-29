@extends('layout.auth')
@section('title')
    Forgot Password 
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
                        Forgot Password
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('forgot_password_submit')}}">
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
                            <button type="submit" class="btn btn-primary">Forgot</button>
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