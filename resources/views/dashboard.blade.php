@extends('layouts.app')
@section('contents')
<div class="container" style="max-width: 1000px; margin: auto; padding: 20px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">

    @if(session('success'))
    <div style="background-color: #d4edda; color: #155724; padding: 15px; border-left: 5px solid #28a745; border-radius: 8px; margin-bottom: 20px;">
        {{ session('success') }}
    </div>
    @endif
    @if ( Auth::user()->role == 'admin')
    <!-- Form Tambah Jadwal -->
    <div style="background-color: #ffffff; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); padding: 25px; margin-bottom: 30px;">
        <h3 style="text-align: center; color: #007bff;">Tambah Jadwal Rapat</h3>
        <form action="{{ route('jadwal-rapat.store') }}" method="POST">
            @csrf
            <div style="display: flex; flex-wrap: wrap; gap: 15px; margin-bottom: 20px;">
                <input type="text" name="judul" placeholder="Judul Rapat" required class="input-field">
                <input type="date" name="tanggal" required class="input-field">
                <input type="time" name="waktu" step="60" required class="input-field">
                <input type="text" name="tempat" placeholder="Tempat" required class="input-field">
            </div>
            <textarea name="deskripsi" placeholder="Deskripsi Acara" rows="3" required class="input-field" style="width: 100%;"></textarea>
            <button type="submit" class="btn-primary" style="margin-top: 15px;">Simpan</button>
        </form>
    </div>
    @endif
    <!-- Kalender -->
    <div class="calendar-container" style="background: #ffffff; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); overflow: hidden;">
        <div class="controls" style="display: flex; justify-content: space-between; align-items: center; padding: 15px 20px; background-color: #007bff; color: white;">
            <button id="prevMonth" class="btn-light">← Sebelumnya</button>
            <h2 id="currentMonth" style="margin: 0;"></h2>
            <button id="nextMonth" class="btn-light">Berikutnya →</button>
        </div>
        <div class="weekdays" style="display: grid; grid-template-columns: repeat(7, 1fr); background-color: #f1f3f5; text-align: center; padding: 10px 0; font-weight: bold;">
            <div>Min</div>
            <div>Sen</div>
            <div>Sel</div>
            <div>Rab</div>
            <div>Kam</div>
            <div>Jum</div>
            <div>Sab</div>
        </div>
        <div id="calendar" class="calendar" style="display: grid; grid-template-columns: repeat(7, 1fr); gap: 8px; padding: 20px;"></div>

        <div id="eventDetails" style="padding: 20px; border-top: 1px solid #eee; background-color: #fafafa;">
            <h4>Detail Acara</h4>
            <div id="eventContent">Klik tanggal yang memiliki acara untuk melihat detailnya.</div>
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
                <textarea name="deskripsi" id="edit-deskripsi" placeholder="Deskripsi" class="input-field" rows="3" required style="width: 100%;"></textarea>
                <div style="display: flex; gap: 15px;">
                    <button type="button" onclick="tutupModal()" class="btn-light">Batal</button>
                    <button type="submit" class="btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

</div>

