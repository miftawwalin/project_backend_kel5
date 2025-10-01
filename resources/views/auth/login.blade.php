<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - PT Metal Art Toyota</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background: url('/images/bg-metalart.jpg') no-repeat center center fixed;
            background-size: cover;
            position: relative;
        }
        body::before {
            content: "";
            position: absolute;
            inset: 0;
            background: rgba(0,0,0,0.6);
            backdrop-filter: blur(6px);
        }
        .login-card {
            position: relative;
            z-index: 1;
            background: rgba(255,255,255,0.9);
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.25);
            width: 400px;
            padding: 30px;
        }
        .company-title {
            font-weight: bold;
            font-size: 20px;
            text-align: center;
            margin-bottom: 15px;
            color: #003366;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="company-title">PT Metal Art Toyota</div>
        <h4 class="text-center mb-4">Company Portal</h4>

        @if ($errors->any())
            <div class="alert alert-danger py-2">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ url('/login') }}">
            @csrf
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required autofocus>
            </div>
            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button class="btn btn-primary w-100">Login</button>
        </form>
    </div>
</body>
</html>
