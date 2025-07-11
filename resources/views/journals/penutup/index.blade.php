@extends('layouts.app')
@section('title', 'Jurnal Penutup')
@section('content')
<div class="container">
<h4 class="mb-3">Daftar Jurnal Penutup</h4>

<button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalTambah">+ Tambah Jurnal Penutup</button>

<table class="table table-bordered table-striped">
    <thead class="table-light">
        <tr>
            <th>Tanggal</th>
            <th>Kode</th>
            <th>Deskripsi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($journals as $j)
        <tr>
            <td>{{ $j->date }}</td>
            <td>{{ $j->transaction_code }}</td>
            <td>{{ $j->description }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<!-- Modal Tambah -->
<div class="modal fade" id="modalTambah" tabindex="-1">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Jurnal Penutup</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ route('journals.penutup.store') }}">
            @csrf
            <div class="mb-3">
                <label>Tanggal</label>
                <input type="date" name="date" required class="form-control">
            </div>
            <div class="mb-3">
                <label>Deskripsi</label>
                <textarea name="description" class="form-control" required></textarea>
            </div>

            <table class="table" id="account-rows">
                <thead><tr><th>Akun</th><th>Debit</th><th>Kredit</th></tr></thead>
                <tbody>
                    <tr>
                        <td>
                            <select name="accounts[0][account_id]" class="form-select">
                                @foreach($accounts as $a)
                                    <option value="{{ $a->id }}">{{ $a->code }} - {{ $a->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td><input type="number" name="accounts[0][debit]" class="form-control"></td>
                        <td><input type="number" name="accounts[0][credit]" class="form-control"></td>
                    </tr>
                </tbody>
            </table>

            <button type="button" onclick="addRow()" class="btn btn-secondary mb-2">+ Tambah Baris</button>
            <button type="submit" class="btn btn-success">Simpan</button>
        </form>
      </div>
    </div>
</div>
</div>

<script>
let row = 1;
function addRow() {
    const tbody = document.querySelector('#account-rows tbody');
    const tr = document.createElement('tr');
    tr.innerHTML = `
        <td>
            <select name="accounts[${row}][account_id]" class="form-select">
                @foreach($accounts as $a)
                    <option value="{{ $a->id }}">{{ $a->code }} - {{ $a->name }}</option>
                @endforeach
            </select>
        </td>
        <td><input type="number" name="accounts[${row}][debit]" class="form-control"></td>
        <td><input type="number" name="accounts[${row}][credit]" class="form-control"></td>
    `;
    tbody.appendChild(tr);
    row++;
}
</script>
@endsection
