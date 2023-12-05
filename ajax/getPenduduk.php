<?php
include __DIR__ . '/../config/helper.php';
include __DIR__ . '/../config/db.php';
session_set_cookie_params(360, '/', '.search.integra', false, true);
session_start();
$query = "SELECT a.*, b.propinsi, c.kabupaten, d.kecamatan
          FROM mst_penduduk a
          LEFT JOIN mst_provinsi b ON a.id_prop = b.id_prop
          LEFT JOIN mst_kabupaten c ON a.id_kab = c.id_kab
          LEFT JOIN mst_kecamatan d ON a.id_kec = d.id_kec
          WHERE a.is_deleted = 0";
if ($_POST != null || $_POST != '' || $_SESSION != null || $_SESSION != '') {
    if (isset($_POST['penduduk_id'])) $query .= " AND a.penduduk_id = ". $_POST['penduduk_id'];
    if (isset($_SESSION['nama'])) $query .= " AND a.nama_penduduk LIKE '%" . $_SESSION['nama'] . "%'";
    if (isset($_SESSION['alamat'])) $query .= " AND a.alamat LIKE '%" . $_SESSION['alamat'] . "%'";
    if (isset($_SESSION['provinsi']) && $_SESSION['provinsi'] != 'semua') $query .= " AND a.id_prop = " . $_SESSION['provinsi'];
    if (isset($_SESSION['kabupaten']) && $_SESSION['kabupaten'] != 'semua') $query .= " AND a.id_kab = " . $_SESSION['kabupaten'];
    if (isset($_SESSION['kecamatan']) && $_SESSION['kecamatan'] != 'semua') $query .= " AND a.id_kec = " . $_SESSION['kecamatan'];
    if ((isset($_SESSION['tgl_lahir_awal']) && isset($_SESSION['tgl_lahir_akhir'])) && ($_SESSION['tgl_lahir_awal'] != '' && $_SESSION['tgl_lahir_akhir'] != '')) $query .= " AND a.tgl_lahir BETWEEN '" . $_SESSION['tgl_lahir_awal'] . "' AND '". $_SESSION['tgl_lahir_akhir'] . "'";
    if ((isset($_SESSION['pendapatan_mulai']) && isset($_SESSION['pendapatan_akhir'])) && ($_SESSION['pendapatan_mulai'] != '' && $_SESSION['pendapatan_akhir'] != '')) $query .= " AND a.pendapatan BETWEEN '" . $_SESSION['pendapatan_mulai'] . "' AND '". $_SESSION['pendapatan_akhir'] . "'";
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
