<?php
include '../config/helper.php';
include '../config/db.php';
$table = 'mst_penduduk';
$penduduk = get($conn, $table);
foreach ($penduduk as $p) {
    echo "<tr>
    <td>{$p['nama_penduduk']}</td>
    <td>{$p['nama_penduduk']}</td>
    <td>{$p['nama_penduduk']}</td>
    <td>{$p['nama_penduduk']}</td>
    <td>{$p['nama_penduduk']}</td>
    <td>{$p['nama_penduduk']}</td>
    <td>{$p['nama_penduduk']}</td>
    <td>{$p['nama_penduduk']}</td>
    <td>{$p['nama_penduduk']}</td>
    <td>{$p['nama_penduduk']}</td>
    <td>{$p['nama_penduduk']}</td>
    <td>{$p['nama_penduduk']}</td>
    </tr>";
}
