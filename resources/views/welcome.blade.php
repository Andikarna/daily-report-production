<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Website</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- Custom CSS -->
    <style>
        body {
            background: url('https://images.unsplash.com/photo-1542744173-8e7e53415bb0?auto=format&fit=crop&w=1350&q=80') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .overlay {
            background-color: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(8px);
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
        }

        .logo {
            width: 100px;
            height: auto;
            margin-bottom: 20px;
        }

        .btn-custom {
            min-width: 140px;
            padding: 10px 20px;
            font-weight: 500;
            border-radius: 10px;
        }

        .title {
            font-size: 1.4rem;
            font-weight: 600;
            color: #333;
        }
    </style>
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="overlay text-center w-100" style="max-width: 600px;">
            <img src="assets/images/logo.jpeg" style="width:500px; height: 100px;" alt="Logo" class="logo">
            <div class="title mb-3">Selamat datang di Website kami</div>

            <div class="d-flex justify-content-center gap-3 mt-4">
                <button class="btn btn-primary btn-custom" onclick="window.location='{{ route('register') }}'">
                    <i class="bi bi-person-plus me-2"></i> Register
                </button>
                <button class="btn btn-outline-dark btn-custom" onclick="window.location='{{ route('login') }}'">
                    <i class="bi bi-box-arrow-in-right me-2"></i> Login
                </button>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
