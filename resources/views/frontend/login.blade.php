@extends('frontend.layout.app')

@section('title')

Login page

@endsection

@section('content')

<div class="login-container">
        <h1>Welcome To Login Page</h1>
        <form action="/authenticate" method="POST">
            @csrf
            <input type="text" id="email" name="email" placeholder="Email" required>
            <input type="password" id="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <a href="/register" class="signup-link">Don't have an account? Sign up</a>
    </div>
@endsection