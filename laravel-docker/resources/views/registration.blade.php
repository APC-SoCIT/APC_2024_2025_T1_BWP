@extends('layouts.layout')

@push('css')
    <link href="{{ asset('css/registration.css') }}" rel="stylesheet">
@endpush

@section('content')
<div id="shadow"></div>
<div id="centered-container">
    <img id="logo" src="{{ asset('favicon.ico') }}" alt="Logo">
    <form id="registration" action="{{ route('registration.post') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
        </div>

        <div class="mb-3 account-type-options">
            <label class="form-label">Account Type</label><br>
            <div class="account-type-option">
                <input type="radio" id="member" name="account_type" value="member" required>
                <label for="member">Member</label>
            </div>
            <div class="account-type-option">
                <input type="radio" id="admin" name="account_type" value="admin">
                <label for="admin">Admin</label>
            </div>
        </div>

        <button type="submit" class="btn btn-success">
            <svg xmlns="http://www.w3.org/2000/svg" height="30px" viewBox="0 0 512 512">
                <style>svg{fill:#ffffff}</style>
                <path d="M217.9 105.9L340.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L217.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1L32 320c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM352 416l64 0c17.7 0 32-14.3 32-32l0-256c0-17.7-14.3-32-32-32l-64 0c-17.7 0-32-14.3-32-32s14.3-32 32-32l64 0c53 0 96 43 96 96l0 256c0 53-43 96-96 96l-64 0c-17.7 0-32-14.3-32-32s14.3-32 32-32z"/>
            </svg>
            Register
        </button>

        <div class="mt-3">
            <p>Already have an account? <a href="{{ route('login') }}" class="login-link">Login</a></p>
        </div>
    </form>
</div>
@endsection

@push('script')
@endpush