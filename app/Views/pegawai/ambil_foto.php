<?= $this->extend('pegawai/layout.php') ?>

<?= $this->section('content') ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<input type="hidden" id="id_pegawai" name="id_pegawai" value="<?= $id_pegawai ?>">
<input type="hidden" id="tanggal_masuk" name="tanggal_masuk" value="<?= $tanggal_masuk ?>">
<input type="hidden" id="jam_masuk" name="jam_masuk" value="<?= $jam_masuk ?>">

<div id="my_camera"></div>
<div style="display: none;" id="my_result"></div>
<button class="btn btn-primary mt-2" id="ambil-foto">Masuk</button>

<script>
    Webcam.set({
        width: 320,
        height: 240,
        image_format: 'jpeg',
        jpeg_quality: 90
    });

    Webcam.attach('#my_camera');

    document.getElementById('ambil-foto').addEventListener('click', function() {
        let id = document.getElementById('id_pegawai').value;
        let tanggal_masuk = document.getElementById('tanggal_masuk').value;
        let jam_masuk = document.getElementById('jam_masuk').value;

        Webcam.snap(function(data_uri) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (xhttp.readyState == 4 && xhttp.status == 200) {
                    document.getElementById('my_result').innerHTML = '<img src="' + data_uri + '"/>';
                    window.location.href = '<?= base_url('pegawai/home') ?>';
                }
            };
            xhttp.open("POST", "<?= base_url('pegawai/presensi_masuk_aksi') ?>", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send(
                'foto_masuk=' + encodeURIComponent(data_uri) +
                '&id_pegawai=' + id +
                '&tanggal_masuk=' + tanggal_masuk +
                '&jam_masuk=' + jam_masuk
            );
        });
    });
</script>

<?= $this->endSection() ?>
