<?php
include('koneksi.php');
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$sheet->setCellValue('A1', 'NO');
$sheet->setCellValue('B1', 'TANGGAL');
$sheet->setCellValue('C1', 'NAMA TAMU');
$sheet->setCellValue('D1', 'ALAMAT');
$sheet->setCellValue('E1', 'NO TELEPON/HP');
$sheet->setCellValue('F1', 'BERTEMU DENGAN');
$sheet->setCellValue('G1', 'KEPENTINGAN');

if (isset($_GET['cari'])) {
    $p_awal = $_GET['p_awal'];
    $p_akhir = $_GET['p_akhir'];
    $data = mysqli_query($koneksi, "SELECT * FROM `buku tamu` WHERE tanggal BETWEEN '$p_awal' AND '$p_akhir'");
} else {
    $data = mysqli_query($koneksi, "SELECT * FROM `buku tamu`");
}

$i = 2;
$no = 1;
while ($d = mysqli_fetch_array($data)) {
    $sheet->setCellValue('A' . $i, $no++);
    $sheet->setCellValue('B' . $i, $d['tanggal']);
    $sheet->setCellValue('C' . $i, $d['nama_tamu']);
    $sheet->setCellValue('D' . $i, $d['alamat']);
    $sheet->setCellValue('E' . $i, $d['no_hp']);
    $sheet->setCellValue('F' . $i, $d['bertemu']);
    $sheet->setCellValue('G' . $i, $d['kepentingan']);
    $i++;
}

$writer = new Xlsx($spreadsheet);
$writer->save('Laporan Buku Tamu.xlsx');
echo "<script>window.location = 'Laporan Buku Tamu.xlsx'</script>";
?>
