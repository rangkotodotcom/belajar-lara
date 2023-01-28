@extends('layout.main')

@section('container')

<div class="row justify-content-center">
    <div class="col-md-5">
        <main class="form-registration">
            <h1 class="h3 mb-3 fw-normal text-center">Registration Form</h1>

            <form action="/register" method="POST">

                @csrf

                <div class="form-floating">
                    <input type="text" class="form-control rounded-top @error('name') is-invalid @enderror" id="name"
                        name="name" placeholder="Name" value="{{ old('name') }}" required>
                    <label for="name">Name</label>

                    @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-floating">
                    <input type="text" class="form-control @error('username') is-invalid @enderror" id="username"
                        name="username" placeholder="Username" value="{{ old('username') }}" required>
                    <label for="username">Username</label>

                    @error('username')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-floating">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                        id="email" placeholder="name@example.com" value="{{ old('email') }}" required>
                    <label for="email">Email address</label>

                    @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-floating">
                    <input type="password" class="form-control rounded-bottom @error('password') is-invalid @enderror"
                        id="password" name="password" placeholder="Password" required>
                    <label for="password">Password</label>

                    @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <button class="w-100 btn btn-lg btn-primary mt-3" type="submit">Sign in</button>
            </form>
            <small class="text-center d-block mt-3">Already registered? <a href="/login">Login</a></small>

            <div class="flex items-center justify-end mt-4">
                <a href="/auth/google">
                    <img src="https://developers.google.com/identity/images/btn_google_signin_dark_normal_web.png"
                        style="margin-left: 3em;">
                </a>
            </div>

        </main>
    </div>
</div>



@endsection