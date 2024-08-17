@extends('frontend.layout.app')

@section('title')

Profile

@endsection

@section('content')

{{ auth()->user()->email }}

    <div class="profile-container">
        <div class="profile-header">
            <img src="default-profile.jpg" alt="Profile Image" id="profileImage">
            <div>
                <label for="fileInput">Browse</label>
                <input type="file" id="fileInput" accept="image/*" onchange="previewImage(event)">
            </div>
        </div>

        <div class="profile-details">
            <label for="name">Name:</label>
            <input type="text" id="name" placeholder="John Doe">

            <label for="phone">Phone Number:</label>
            <input type="text" id="phone" placeholder="+1234567890">

            <label for="email">Email:</label>
            <input type="email" id="email" placeholder="johndoe@example.com">

            <label for="address">Address:</label>
            <textarea id="address" rows="4" placeholder="123 Main Street, Anytown, USA"></textarea>
        </div>

        <div class="profile-footer">
            <button type="button">Save Changes</button>
        </div>
    </div>
    <h1>welcome to profile page</h1>

{{ auth()->user()->email }}

<a href="/logout">logout</a>

    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('profileImage').src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        }

@endsection
