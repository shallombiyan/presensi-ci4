<?= $this->extend('pegawai/layout.php') ?>

<?= $this->section('content') ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<input type="hidden" id="tanggal_keluar" name="tanggal_keluar" value="<?= $tanggal_keluar ?>">
<input type="hidden" id="jam_keluar" name="jam_keluar" value="<?= $jam_keluar ?>">

<div id="my_camera"></div>
<div style="display: none;" id="my_result"></div>
<button class="btn btn-danger mt-2" id="ambil-foto-keluar">keluar</button>

<script>
    Webcam.set({
        width: 320,
        height: 240,
        image_format: 'jpeg',
        jpeg_quality: 90
    });

    Webcam.attach('#my_camera');

    document.getElementById('ambil-foto-keluar').addEventListener('click', function() {
        let tanggal_keluar = document.getElementById('tanggal_keluar').value;
        let jam_keluar = document.getElementById('jam_keluar').value;

        Webcam.snap(function(data_uri) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (xhttp.readyState == 4 && xhttp.status == 200) {
                    document.getElementById('my_result').innerHTML = '<img src="' + data_uri + '"/>';
                    window.location.href = '<?= base_url('pegawai/home') ?>';
                }
            };
            xhttp.open("POST", "<?= base_url('pegawai/presensi_keluar_aksi/' . $id_presensi) ?>", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send(
                'foto_keluar=' + encodeURIComponent(data_uri) +
                '&tanggal_keluar=' + tanggal_keluar +
                '&jam_keluar=' + jam_keluar
            );
        });
    });
</script>

<?= $this->endSection() ?>
