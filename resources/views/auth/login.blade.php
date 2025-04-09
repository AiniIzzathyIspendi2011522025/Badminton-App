<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Login &mdash; </title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- CSS Libraries -->
    <!-- <link rel="stylesheet" href="{{ asset('templates/node_modules/bootstrap-social/bootstrap-social.css') }}"> -->

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('templates/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('templates/css/components.css') }}">
</head>

<body>
    <div id="app">
        <section class="section">
            <div class="d-flex justify-content-center align-items-center" style="margin-top: 150px;">
                <div class="col-lg-4 col-md-6 col-12 order-lg-1 h-auto order-2 bg-white">
                    <div class="p-4 m-3">
                        <h4 class="text-dark font-weight-normal text-center">Welcome to <span
                                class="font-weight-bold">Badminton</span></h4>
                        <h2 class="text-dark text-center mt-5 ">Login</h2>
                        <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate="">
                            @csrf
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input id="email" type="email" class="form-control" name="email" tabindex="1"
                                    required autofocus>
                                <div class="invalid-feedback">
                                    Please fill in your email
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="d-block">
                                    <label for="password" class="control-label">Password</label>
                                </div>
                                <input id="password" type="password" class="form-control" name="password"
                                    tabindex="2" required>
                                <div class="invalid-feedback">
                                    please fill in your password
                                </div>
                                <div class="mt-2">
                                    <a href="/forgot-password">
                                        Forget Password?
                                    </a>
                                </div>
                            </div>

                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-primary btn-lg btn-icon icon-right"
                                    tabindex="4">
                                    Login
                                </button>
                            </div>

                            <div class="mt-5 text-center">
                                @if (isset($_GET['role']))
                                    @if ($_GET['role'] == 'owner')
                                        <a href="{{ route('register') }}?role=owner" class="signup-image-link">Don't
                                            have an
                                            account? Create an account</a>
                                    @elseif($_GET['role'] == 'customer')
                                        <a href="{{ route('register') }}?role=customer" class="signup-image-link">Don't
                                            have
                                            an account? Create an account</a>
                                    @else
                                    @endif
                                @endif
                                <br>
                                <a href="/" class="text-center text-black mx-auto">Back to Home</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- General JS Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="{{ asset('templates/js/stisla.js') }}"></script>

    <!-- JS Libraies -->

    <!-- Template JS File -->
    <script src="{{ asset('templates/js/scripts.js') }}"></script>
    <script src="{{ asset('templates/js/custom.js') }}"></script>

    <!-- Page Specific JS File -->
</body>

</html>
