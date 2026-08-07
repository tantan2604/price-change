@extends('layouts.app')

@section('title', 'Login page')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center vh-100">
        <div class="col-md-5">

            <div class="card shadow">
                <div class="card-body p-5">

                    <h3 class="text-center mb-4">Login</h3>

                    <form method="POST" action="{{ route('login.process') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="user_name" class="form-label">
                                User name
                            </label>

                            <input
                                type="name"
                                class="form-control"
                                id="user_name"
                                name="user_name"
                                placeholder="Enter user your name"
                                value="{{ old('user_name') }}"
                                required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">
                                Password
                            </label>

                            <input
                                type="password"
                                class="form-control"
                                id="password"
                                name="password"
                                placeholder="Enter password"
                                required>
                        </div>

                        <div class="mb-3 form-check">
                            <input
                                type="checkbox"
                                class="form-check-input"
                                id="remember">

                            <label class="form-check-label" for="remember">
                                Remember me
                            </label>
                        </div>
                        @if(session('login_error'))
                        <div class="alert alert-danger">
                            {{ session('login_error') }}
                        </div>
                        @endif
                        <button type="submit" class="btn btn-primary w-100">
                            Login
                        </button>


                    </form>

                    <div class="text-center mt-3">
                        <a href="#" class="text-decoration-none">
                            Forgot password?
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

@endsection