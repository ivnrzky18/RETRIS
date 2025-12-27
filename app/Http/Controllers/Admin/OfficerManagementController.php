<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class OfficerManagementController extends Controller
{
    public function index()
    {
        // Mengambil semua user dengan role petugas
        $petugas = User::where('role', 'petugas')->get();
        // Pastikan Anda nanti membuat file view di resources/views/admin/petugas/index.blade.php
        return view('admin.petugas.index', compact('petugas'));
    }
}