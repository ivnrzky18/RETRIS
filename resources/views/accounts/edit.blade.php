@extends('layouts.app')
@section('title', 'Edit Akun')

@section('content')
<div class="container">
    <div class="container">
    <br>
    <h4 class="mb-3">Edit Akun</h4>

    <form action="{{ route('accounts.update', $account->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Kode Akun</label>
            <input type="text" name="code" class="form-control" value="{{ old('code', $account->code) }}" required>
            @error('code') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Nama Akun</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $account->name) }}" required>
            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Jenis Akun</label>
            <select name="type" class="form-select" required>
                <option value="">-- Pilih Jenis --</option>
                @foreach (['Aset', 'Kewajiban', 'Modal', 'Pendapatan', 'Beban'] as $jenis)
                    <option value="{{ $jenis }}" {{ old('type', $account->type) == $jenis ? 'selected' : '' }}>{{ $jenis }}</option>
                @endforeach
            </select>
            @error('type') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Saldo Normal</label>
            <select name="normal_balance" class="form-select" required>
                <option value="">-- Pilih Saldo --</option>
                @foreach (['Debit', 'Kredit'] as $saldo)
                    <option value="{{ $saldo }}" {{ old('normal_balance', $account->normal_balance) == $saldo ? 'selected' : '' }}>{{ $saldo }}</option>
                @endforeach
            </select>
            @error('normal_balance') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('accounts.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
</div>
@endsection
