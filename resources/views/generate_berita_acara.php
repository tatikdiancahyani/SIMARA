<?php
require ('fpdf.php');

// Ambil data dari formulir
$tanggal = $_POST['tanggal'];
$waktu = $_POST['waktu'];
$tempat = $_POST['tempat'];
$peserta = $_POST['peserta'];
$rincian = $_POST['rincian'];

// Buat PDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, 'BERITA ACARA RAPAT', 0, 1, 'C');
$pdf->Ln(10);

// Menambahkan isi berita acara
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, 'Pada hari ini ' . date('d', strtotime($tanggal)) . ' bulan ' . date('F', strtotime($tanggal)) . ' tahun ' . date('Y', strtotime($tanggal)), 0, 1);
$pdf->Cell(0, 10, 'telah dilaksanakan Rapat Koordinasi Sinkronisasi Penyusunan Rencana Program Kerja dan Rencana Anggaran yang dihadiri oleh ' . $peserta . ' peserta.', 0, 1);
$pdf->Cell(0, 10, 'Rapat ' . $rincian . ' telah membahas:', 0, 1);
$pdf->Ln(10);
$pdf->Cell(0, 10, 'Demikian Berita Acara ini dibuat untuk dapat dipergunakan sebagaimana mestinya.', 0, 1);
$pdf->Cell(0, 10, 'Mengetahui,', 0, 1);
$pdf->Cell(0, 10, 'Ir. Djoko Rahardjo, MP', 0, 1);
$pdf->Cell(0, 10, 'NIK.', 0, 1);

// Output PDF
$pdf->Output('D', 'Berita_Acara_' . date('Ymd') . '.pdf');
?>