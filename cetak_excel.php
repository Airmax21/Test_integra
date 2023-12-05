<?php
include 'ajax/getPenduduk.php';
include_once("third_party/PHP_XLSXWriter/xlsxwriter.class.php");

ini_set('display_errors', 0);
ini_set('log_errors', 1);
error_reporting(E_ALL & ~E_NOTICE);

// start excel pointer
$writer = new XLSXWriter();

// Normal Style
$styles1 = array(
    'font' => 'Arial',
    'font-size' => 8,
    'valign' => 'center',
    'halign' => 'center', 'border' => 'left,right,top,bottom'
);

// BOLD Style for header
$styles2 = array(
    'font' => 'Arial',
    'valign' => 'center',
    'font-style' => 'bold',
    'halign' => 'center', 'border' => 'left,right,top,bottom'
);

$writer->writeSheetRow(
    'Sheet1',
    array('Rekap Laporan Penduduk'),
    $styles2
);

$writer->writeSheetRow(
    'Sheet1',
    array('')
);

$writer->writeSheetRow(
    'Sheet1',
    array('')
);

// header
$headerArray = array(
    "No",
    "Nama",
    "Provinsi",
    "Kabupaten",
    "Kecamatan",
    "Alamat",
    "No Telp/HP",
    "Tanggal Lahir",
    "Pendapatan",
    "Tingkat Pendidikan",
    "Jenis Pekerjaan",
    "Keterangan"
);

$writer->writeSheetRow(
    'Sheet1',
    $headerArray,
    $styles2
);

if (!$penduduk) {
    $writer->writeSheetRow(
        'Sheet1',
        array('No data found'),
        $styles2
    );
} else {
    //create an array
    $no = 1;

    foreach ($penduduk as $val) {
        $dataarray = array(
            $no,
            $val["nama_penduduk"],
            $val["propinsi"],
            $val["kabupaten"],
            $val["kecamatan"],
            $val["alamat"],
            $val["no_telp"],
            $val["umur"],
            $val["pendapatan"],
            $val["tingkat_pendidikan"],
            $val["jenis_pekerjaan"],
            $val["keterangan"]
        );

        $writer->writeSheetRow(
            'Sheet1',
            $dataarray,
            $styles1
        );

        $no += 1;
    }
}

// Export to file
$filename = "rekap_laporan_" . date('Ymd_His') . ".xlsx";
$writer->writeToFile($filename);

header('Content-Disposition: attachment; filename="' . $filename . '"');
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Transfer-Encoding: binary');
header('Cache-Control: must-revalidate');
header('Pragma: public');


exit(0);
?>
