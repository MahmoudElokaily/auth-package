@extends("auth::index")
@section("content")
    <div class="container">
        <div class="form-container" id="login-form">
            <h1>Reset Password</h1>
            <form action="{{route("send-mail")}}" method="post">
                @csrf
                <label for="email">Please enter your email address or mobile number to search for your account.</label>
                <input type="text" id="email" name="email" placeholder="Email Address" required>
                <button type="submit">Reset Password</button>
            </form>
            <p>Already have an account? <a href="{{route('login')}}" id="login-link">Login</a></p>
        </div>
    </div>
@endsection
