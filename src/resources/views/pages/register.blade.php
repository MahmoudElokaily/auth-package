@extends("auth::index")
@section("content")
    <div class="container">
        <div class="form-container" id="signup-form">
            <h1>Sign Up</h1>
            <form action="{{route('auth.store')}}" method="post">
                @csrf
                <label for="new-name">Name</label>
                <input type="text" id="new-name" name="name" required>
                <label for="new-username">Username</label>
                <input type="text" id="new-username" name="username" required>
                <label for="new-email">Email</label>
                <input type="email" id="new-email" name="email" required>
                <label for="phone_number">Phone Number</label>
                <input type="text" id="phone_number" name="phone_number" required>
                <label for="new-password">Password</label>
                <input type="password" id="new-password" name="password" required>
                <label for="confirm-password">Confirm Password</label>
                <input type="password" id="confirm-password" name="password_confirmation" required>
                <button type="submit">Sign Up</button>
            </form>
            <p>Already have an account? <a href="{{route('auth.login')}}" id="login-link">Login</a></p>
        </div>
    </div>
@endsection