<style>
    .input-field {
        flex: 1 1 45%;
        padding: 10px;
        border-radius: 6px;
        border: 1px solid #ccc;
        font-size: 14px;
    }

    .btn-primary {
        width: 100%;
        padding: 12px;
        border: none;
        background-color: #007bff;
        color: white;
        font-weight: bold;
        border-radius: 6px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .btn-light {
        background-color: #ffffff;
        border: 1px solid #ccc;
        padding: 8px 15px;
        border-radius: 5px;
        font-size: 14px;
        cursor: pointer;
        color: #333;
        transition: background-color 0.2s;
    }

    .btn-light:hover {
        background-color: #f0f0f0;
    }

    .calendar .day {
        background-color: #f8f9fa;
        text-align: center;
        border-radius: 6px;
        font-weight: bold;
        cursor: pointer;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 5px;
        box-sizing: border-box;
        min-height: 100px;
        aspect-ratio: 1 / 1;
        transition: all 0.3s;
    }

    .calendar .day:hover {
        background-color: rgb(235, 235, 235);
        color: white;
    }

    .calendar .day.event {
        background-color: rgb(228, 60, 60) !important;
        color: white !important;
    }

    .calendar .day.empty {
        background-color: transparent;
        cursor: default;
    }

    .btn-danger {
        background-color: rgb(238, 60, 60);
        color: white;
        padding: 8px 12px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        margin-top: 5px;
        transition: background-color 0.3s;
    }

    .btn-danger:hover {
        background-color: #c82333;
    }

    .btn-warning {
        background-color: #ffc107;
        color: black;
        padding: 8px 12px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        margin-left: 8px;
        transition: background-color 0.3s;
    }

    .btn-warning:hover {
        background-color: #e0a800;
    }
</style>

<script>
    const role = '{{ Auth::user()->role }}';
    const calendar = document.getElementById('calendar');
    const currentMonthElement = document.getElementById('currentMonth');
    let currentDate = new Date();
    let jadwalRapat = [];

    async function fetchJadwalRapat() {
        try {
            const response = await fetch('/jadwal-rapat');
            jadwalRapat = await response.json();
        } catch (error) {
            console.error('Gagal mengambil data rapat:', error);
        }
    }

    async function fetchDetailRapat(tanggal) {
        try {
            const response = await fetch(`/list-rapat-per-tanggal/${tanggal}`)
            return await response.text()
        } catch (error) {
            console.error('Fetch gagal:', error);
            return 'Gagal ambil data';
        }
    }

    function renderCalendar(date) {
        calendar.innerHTML = '';
        const year = date.getFullYear();
        const month = date.getMonth();
        const firstDay = new Date(year, month, 1).getDay();
        const lastDate = new Date(year, month + 1, 0).getDate();

        currentMonthElement.textContent = date.toLocaleDateString('id-ID', {
            month: 'long',
            year: 'numeric',
        });

        for (let i = 0; i < firstDay; i++) {
            const empty = document.createElement('div');
            empty.classList.add('day', 'empty');
            calendar.appendChild(empty);
        }

        for (let day = 1; day <= lastDate; day++) {
            const dayCell = document.createElement('div');
            dayCell.classList.add('day');

            if (
                day === new Date().getDate() &&
                month === new Date().getMonth() &&
                year === new Date().getFullYear()
            ) {
                dayCell.classList.add('today');
            }

            const events = jadwalRapat.filter((event) => {
                const eventDate = new Date(event.tanggal);
                return eventDate.getDate() === day &&
                    eventDate.getMonth() === month &&
                    eventDate.getFullYear() === year;
            });

            if (events.length > 0) {
                dayCell.classList.add('event');
                dayCell.innerHTML = `<strong>${day}</strong><br>`;
                events.forEach((event) => {
                    dayCell.classList.add(`event-id-${event.id_jadwal}`);
                    const title = document.createElement('span');
                    title.textContent = event.judul;
                    title.style.display = 'block';
                    title.style.fontSize = '12px';
                    dayCell.appendChild(title);
                });
            } else {
                dayCell.textContent = day;
            }


            dayCell.dataset['tanggal'] = `${year}-${month+1}-${day}`;
            dayCell.addEventListener('click', async function() {
                const tanggal = this.dataset['tanggal'];
                const detail = document.getElementById('eventContent');
                detail.innerHTML = await fetchDetailRapat(tanggal)
            });

            calendar.appendChild(dayCell);
        }
    }

    document.getElementById('prevMonth').addEventListener('click', () => {
        currentDate.setMonth(currentDate.getMonth() - 1);
        renderCalendar(currentDate);
    });

    document.getElementById('nextMonth').addEventListener('click', () => {
        currentDate.setMonth(currentDate.getMonth() + 1);
        renderCalendar(currentDate);
    });

    fetchJadwalRapat().then(() => renderCalendar(currentDate));

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
                        document.getElementById('eventContent').innerHTML = 'Klik tanggal yang memiliki acara untuk melihat detailnya.';
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

    function tutupModal() {
        document.getElementById('editModal').style.display = 'none';
    }

    document.getElementById('editForm').addEventListener('submit', function(e) {
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
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                },
                body: JSON.stringify(formData)
            })
            .then(res => {
                if (res.ok) {
                    alert('Jadwal berhasil diupdate.');
                    tutupModal();
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
@endsection