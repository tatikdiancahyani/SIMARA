@extends('layouts.app')

@section('contents')
<div class="container" style="max-width: 1000px; margin: auto; padding: 20px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">

    @if(session('success'))
    <div style="background-color: #d4edda; color: #155724; padding: 15px; border-left: 5px solid #28a745; border-radius: 8px; margin-bottom: 20px;">
        {{ session('success') }}
    </div>
    @endif

    @auth
    <!-- Tampil Form Tambah & Edit Jadwal Jika sudah login -->
    @include('home.form')
    @endauth

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

    <div class="image-popup-overlay" id="imagePopup" style="display: none">
        <img src="" alt="Large Meeting Image" class="image-popup-content" id="popupImage">
    </div>
</div>

<script>
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
                setTimeout(initPopupImage, 100)
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

    // Image popup
    function initPopupImage() {
        const clickableImage = document.querySelector('.clickable-image');
        const imagePopup = document.getElementById('imagePopup');
        const popupImage = document.getElementById('popupImage');

        if (clickableImage && imagePopup && popupImage) {
            clickableImage.addEventListener('click', function() {
                // Set the source of the popup image to the full-size image
                popupImage.src = this.src; // Uses the same source for simplicity
                imagePopup.style.display = 'flex'; // Show the popup
            });

            // Close the popup when clicking on the overlay or the image itself
            imagePopup.addEventListener('click', function() {
                imagePopup.style.display = 'none'; // Hide the popup
                popupImage.src = ''; // Clear image source to free memory
            });
        }
    };
</script>


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

    /* Image popup */
    .clickable-image {
        cursor: pointer;
    }

    .image-popup-overlay {
        display: none; /* Hidden by default */
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.8); /* Dark overlay */
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 1000; /* Ensure it's on top of other content */
    }

    .image-popup-content {
        max-width: 90%;
        max-height: 90%;
        object-fit: contain; /* Ensure image fits without cropping */
        cursor: pointer; /* Indicate it's clickable to close */
    }
</style>

@endsection

