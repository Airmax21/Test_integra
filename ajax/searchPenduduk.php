<?php
include '../config/helper.php';
include '../config/db.php';
$query = "SELECT a.*, b.propinsi, c.kabupaten, d.kecamatan
          FROM mst_penduduk a
          LEFT JOIN mst_provinsi b ON a.id_prop = b.id_prop
          LEFT JOIN mst_kabupaten c ON a.id_kab = c.id_kab
          LEFT JOIN mst_kecamatan d ON a.id_kec = d.id_kec
          WHERE a.is_deleted = 0";
if ($_POST != null || $_POST != '') {
    if (isset($_POST['penduduk_id'])) $query .= " AND a.penduduk_id = ". $_POST['penduduk_id'];
    if (isset($_POST['nama_penduduk'])) $query .= " AND a.nama_penduduk LIKE '%" . $_POST['nama_penduduk'] . "%'";
    if (isset($_POST['alamat'])) $query .= " AND a.nama_penduduk LIKE '%" . $_POST['alamat'] . "%'";
    if (isset($_POST['id_prop'])) $query .= " AND a.id_prop = " . $_POST['id_prop'];
    if (isset($_POST['id_kab'])) $query .= " AND a.id_prop = " . $_POST['id_prop'];
    if (isset($_POST['id_kec'])) $query .= " AND a.id_prop = " . $_POST['id_prop'];
}
$penduduk = query($conn, $query);
foreach ($penduduk as $key => $val) {
    $umur = hitung_umur($val['tgl_lahir']);
    $penduduk[$key]['umur'] = $penduduk[$key]['tgl_lahir'].'('. $umur['y'] . ' Tahun ' . $umur['m'] . ' Bulan ' . $umur['d'] . ' Hari ' . ')';
    $penduduk[$key]['tahun'] = $umur['y'];
    $penduduk[$key]['aksi'] = '<div class="dropdown">
    <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Aksi
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
      <a class="dropdown-item" onclick="modalDetail(\''. $val['penduduk_id'] . '\'">Detail</a>
      <a class="dropdown-item" href="edit_user.php?id='. $val['penduduk_id'] .'">Update</a>
      <a class="dropdown-item" onclick="modalData(\''. $val['penduduk_id'] .'\')">Delete</a>
    </div>
  </div>';
}
$response = array('data' => $penduduk);
header('Content-Type: application/json');
echo json_encode($penduduk);
