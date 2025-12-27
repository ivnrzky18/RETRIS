<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Carbon\Carbon;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',           // admin, officer, warga
        'kategori',       // rumah, ruko, toko
        'blok',
        'no_rumah',
        'alamat',
        'jenis_kelamin',
        'no_hp',
        'saldo',
        'tunggakan',      
        'points',         // TAMBAHKAN INI: Untuk fitur Green Points
        'profile_photo_path',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    protected $appends = [
        'profile_photo_url',
        'rank',           // TAMBAHKAN INI: Agar Rank otomatis muncul saat data user dipanggil
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'saldo' => 'decimal:2',
            'tunggakan' => 'decimal:2',
            'points' => 'integer', // Pastikan points terbaca sebagai angka bulat
        ];
    }

    /* ============================================================
       LOGIKA GAMIFIKASI (AI & REWARD)
       ============================================================ 
    */

    /**
     * Mendapatkan Rank/Gelar Warga berdasarkan Green Points.
     * Ini adalah bagian dari fitur Gamifikasi.
     */
    public function getRankAttribute()
    {
        if ($this->points >= 1000) return 'Duta Lingkungan (Emas)';
        if ($this->points >= 500)  return 'Pahlawan Kebersihan (Perak)';
        if ($this->points >= 100)  return 'Warga Peduli (Perunggu)';
        
        return 'Warga Baru';
    }

    /* ============================================================
       LOGIKA TAGIHAN & STATUS
       ============================================================ 
    */

    /**
     * Mendapatkan harga tagihan berdasarkan kategori user.
     */
    public function getHargaTagihanAttribute()
    {
        $daftarHarga = [
            'rumah' => 20000,
            'toko'  => 35000,
            'ruko'  => 50000,
        ];

        return $daftarHarga[$this->kategori] ?? 20000;
    }

    /**
     * Memeriksa status angkutan hari ini.
     */
    public function isCollectedToday()
    {
        return $this->trashCollections()
                    ->whereDate('collected_at', Carbon::today())
                    ->exists();
    }

    /* ============================================================
       RELASI DATABASE
       ============================================================ 
    */

    public function trashCollections()
    {
        return $this->hasMany(TrashCollection::class, 'user_id');
    }

    public function pointLogs()
    {
        return $this->hasMany(PointLog::class, 'user_id');
    }

    public function jobsDone()
    {
        return $this->hasMany(TrashCollection::class, 'officer_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'user_id');
    }
}