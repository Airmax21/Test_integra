<?php include('master/header.php'); ?>
<style>
  .age-pink {
    background-color: pink !important;
  }

  .age-orange {
    background-color: orange !important;
  }

  .age-green {
    background-color: lightgreen !important;
  }

  .age-blue {
    background-color: lightblue !important;
  }
</style>
<main class="p-3">
  <div class="row">
    <div class="col-md-12">
      <div id="notif_flash" class="alert alert-dismissible fade" role="alert">
        <span id="notif_flash_message">Data Berhasil Dihapus</span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="pencarian" method="post">
        <div class="row">
          <div class="col-lg-2">
            <div class="form-group">
              <label>Nama</label>
              <input type="text" class="form-control" id="nama" placeholder="Masukkan Nama">
            </div>
          </div>
          <div class="col-lg-2">
            <div class="form-group">
              <label>Alamat</label>
              <input type="text" class="form-control" id="alamat" placeholder="Masukkan Alamat">
            </div>
          </div>
          <div class="col-lg-3">
            <div class="form-group">
              <label for="pilihan">Provinsi</label>
              <select class="form-control" id="provinsi" onchange="getKabupaten()">
              </select>
            </div>
          </div>
          <div class="col-lg-3">
            <div class="form-group">
              <label for="pilihan">Kabupaten</label>
              <select class="form-control" id="kabupaten" onchange="getKecamatan()">
              </select>
            </div>
          </div>
          <div class="col-lg-3">
            <div class="form-group">
              <label for="pilihan">Kecamatan</label>
              <select class="form-control" id="kecamatan">
              </select>
            </div>
          </div>
          <div class="col-lg-2">
            <div class="form-group">
              <label for="pilihan">Tgl Lahir Mulai</label>
              <input name="tgl_lahir_awal" type="date" class="form-control">
              </select>
            </div>
          </div>
          <div class="col-lg-2">
            <div class="form-group">
              <label for="pilihan">Tgl Lahir Akhir</label>
              <input name="tgl_lahir_akhir" type="date" class="form-control">
              </select>
            </div>
          </div>
          <div class="col-lg-2">
            <div class="form-group">
              <label>Pendapatan Mulai</label>
              <input type="text" class="form-control" id="nama" placeholder="Masukkan Pendapatan">
            </div>
          </div>
          <div class="col-lg-2">
            <div class="form-group">
              <label>Pendapatan Akhir</label>
              <input type="text" class="form-control" id="nama" placeholder="Masukkan Pendapatan">
            </div>
          </div>
          <div class="col-lg-3">
            <div class="form-group">
              <br>
              <button type="button" id="cari" class="btn btn-md btn-info">Cari</button>
            </div>
          </div>
        </div>
      </form>
      <div class="row">
        <div class="col-lg-2">
          <button type="button" class="btn btn-md btn-info">Cetak</button>
        </div>
        <div class="col-lg-6"></div>
        <div class="col-lg-2">
          <button type="button" class="btn btn-primary" id="refresh_data">Refresh Data</button>
        </div>
        <div class="col-lg-2">
          <a href="edit_user.php"><button type="button" class="btn btn-success">Tambah Data</button></a>
        </div>
      </div>
      <br>
      <table class="table table-striped table-bordered" style="width:100%" id="penduduk_table">
        <thead>
          <tr>
            <th data-sortable="false">No</th>
            <th>Aksi</th>
            <th>Nama</th>
            <th>Provinsi</th>
            <th>Kabupaten</th>
            <th>Kecamatan</th>
            <th>Alamat</th>
            <th>No Telp/HP</th>
            <th>Tanggal Lahir</th>
            <th>Pendapatan</th>
            <th>Tingkat Pendidikan</th>
            <th>Jenis Pekerjaan</th>
            <th>Keterangan</th>
          </tr>
        </thead>
        <tbody id="penduduk_data">
        </tbody>
      </table>
    </div>
  </div>
</main>

<?php
include 'modal_delete.php';
include('master/footer.php');
include '_js.php';
?>