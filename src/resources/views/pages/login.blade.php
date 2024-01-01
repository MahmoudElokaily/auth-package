@extends("auth::index")
@section("content")
    <div class="container">
        <div class="form-container" id="login-form">
            <h1>Login</h1>
            <form action="{{route("authenticate")}}" method="post">
                @csrf
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
                <button type="submit">Login</button>
            </form>
            <p>Don't have an account? <a href="{{route("register")}}" id="signup-link">Sign up</a></p>
            <p>Or <a href="{{route("forget-password")}}" id="signup-link">forget password</a></p>
        </div>
    </div>
@endsection
