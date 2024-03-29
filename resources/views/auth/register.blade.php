@extends('layout.auth')
@section('title')
    Register 
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
                        Register
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('register_submit')}}">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name:</label>
                                <input type="text" class="form-control" name="name" placeholder="Enter Name" value="{{ old('name')}}">       
                                <small class="text-danger">
                                    @error('name')
                                    {{ $message}}
                                    @enderror
                                </small>                       
                            </div>
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
                                <label for="exampleInputEmail1">Phone:</label>
                                <input type="number" class="form-control" name="phone" placeholder="Enter phone" value="{{ old('phone')}}">    
                                <small class="text-danger">
                                    @error('phone')
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
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" class="form-control" name="password_confirmation" placeholder="confirmed Password" value="{{ old('password_confirmation')}}">
                                  <small class="text-danger">
                                      @error('password_confirmation')
                                      {{ $message}}
                                      @enderror
                                  </small>
                            </div>                            
                            <button type="submit" class="btn btn-primary">Register</button>
                          </form>
                          <div class="mt-3">
                            <a href="{{ route('login') }}">Already register user ? please Login  </a>
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