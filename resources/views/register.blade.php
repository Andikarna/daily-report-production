<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            background: #f2f6fc;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .custom-form {
            max-width: 420px;
            margin: auto;
            margin-top: 60px;
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.15);
        }

        .form-group i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
        }

        .form-control {
            padding-left: 2.5rem;
        }

        .form-title {
            text-align: center;
            margin-bottom: 30px;
            font-weight: bold;
            color: #2c3e50;
        }

        .btn-primary {
            background-color: #3c8dbc;
            border: none;
            border-radius: 6px;
        }

        .btn-primary:hover {
            background-color: #327ba8;
        }
    </style>
</head>

<body>

    <div class="container">
        <form action="{{ route('register') }}" method="POST" class="custom-form">
            <h2 class="form-title">Create Account</h2>
            @csrf

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="form-group position-relative">
                <i class="fa fa-user"></i>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Full Name" required>
            </div>

            <div class="form-group position-relative">
                <i class="fa fa-envelope"></i>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="Email Address" required>
            </div>

            <div class="form-group position-relative">
                <i class="fa fa-lock"></i>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
            </div>

            <div class="form-group position-relative">
                <i class="fa fa-lock"></i>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" required>
            </div>

            <button type="submit" class="btn btn-primary btn-block">Register</button>
        </form>
    </div>

    <!-- Bootstrap JS + Font Awesome -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
