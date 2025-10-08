<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PT Metal Art Toyota Astra Indonesia</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: url("{{ asset('assets/images/bg.png') }}") no-repeat center center fixed;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(12px);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            width: 400px;
            color: #fff;
        }

        .login-card h3 {
            color: #fff;
            font-weight: 600;
            text-align: center;
        }

        .login-card h5 {
            color: #d1e0ff;
            text-align: center;
            margin-bottom: 20px;
        }

        .form-control {
            background-color: rgba(255, 255, 255, 0.85);
            border: none;
            border-radius: 10px;
            padding: 12px 15px;
            font-size: 15px;
        }

        .btn-primary {
            background-color: #004aad;
            border: none;
            border-radius: 10px;
            padding: 10px;
            font-weight: 500;
            width: 100%;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #007bff;
            transform: translateY(-2px);
        }

        .company-logo {
            display: block;
            margin: 0 auto 15px;
            width: 90px;
            border-radius: 50%;
            background-color: #fff;
            padding: 10px;
        }

        @media (max-width: 480px) {
            .login-card {
                width: 90%;
                padding: 25px;
            }
        }
    </style>
</head>
<body>
    <div class="login-card text-center">
        <!-- Logo perusahaan -->
        <img src="{{ asset('assets/images/logo2.jpeg') }}" alt="Logo Metal Art" class="company-logo">


        <h3>PT Metal Art Toyota</h3>
        <h5>Inventory Consumable System</h5>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3 text-start">
                <label for="email" class="form-label">Email</label>
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
            </div>

            <div class="mb-3 text-start">
                <label for="password" class="form-label">Password</label>
                <input id="password" type="password" class="form-control" name="password" required>
            </div>

            <button type="submit" class="btn btn-primary">Login</button>
        </form>

        <p class="mt-4 text-light small">© {{ date('Y') }} PT Metal Art Toyota Astra Indonesia</p>
    </div>
</body>
</html>
