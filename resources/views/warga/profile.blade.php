<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pengaturan Profil - RETRIS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        :root{
            --bg:#f1f5f9;
            --card:#ffffff;
            --primary:#2563eb;
            --accent:#3b82f6;
            --text:#0f172a;
            --muted:#64748b;
        }
        *{box-sizing:border-box}
        body{
            margin:0;
            font-family:'Inter',sans-serif;
            background:var(--bg);
            color:var(--text);
            min-height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
            padding:30px;
        }
        .card{
            width:100%;
            max-width:520px;
            background:var(--card);
            padding:35px 30px;
            border-radius:18px;
            box-shadow:0 10px 25px rgba(0,0,0,.1);
        }
        h2{
            margin-top:0;
            color:var(--primary);
            text-align:center;
        }
        p.subtitle{
            text-align:center;
            color:var(--muted);
            margin-top:-10px;
            margin-bottom:25px;
        }
        .photo-box{
            display:flex;
            flex-direction:column;
            align-items:center;
            margin-bottom:25px;
        }
        .photo-box img{
            width:120px;
            height:120px;
            border-radius:50%;
            object-fit:cover;
            border:4px solid var(--primary);
            margin-bottom:10px;
            background:#e5e7eb;
        }
        .photo-box label{
            font-size:.9rem;
            color:var(--accent);
            cursor:pointer;
        }
        input[type=file]{ display:none; }

        .form-group{
            margin-bottom:18px;
        }
        label{
            display:block;
            margin-bottom:6px;
            font-weight:600;
            color:var(--muted);
        }
        input,select{
            width:100%;
            padding:12px 14px;
            border-radius:10px;
            border:1px solid #cbd5f5;
            background:#f8fafc;
            color:var(--text);
            outline:none;
            font-size:.95rem;
        }
        input:focus,select:focus{
            border-color:var(--accent);
            background:#fff;
        }

        .actions{
            margin-top:25px;
            display:flex;
            gap:15px;
        }
        .btn{
            flex:1;
            padding:13px;
            border:none;
            border-radius:999px;
            font-weight:700;
            cursor:pointer;
            transition:.3s;
        }
        .btn-save{
            background:linear-gradient(135deg,#2563eb,#3b82f6);
            color:#fff;
        }
        .btn-save:hover{opacity:.9;}
        .btn-back{
            background:#e2e8f0;
            color:#0f172a;
            text-align:center;
            text-decoration:none;
            line-height:40px;
        }
        .btn-back:hover{background:#cbd5e1;}
    </style>
</head>
<body>

<div class="card">
    <h2><i class="fas fa-user-cog"></i> Pengaturan Profil</h2>
    <p class="subtitle">Lengkapi data diri Anda sebagai warga RETRIS</p>

    <form method="POST" action="{{ route('warga.profile.update') }}" enctype="multipart/form-data">
        @csrf

        <div class="photo-box">
            <img id="preview"
                 src="{{ auth()->user()->profile_photo_path
                        ? asset('storage/' . auth()->user()->profile_photo_path)
                        : '' }}"
                 alt="Foto Profil">
            <label for="photo">
                <i class="fas fa-camera"></i> Ganti Foto Profil
            </label>
            <input type="file" id="photo" name="photo" accept="image/*" onchange="previewImage(event)">
        </div>

        <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" name="name" value="{{ auth()->user()->name }}" required>
        </div>

        <div class="form-group">
            <label>Jenis Kelamin</label>
            <select name="jenis_kelamin">
                <option value="">- Pilih -</option>
                <option value="Laki-laki" {{ auth()->user()->jenis_kelamin=='Laki-laki'?'selected':'' }}>Laki-laki</option>
                <option value="Perempuan" {{ auth()->user()->jenis_kelamin=='Perempuan'?'selected':'' }}>Perempuan</option>
            </select>
        </div>

        <div class="form-group">
            <label>Blok</label>
            <input type="text" name="blok" value="{{ auth()->user()->blok }}">
        </div>

        <div class="form-group">
            <label>No. Telepon</label>
            <input type="text" name="no_hp" value="{{ auth()->user()->no_hp }}">
        </div>

        <div class="actions">
            <a href="{{ route('warga.dashboard') }}" class="btn btn-back">Kembali</a>
            <button type="submit" class="btn btn-save">Simpan Profil</button>
        </div>
    </form>
</div>

<script>
function previewImage(e){
    const reader = new FileReader();
    reader.onload = function(){
        document.getElementById('preview').src = reader.result;
    }
    reader.readAsDataURL(e.target.files[0]);
}
</script>

</body>
</html>