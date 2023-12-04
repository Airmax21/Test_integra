<script>
    $(document).ready(function() {
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

                    }
                });
            }
        });
    });
</script>