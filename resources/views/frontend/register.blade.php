@extends('frontend.layout.app')

@section('title')

Register page

@endsection

@section('content')

<div class="container">
        <h1>Register</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- registered successfully -->
        <!-- Check if a success message exists in the session and display it -->
        @if (Session::has('success_message'))
            <div class="alert alert-success">
                {{ Session::get('success_message') }}
            </div>
        @endif

        <form id="registrationForm" action="/store" method="post">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name">
                <div class="error" id="nameError"></div>
            </div>
            <div class="form-group">
                <label>Gender</label>
                <label><input type="radio" name="gender" value="male"> Male</label>
                <label><input type="radio" name="gender" value="female"> Female</label>
                <div class="error" id="genderError"></div>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email">
                <div class="error" id="emailError"></div>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password">
                <div class="error" id="passwordError"></div>
            </div>
            <div class="form-group">
                <label for="confirmPassword">Confirm Password</label>
                <input type="password" id="confirmPassword" name="confirmPassword">
                <div class="error" id="confirmPasswordError"></div>
            </div>
            <div class="form-group">
                <label for="phone">Phone No</label>
                <input type="text" id="phone" name="phone">
                <div class="error" id="phoneError"></div>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" id="address" name="address">
                <div class="error" id="addressError"></div>
            </div>
            <div class="form-group">
                <label for="pincode">Pincode</label>
                <input type="text" id="pincode" name="pincode">
                <div class="error" id="pincodeError"></div>
            </div>
            <div class="form-group">
                <label for="country">Country</label>
                <select id="country" name="country">
                    <option value="">Select Country</option>
                    <option value="In">India</option>
                    <option value="us">United States</option>
                    <option value="uk">United Kingdom</option>
                    <option value="ca">Canada</option>
                    <!-- Add more countries as needed -->
                </select>
                <div class="error" id="countryError"></div>
            </div>
            <div class="form-group">
                <label for="state">Country</label>
                <select id="state" name="state">
                    <option value="">Select state</option>
                    <option value="Tn">Tamil Nadu</option>
                    <option value="kr">Kerala</option>
                    <option value="kn">Karnataka</option>
                    <!-- Add more countries as needed -->
                </select>
                <div class="error" id="countryError"></div>
            </div>
            <div class="form-group">
                <label for="captcha">Captcha</label>
                <div class="captcha">
                    <input type="text" id="captcha" name="captcha">
                    <img src="captcha.jpg" alt="Captcha">
                </div>
                <div class="error" id="captchaError"></div>
            </div>
            <button type="submit">Register</button>
        </form>
        <a href="/login">Already have an account? Login</a>
    </div>
@endsection

