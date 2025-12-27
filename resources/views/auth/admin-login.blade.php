<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Admin RT - RETRIS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(135deg, #E67E22, #D35400);
            margin: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .login-box {
            background: #fff;
            padding: 40px;
            width: 100%;
            max-width: 420px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,.3);
        }
        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #E67E22;
        }
        .form-group {
            margin-bottom: 18px;
        }
        label {
            display: block;
            margin-bottom: 6px;
        }
        input {
            width: 100%;
            padding: 12px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }
        button {
            width: 100%;
            background: #E67E22;
            color: #fff;
            border: none;
            padding: 12px;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
        }
        .error {
            color: red;
            font-size: .9rem;
        }
    </style>
</head>
<body>

<div class="login-box">
    <h2>Login Admin RT</h2>

    @if($errors->any())
        <div class="error">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('admin.login.submit') }}">
        @csrf
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" required>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" required>
        </div>
        <button type="submit">Login Admin</button>
    </form>
           <p>
            <a href="{{ url('/') }}">← Kembali ke Beranda</a>
        </p>
</div>
 
</body>
</html>
