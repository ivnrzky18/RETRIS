<form method="POST" action="{{ route('journals.store') }}">
    @csrf

    <div class="mb-3">
        <label>Tanggal:</label>
        <input type="date" name="date" required class="form-control" value="{{ date('d-M-Y') }}">
    </div>

    <div class="mb-3">
        <label>Deskripsi:</label>
        <textarea name="description" required class="form-control"></textarea>
    </div>

    <table class="table table-bordered" id="account-rows">
        <thead>
            <tr><th>Akun</th><th>Debit</th><th>Kredit</th></tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <select name="accounts[0][account_id]" class="form-select">
                        @foreach($accounts as $a)
                            <option value="{{ $a->id }}">{{ $a->code }} - {{ $a->name }}</option>
                        @endforeach
                    </select>
                </td>
                <td><input type="number" name="accounts[0][debit]" step="0.01" class="form-control"></td>
                <td><input type="number" name="accounts[0][credit]" step="0.01" class="form-control"></td>
            </tr>
        </tbody>
    </table>

    <button type="button" class="btn btn-secondary" onclick="addRow()">+ Tambah Baris</button>
    <button type="submit" class="btn btn-success" id="btn-simpan">Simpan</button>
</form>

<script>
let row = 1;
function addRow() {
    const table = document.querySelector('#account-rows tbody');
    const newRow = document.createElement('tr');
    newRow.innerHTML = `
        <td>
            <select name="accounts[${row}][account_id]" class="form-select">
                @foreach($accounts as $a)
                    <option value="{{ $a->id }}">{{ $a->code }} - {{ $a->name }}</option>
                @endforeach
            </select>
        </td>
        <td><input type="number" name="accounts[${row}][debit]" step="0.01" class="form-control"></td>
        <td><input type="number" name="accounts[${row}][credit]" step="0.01" class="form-control"></td>
    `;
    table.appendChild(newRow);
    row++;
}
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const table = document.getElementById('account-rows');
    const btnSimpan = document.getElementById('btn-simpan');

    function updateButtonStatus() {
        let debitTotal = 0;
        let creditTotal = 0;

        document.querySelectorAll('input[name^="accounts"]').forEach(input => {
            if (input.name.includes('[debit]') && input.value) {
                debitTotal += parseFloat(input.value) || 0;
            }
            if (input.name.includes('[credit]') && input.value) {
                creditTotal += parseFloat(input.value) || 0;
            }
        });

        // Aktifkan tombol hanya jika debit == kredit dan > 0
        btnSimpan.disabled = !(debitTotal > 0 && debitTotal === creditTotal);

        // Tampilkan indikator perbedaan (opsional)
        document.getElementById('selisih-info').textContent =
            (debitTotal !== creditTotal)
                ? `⚠️ Selisih Rp ${Math.abs(debitTotal - creditTotal).toLocaleString('id-ID')}`
                : '✅ Balance';
    }

    // Trigger update saat angka berubah
    table.addEventListener('input', updateButtonStatus);

    // Inisialisasi saat pertama
    updateButtonStatus();
});
</script>
<p id="selisih-info" class="mt-2 text-danger"></p>

