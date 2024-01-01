@extends("auth::index")
@section("content")
    <div class="container">
        <div class="form-container" id="signup-form">
            <h1>Change Password</h1>
            <form action="{{route('update-password')}}" method="post">
                @csrf
                <input type="text" name="token" value="{{$token}}" hidden="">
                <label for="new-password">Password</label>
                <input type="password" id="new-password" name="password" required>
                <label for="confirm-password">Confirm Password</label>
                <input type="password" id="confirm-password" name="password_confirmation" required>
                <button type="submit">Update password</button>
            </form>
        </div>
    </div>
@endsection
