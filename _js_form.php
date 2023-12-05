<script>
    $(document).ready(function() {
        <?php if (isset($_GET['id'])) : ?>
            getData('<?= $_GET['id'] ?>');
        <?php endif; ?>
        $('#form_user').validate({
            rules: {
                no_telp: {
                    minlength: 8,
                    maxlength: 14
                },
                pendapatan: {
                    number: true
                }
            },
            messages: {
                no_telp: {
                    minlength: "No Telpon wajib lebih dari 8 angka",
                    maxlength: "No Telpon wajib kurang dari 14 angka"
                },
                pendapatan: {
                    number: "Pendapatan wajib berupa angka"
                }
            },
            submitHandler: function(form) {
                $.ajax({
                    url: 'ajax/savePenduduk.php',
                    type: 'POST',
                    data: $(form).serialize(),
                    success: function(response) {
                        window.location.href = 'index.php'
                    }
                });
            }
        });
    });

    function getData(id) {
        $.ajax({
            url: 'ajax/getPenduduk.php',
            method: 'POST',
            data: {
                penduduk_id: id
            },
            success: function(data) {
                data = data[0]
                $('#nama_penduduk').val(data.nama_penduduk);
                $('#alamat').val(data.alamat);
                $('#no_telp').val(data.no_telp);
                $('#tgl_lahir').val(data.tgl_lahir);
                $('#pendapatan').val(data.pendapatan);
                $('#tingkat_pendidikan').val(data.tingkat_pendidikan);
                $('#jenis_pekerjaan').val(data.jenis_pekerjaan);
                $('#keterangan').val(data.keterangan);
                $('#provinsi').val(data.id_prop);
                $('#kabupaten').val(data.id_kab);
            }
        });
    }
</script>