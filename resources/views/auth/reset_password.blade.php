@extends('layout.auth')
@section('title')
    Reset Password 
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
                        Reset Password
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('password.update')}}">
                            @csrf
                            
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
                            <input type="hidden" name="token" value="{{ $token }}">
                            <input type="hidden" name="email" value="{{ $email }}">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Reset Password') }}
                            </button>
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