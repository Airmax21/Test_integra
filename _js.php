<script>
    $(document).ready(function() {
        var datatable = $('#penduduk_table').DataTable({
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
                    targets: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11],
                    orderable: true
                },
            ],
            ajax: {
                url: 'ajax/getPenduduk.php', // Ganti dengan URL ke skrip PHP Anda
                dataSrc: ''

            },
            columns: [{
                    data: 'penduduk_id'
                },
                {
                    data: 'aksi'
                },
                {
                    data: 'nama_penduduk'
                },
                {
                    data: 'propinsi'
                },
                {
                    data: 'kabupaten'
                },
                {
                    data: 'kecamatan'
                },
                {
                    data: 'alamat'
                },
                {
                    data: 'no_telp'
                },
                {
                    data: 'tgl_lahir'
                },
                {
                    data: 'pendapatan'
                },
                {
                    data: 'tingkat_pendidikan'
                },
                {
                    data: 'jenis_pekerjaan'
                },
                {
                    data: 'keterangan'
                }
            ],
            rowCallback: function(row, data) {
                var age = parseInt(data.tahun);

                if (age < 7) {
                    $(row).addClass('age-pink');
                } else if (age >= 7 && age <= 16) {
                    $(row).addClass('age-orange');
                } else if (age >= 17 && age <= 35) {
                    $(row).addClass('age-green');
                } else {
                    $(row).addClass('age-blue');
                }
            }
        });
        datatable.columns.adjust().draw();
        getProvinsi();
        $('#refresh_data').click(function(e) {
            e.preventDefault();
            datatable.ajax.reload();
        })
    });



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