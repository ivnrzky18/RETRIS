<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - RETRIS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(135deg, #0D47A1, #081F4D);
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-container {
            background: #fff;
            width: 100%;
            max-width: 420px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,.3);
            padding: 40px 35px;
        }

        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .login-header h2 {
            color: #0D47A1;
            margin: 10px 0;
        }

        .login-header i {
            font-size: 3rem;
            color: #2ECC71;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: 500;
            display: block;
            margin-bottom: 6px;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 12px 14px;
            border-radius: 6px;
            border: 1px solid #ccc;
            outline: none;
            font-size: .95rem;
        }

        .form-group input:focus,
        .form-group select:focus {
            border-color: #2ECC71;
        }

        .btn-login {
            width: 100%;
            background: #2ECC71;
            color: #fff;
            border: none;
            padding: 12px;
            font-size: 1rem;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
            transition: .3s;
        }

        .btn-login:hover {
            background: #27AE60;
        }

        .extra-links {
            text-align: center;
            margin-top: 20px;
            font-size: .9rem;
        }

        .extra-links a {
            color: #0D47A1;
            text-decoration: none;
            font-weight: 500;
        }

        .extra-links a:hover {
            text-decoration: underline;
        }

        .error {
            color: #E74C3C;
            font-size: .85rem;
            margin-top: 5px;
        }
    </style>
</head>
<body>

<div class="login-container">
    <div class="login-header">
        <i class="fas fa-recycle"></i>
        <h2>Login RETRIS</h2>
        <p>Masuk sebagai Warga atau Petugas</p>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email -->
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>
            @error('email')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
            @error('password')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <!-- Role -->
        <div class="form-group">
            <label for="role">Login Sebagai</label>
            <select name="role" id="role" required>
                <option value="">-- Pilih Role --</option>
                <option value="warga">Warga</option>
                <option value="petugas">Petugas</option>
            </select>
            @error('role')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <!-- Button -->
        <button type="submit" class="btn-login">
            <i class="fas fa-sign-in-alt"></i> Masuk
        </button>
    </form>

    <div class="extra-links">
        <p>Belum punya akun?
            <a href="{{ url('/register/choose') }}">Daftar di sini</a>
        </p>
        <p>
            <a href="{{ url('/') }}">← Kembali ke Beranda</a>
        </p>
    </div>
</div>

</body>
</html>
