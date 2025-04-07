<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Page</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        integrity="sha512-dMkhDIk9RkL5t2my0x7RWAvYzFoU+1l1ryHeFjEN2TNVH4Q9DjRWfJtK2G7Y9WAGb9KzFx5Tfay8D2wE5W9W0A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
        body {
            margin: 0;
            padding: 0;
            background: url('assets/images/background.jpg') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow: hidden;
        }

        .bubble {
            position: absolute;
            border-radius: 50%;
            opacity: 0.3;
            animation: float 25s infinite ease-in-out;
            background: rgba(255, 255, 255, 0.4);
        }

        .bubble:nth-child(1) {
            width: 80px;
            height: 80px;
            left: 10%;
            animation-delay: 0s;
        }

        .bubble:nth-child(2) {
            width: 50px;
            height: 50px;
            left: 25%;
            animation-delay: 4s;
        }

        .bubble:nth-child(3) {
            width: 100px;
            height: 100px;
            left: 70%;
            animation-delay: 2s;
        }

        @keyframes float {
            0% {
                bottom: -100px;
                transform: translateX(0) rotate(0);
            }

            100% {
                bottom: 120%;
                transform: translateX(50px) rotate(360deg);
            }
        }

        .container-centered {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            z-index: 2;
        }

        .login-wrapper {
            background: rgba(255, 255, 255, 0.95);
            padding: 35px 30px;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            z-index: 2;
            position: relative;
        }

        .logo {
            display: block;
            margin: 0 auto 25px;
            max-width: 160px;
        }

        .form-control-icon {
            position: absolute;
            top: 50%;
            left: 12px;
            transform: translateY(-50%);
            color: #6c757d;
        }

        .input-group .form-control {
            padding-left: 2.5rem;
            transition: box-shadow 0.2s ease-in-out;
        }

        .input-group .form-control:focus {
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
        }

        .illustration {
            display: none;
        }

        .btn-primary {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-weight: 500;
            font-size: 16px;
        }

        @media (min-width: 992px) {
            .illustration {
                display: block;
                max-width: 400px;
                margin-right: 50px;
                animation: fadeIn 1s ease-out;
            }

            @keyframes fadeIn {
                from {
                    opacity: 0;
                    transform: translateX(-30px);
                }

                to {
                    opacity: 1;
                    transform: translateX(0);
                }
            }

            .container-centered {
                flex-direction: row;
            }
        }
    </style>
</head>

<body>
    <!-- Floating Bubbles -->
    <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="bubble"></div>

    <div class="container container-centered">

        <!-- Login Box -->
        <div class="login-wrapper">
            <img src="assets/images/akku-logo.png" style="width: 300px; height: 100px;" alt="Logo" class="logo" />

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="mb-3 position-relative input-group">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email address"
                        value="{{ old('email') }}" required />
                </div>
            
                <div class="mb-3 position-relative input-group">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password"
                        required />
                </div>
            
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember" />
                    <label class="form-check-label" for="remember">Remember me</label>
                </div>
            
                <button type="submit" class="btn btn-primary w-100">
                    <i class="fas fa-sign-in-alt"></i> Login
                </button>
            </form>
            
            

        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
