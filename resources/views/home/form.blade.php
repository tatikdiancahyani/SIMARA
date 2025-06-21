<!-- Form Tambah Jadwal -->
<div id="addModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%;
background-color: rgba(0,0,0,0.5); z-index: 1000; justify-content: center; align-items: center;">
    <div
        style="background-color: #ffffff; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); padding: 25px; margin-bottom: 30px;">
        <h3 style="text-align: center; color: #007bff;">Tambah Jadwal Rapat</h3>
        <form action="{{ route('jadwal-rapat.store') }}" method="POST">
            @csrf
            <div style="display: flex; flex-wrap: wrap; gap: 15px; margin-bottom: 20px;">
                <input type="text" id="addJudul" name="judul"
                    value="{{ old('judul', session('form.jadwal.judul')) }}"
                    placeholder="Judul Rapat" required class="input-field">
                <input type="date" id="addTanggal" name="tanggal"
                    value="{{ old('tanggal', session('form.jadwal.tanggal')) }}"
                    required class="input-field">
                <input type="time" id="addWaktu" name="waktu"
                    value="{{ old('waktu', session('form.jadwal.waktu')) }}"
                    step="60" required class="input-field">
                <input type="text" id="addTempat" name="tempat"
                    value="{{ old('tempat', session('form.jadwal.tempat')) }}"
                    placeholder="Tempat" required class="input-field">
            </div>
            @error('conflict')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
            @enderror
            <textarea name="deskripsi" placeholder="Deskripsi Acara" rows="3" required class="input-field"
                style="width: 100%;">{{ session('form.jadwal.deskripsi') }}</textarea>

            <div style="display: flex; gap: 15px; margin-top:15px">
                <button type="button" onclick="tutupAddModal()" class="btn-light">Batal</button>
                <button type="submit" class="btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit Jadwal -->
<div id="editModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%;
background-color: rgba(0,0,0,0.5); z-index: 1000; justify-content: center; align-items: center;">
    <div style="background: white; padding: 20px; border-radius: 10px; width: 90%; max-width: 500px;">
        <h3>Edit Jadwal Rapat</h3>
        <form id="editForm">
            @csrf
            <div style="display: flex; flex-wrap: wrap; gap: 15px; margin-bottom: 20px;">
                <input type="hidden" name="id" id="edit-id">
                <input type="text" name="judul" id="edit-judul" placeholder="Judul Rapat" class="input-field" required>
                <input type="date" name="tanggal" id="edit-tanggal" class="input-field" required>
                <input type="time" name="waktu" step="60" id="edit-waktu" class="input-field" required>
                <input type="text" name="tempat" id="edit-tempat" placeholder="Tempat" class="input-field" required>
            </div>
            <textarea name="deskripsi" id="edit-deskripsi" placeholder="Deskripsi" class="input-field" rows="3" required
                style="width: 100%;"></textarea>
            <div style="display: flex; gap: 15px; margin-top: 15px">
                <button type="button" onclick="tutupEditModal()" class="btn-light">Batal</button>
                <button type="submit" class="btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<script>
    function hapusRapat(id) {
        if (confirm("Yakin ingin menghapus jadwal rapat ini?")) {
            fetch(`/jadwal-rapat/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    }
                })
                .then(res => {
                    if (res.ok) {
                        alert('Jadwal berhasil dihapus.');
                        fetchJadwalRapat().then(() => renderCalendar(currentDate));
                        document.getElementById('eventContent').innerHTML =
                            'Klik tanggal yang memiliki acara untuk melihat detailnya.';
                    } else {
                        alert('Gagal menghapus jadwal.');
                    }
                })
                .catch(err => console.error(err));
        }
    }

    function editRapat(data) {
        document.getElementById('edit-id').value = data.id_jadwal;
        document.getElementById('edit-judul').value = data.judul;
        document.getElementById('edit-tanggal').value = data.tanggal;
        document.getElementById('edit-waktu').value = data.waktu.replace(/:00$/, ''); // hapus detik 
        document.getElementById('edit-tempat').value = data.tempat;
        document.getElementById('edit-deskripsi').value = data.deskripsi;
        document.getElementById('editModal').style.display = 'flex';

    }

    function addRapat(tanggal = null) {
        if (!tanggal) {
            // set tanggal hari ini
            tanggal = (new Date()).toISOString().split('T')[0];
        }
        const inputTanggal = document.getElementById('addTanggal')
        inputTanggal.value = tanggal
        document.getElementById('addModal').style.display = 'flex';
    }

    function tutupEditModal() {
        document.getElementById('editModal').style.display = 'none';
    }

    function tutupAddModal() {
        document.getElementById('addModal').style.display = 'none';
    }

    document.getElementById('editForm').addEventListener('submit', function (e) {
        e.preventDefault();
        const id = document.getElementById('edit-id').value;
        const formData = {
            judul: document.getElementById('edit-judul').value,
            tanggal: document.getElementById('edit-tanggal').value,
            waktu: document.getElementById('edit-waktu').value,
            tempat: document.getElementById('edit-tempat').value,
            deskripsi: document.getElementById('edit-deskripsi').value
        };

        fetch(`/jadwal-rapat/${id}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                        'content'),
                    'Accept': 'application/json'
                },
                body: JSON.stringify(formData)
            })
            .then(res => {
                if (res.ok) {
                    alert('Jadwal berhasil diupdate.');
                    tutupEditModal();
                    fetchJadwalRapat().then(() => {
                        renderCalendar(currentDate)
                        // Otomatis update detail acara yang dipilih
                        document.getElementsByClassName(`event-id-${id}`)[0]?.click()
                    });
                } else {
                    alert('Gagal update jadwal.');
                }
            })
            .catch(err => console.error(err));
    });

</script>
