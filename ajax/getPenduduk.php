<?php
include '../config/helper.php';
include '../config/db.php';
$query = "SELECT a.penduduk_id,a.nama_penduduk, b.propinsi, c.kabupaten, d.kecamatan,
            a.alamat,a.no_telp,a.tgl_lahir,a.pendapatan,a.tingkat_pendidikan,a.jenis_pekerjaan,a.keterangan
          FROM mst_penduduk a
          LEFT JOIN mst_provinsi b ON a.id_prop = b.id_prop
          LEFT JOIN mst_kabupaten c ON a.id_kab = c.id_kab
          LEFT JOIN mst_kecamatan d ON a.id_kec = d.id_kec
          WHERE a.is_deleted = 0";
if ($_POST != null) {
    if ($_POST['nama_penduduk']) $query .= " AND a.nama_penduduk LIKE '%" . $_POST['nama_penduduk'] . "%'";
    if ($_POST['alamat']) $query .= " AND a.nama_penduduk LIKE '%" . $_POST['alamat'] . "%'";
    if ($_POST['id_prop']) $query .= " AND a.id_prop = " . $_POST['id_prop'];
    if ($_POST['id_kab']) $query .= " AND a.id_prop = " . $_POST['id_prop'];
    if ($_POST['id_kec']) $query .= " AND a.id_prop = " . $_POST['id_prop'];
}
$penduduk = query($conn, $query);
foreach ($penduduk as $key => $val) {
    $umur = hitung_umur($val['tgl_lahir']);
    $penduduk[$key]['tgl_lahir'] .= '('. $umur['y'] . ' Tahun ' . $umur['m'] . ' Bulan ' . $umur['d'] . ' Hari ' . ')';
    $penduduk[$key]['tahun'] = $umur['y'];
    $penduduk[$key]['aksi'] = '<div class="dropdown">
    <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Aksi
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
      <a class="dropdown-item" href="#">Detail</a>
      <a class="dropdown-item" href="#">Update</a>
      <a class="dropdown-item" href="#">Delete</a>
    </div>
  </div>';
}
$response = array('data' => $penduduk);
header('Content-Type: application/json');
echo json_encode($penduduk);
