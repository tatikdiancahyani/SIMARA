<?php
// Tentukan nama file yang ingin diunduh
$file = '../files/Berita_Acara_Rapat.pdf'; // Ganti dengan path file Anda

// Periksa apakah file ada
if (file_exists($file)) {
    // Set header untuk memaksa unduhan
    header('Content-Description: File Transfer');
    header('Content-Type: application/pdf'); // Ganti dengan tipe file yang sesuai
    header('Content-Disposition: attachment; filename="' . basename($file) . '"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    readfile($file);
    exit;
} else {
    echo "File tidak ditemukan.";
}
?>