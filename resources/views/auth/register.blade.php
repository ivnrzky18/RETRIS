<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register - RETRIS</title>
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

        .register-container {
            background: #fff;
            width: 100%;
            max-width: 460px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,.3);
            padding: 40px 35px;
        }

        .register-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .register-header i {
            font-size: 3rem;
            color: #2ECC71;
        }

        .register-header h2 {
            color: #0D47A1;
            margin: 10px 0;
        }

        .register-header p {
            color: #555;
            font-size: .95rem;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            font-weight: 500;
            display: block;
            margin-bottom: 6px;
        }

        .form-group input, .form-group select {
            width: 100%;
            padding: 12px 14px;
            border-radius: 6px;
            border: 1px solid #ccc;
            outline: none;
            font-size: .95rem;
            background-color: #fff;
        }

        .form-group input:focus, .form-group select:focus {
            border-color: #2ECC71;
        }

        .btn-register {
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

        .btn-register:hover {
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

@php
    $role = request('role');
@endphp

@if(!in_array($role, ['warga','petugas']))
    <script>
        window.location = "{{ url('/register/choose') }}";
    </script>
@endif

<div class="register-container">
    <div class="register-header">
        <i class="fas fa-recycle"></i>
        <h2>Daftar Akun RETRIS</h2>
        <p>
            Pendaftaran sebagai 
            <strong>{{ $role == 'petugas' ? 'Petugas' : 'Warga' }}</strong>
        </p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <input type="hidden" name="role" value="{{ $role }}">

        <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" name="name" value="{{ old('name') }}" required>
            @error('name') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required>
            @error('email') <div class="error">{{ $message }}</div> @enderror
        </div>

        @if($role == 'warga')
        <div class="form-group">
            <label>Blok Rumah</label>
            <input type="text" name="blok" value="{{ old('blok') }}" placeholder="Contoh: A" required>
            @error('blok') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label>No Rumah</label>
            <input type="text" name="no_rumah" value="{{ old('no_rumah') }}" placeholder="Contoh: 12" required>
            @error('no_rumah') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label>Kategori Bangunan</label>
            <select name="kategori" required>
                <option value="" disabled selected>Pilih Kategori</option>
                <option value="rumah" {{ old('kategori') == 'rumah' ? 'selected' : '' }}>Rumah (Rp 20.000)</option>
                <option value="toko" {{ old('kategori') == 'toko' ? 'selected' : '' }}>Toko (Rp 35.000)</option>
                <option value="ruko" {{ old('kategori') == 'ruko' ? 'selected' : '' }}>Ruko (Rp 50.000)</option>
            </select>
            @error('kategori') <div class="error">{{ $message }}</div> @enderror
        </div>
        @endif

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" required>
            @error('password') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label>Konfirmasi Password</label>
            <input type="password" name="password_confirmation" required>
        </div>

        <button type="submit" class="btn-register">
            <i class="fas fa-user-plus"></i> Daftar Sekarang
        </button>
    </form>

    <div class="extra-links">
        <p>Sudah punya akun?
            <a href="{{ route('login') }}">Login di sini</a>
        </p>
        <p>
            <a href="{{ url('/register/choose') }}">← Kembali pilih peran</a>
        </p>
    </div>
</div>

</body>
</html>