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
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        .custom-form {
            max-width: 400px;
            margin: 2rem auto;
            background: #fff;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .form-title {
            text-align: center;
            margin-bottom: 1.5rem;
            color: #495057;
        }

        .form-group i {
            position: absolute;
            top: 50%;
            left: 15px;
            transform: translateY(-50%);
            color: #6c757d;
        }

        .form-control {
            padding-left: 40px;
        }

        .btn-primary {
            background: #0d6efd;
            border: none;
            padding: 0.75rem;
            font-size: 1rem;
            border-radius: 8px;
        }

        .btn-primary:hover {
            background: #0b5ed7;
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

        .form-select {
            font-size: 1rem;
            padding: 0.75rem;
            border-radius: 8px;
            transition: border-color 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }

        .form-select:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 5px rgba(13, 110, 253, 0.5);
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

            <div class="mb-3 position-relative ">
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}"
                    placeholder="Full Name" required>
            </div>

            <div class="mb-3 position-relative">
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}"
                    placeholder="Email Address" required>
            </div>

            <div class="mb-3 position-relative">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password"
                    required>
            </div>

            <div class="mb-3 position-relative">
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                    placeholder="Confirm Password" required>
            </div>

            @php
                use App\Models\UserRole;
                $role = UserRole::all();
            @endphp

            <div class="mb-3">
                <label for="role" class="form-label muted" >Role</label>
                <select class="form-select w-100" id="role" name="role" required>
                    <option value="" disabled selected>Select Role</option>
                    @foreach ($role as $data )
                         <option value="{{ $data->id }}">{{ $data->role }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary w-100">Register</button>
        </form>
    </div>

    <!-- Bootstrap JS + Font Awesome -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
