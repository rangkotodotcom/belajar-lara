@extends('layout.main')

@section('container')

<div class="row justify-content-center">
    <div class="col-md-5">

        @if(session()->has('success'))

        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

        @endif

        @if(session()->has('error'))

        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

        @endif

        <main class="form-signin">
            <h1 class="h3 mb-3 fw-normal text-center">Please sign in</h1>


            <form action="/login" method="POST">

                @csrf


                <div class="form-floating">
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                        id="email" placeholder="name@example.com" required>
                    <label for="email">Email address</label>

                    @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror

                </div>
                <div class="form-floating">
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                        id="password" placeholder="Password" required>
                    <label for="password">Password</label>

                    @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror

                </div>

                <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
            </form>
            <small class="text-center d-block mt-3">Not registered? <a href="/register">Register Now</a></small>

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