<?php
include('master/header.php');
?>
<div class="container p-4">
  <div class="row">
    <div class="col-md-4 mx-auto">
      <div class="card card-body">
        <form id="form_user" method="post">
          <input type="hidden" name="penduduk_id" id="penduduk_id" value="<?= (isset($_GET['id'])?$_GET['id']:'') ?>">
          <div class="form-group">
            <label for="nama">Nama</label>
            <input name="nama_penduduk" type="text" class="form-control" value="" placeholder="Tuliskan Nama" required>
          </div>
          <div class="form-group">
            <label for="provinsi">Provinsi</label>
            <select class="form-control" name="id_prop" id="provinsi" onchange="getKabupaten()" required>
            </select>
          </div>
          <div class="form-group">
            <label for="kabupaten">Kabupaten</label>
            <select class="form-control" name="id_kab" id="kabupaten" onchange="getKecamatan()" required>
            </select>
          </div>
          <div class="form-group">
            <label for="kecamatan">Kecamatan</label>
            <select class="form-control" name="id_kec" id="kecamatan" required>
            </select>
          </div>
          <div class="form-group">
            <label for="alamat">Alamat</label>
            <textarea name="alamat" id="alamat" class="form-control" cols="30" rows="3" required></textarea>
          </div>
          <div class="form-group">
            <label for="no_telp">No Telp</label>
            <input name="no_telp" type="tel" class="form-control" value="" placeholder="Tuliskan Nomor" required>
          </div>
          <div class="form-group">
            <label for="tgl_lahir">Tanggal Lahir</label>
            <input name="tgl_lahir" type="date" class="form-control" value="" required>
          </div>
          <div class="form-group">
            <label for="pendapatan">Pendapatan</label>
            <input name="pendapatan" type="text" class="form-control" value="" placeholder="Tuliskan Pendapatan" required>
          </div>
          <div class="form-group">
            <label for="tingkat_pendidikan">Tingkat Pendidikan</label>
            <input name="tingkat_pendidikan" type="text" class="form-control" value="" placeholder="Tuliskan Tingkat Pendidikan" required>
          </div>
          <div class="form-group">
            <label for="jenis_pekerjaan">Jenis Pekerjaan</label>
            <input name="jenis_pekerjaan" type="text" class="form-control" value="" placeholder="Tuliskan Jenis Pekerjaan" required>
          </div>
          <div class="form-group">
            <label for="keterangan">Keterangan</label>
            <textarea name="keterangan" id="keterangan" class="form-control" cols="30" rows="3" required></textarea>
          </div>
          <button type="submit" class="btn-success">
            Simpan
          </button>
        </form>
      </div>
    </div>
  </div>
</div>
<?php
include('master/footer.php');
include '_js_form.php';
include '_js.php';
?>