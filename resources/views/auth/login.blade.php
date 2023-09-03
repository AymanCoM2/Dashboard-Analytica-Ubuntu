<!DOCTYPE html>
<html class="h-100" lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>
        Log in Page
    </title>
    <link href="{{ asset('dashboard/css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet" />

</head>

<body class="h-100">

    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3"
                    stroke-miterlimit="10" />
            </svg>
        </div>
    </div>

    <div class="login-form-bg h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-6">
                    <div class="form-input-content">
                        <div class="card login-form mb-0">
                            <div class="card-body pt-5">
                                <a class="text-center" href="#">
                                    <h4>Welcome</h4>
                                </a>

                                <form class="mt-5 mb-5 login-input" action="{{ route('login') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" required autocomplete="email" autofocus
                                            placeholder="write email .. " />
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required autocomplete="current-password" placeholder="Enter password .."
                                            class="border border-danger" />

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <button class="btn login-form__btn submit w-100">
                                        Sign In
                                    </button>
                                </form>
                                <p class="mt-5 login-form__footer">
                                    Dont have account?
                                    <a href="{{ route('register') }}" class="text-primary">Sign Up</a>
                                    now
                                </p>
                                <a class="m-3" href="{{ route('password.request') }}">Forgot Password ? </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src={{ asset('plugins/common/common.min.js') }}></script>
    <script src={{ asset('dashboard/js/custom.min.js') }}></script>
    <script src={{ asset('dashboard/js/settings.js') }}></script>
    <script src={{ asset('dashboard/js/gleek.js') }}></script>
    <script src={{ asset('dashboard/js/styleSwitcher.js') }}></script>
</body>

</html>
