@extends('layout.dashboard')

@section('title')
    Dashboard
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header">
                        Dashboard
                    </div>
                    <div class="card-body">
                        <h4 class="card-title">My Profile</h4>
                        <strong>Welcome {{ Auth::User()->name }},</strong>
                        <p>Name: {{ Auth::User()->name }}</p>
                        <p>Email: {{ Auth::User()->email }}</p>
                        <p>Phone: {{ Auth::User()->phone }}</p>
                        <p>User Type: {{ Auth::User()->user_type }}</p>
        
                    </div>
                    <div class="card-footer text-muted">
                        Footer
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection