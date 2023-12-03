<script>
    $(document).ready(function() {
        $('#penduduk_table').DataTable({
            paging: true, // Aktifkan paginasi
            searching: false, // Aktifkan fitur pencarian
            ordering: true, // Aktifkan fitur pengurutan
            responsive: true, // Aktifkan responsivitas untuk tampilan mobile
            lengthMenu: [10, 25, 50, 100], // Pilihan panjang halaman
            pageLength: 10, // Jumlah baris per halaman
            columnDefs: [{
                    targets: [0],
                    orderable: false
                },
                {
                    targets: [1, 2, 3, 4],
                    orderable: true
                }, // Kolom 1 (Nama) dan 2 (Provinsi) dapat diurutkan
                // ... Konfigurasi lainnya ...
            ]// Pengurutan awal berdasarkan kolom indeks 1 (misalnya, kolom kedua) secara ascending

        });
        getProvinsi();
        penduduk_data();
    });

    function penduduk_data() {
        $.ajax({
            url: 'ajax/getPenduduk.php',
            method: 'POST',
            success: function(data) {
                $('#penduduk_data').html(data);
            }
        });
    }

    function getProvinsi() {
        $.ajax({
            url: 'ajax/getProvinsi.php',
            method: 'POST',
            success: function(data) {
                $('#provinsi').html(data);
                getKabupaten();
            }
        });
    }
    function getKabupaten() {
        var id_prop = $('#provinsi').val();
        $.ajax({
            url: 'ajax/getKabupaten.php',
            method: 'POST',
            data: {
                id_prop: id_prop
            },
            success: function(data) {
                $('#kabupaten').html(data);
                getKecamatan();
            }
        });
    }

    function getKecamatan() {
        var id_kab = $('#kabupaten').val();
        var id_prop = $('#provinsi').val();
        $.ajax({
            url: 'ajax/getKecamatan.php',
            method: 'POST',
            data: {
                id_prop: id_prop,
                id_kab: id_kab
            },
            success: function(data) {
                $('#kecamatan').html(data);
            }
        });
    }
</script>