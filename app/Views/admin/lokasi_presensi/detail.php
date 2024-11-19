<?= $this->extend('admin/layout.php') ?>

<?= $this->section('content') ?>

<style>
    #map { height: 560px; }
</style>

<div class="row">
    <div class="col-md-6">
        <div class="card">
        <div class="card-body">
            <table class="table">
                <tr>
                    <td><strong>Nama Lokasi</strong></td>
                    <td>:</td>
                    <td><?= esc($lokasi_presensi['nama_lokasi']) ?></td>
                </tr>
                <tr>
                    <td><strong>Alamat Lokasi</strong></td>
                    <td>:</td>
                    <td><?= esc($lokasi_presensi['alamat_lokasi']) ?></td>
                </tr>
                <tr>
                    <td><strong>Tipe Lokasi</strong></td>
                    <td>:</td>
                    <td><?= esc($lokasi_presensi['tipe_lokasi']) ?></td>
                </tr>
                <tr>
                    <td><strong>Latitude</strong></td>
                    <td>:</td>
                    <td><?= esc($lokasi_presensi['latitude']) ?></td>
                </tr>
                <tr>
                    <td><strong>Longitude</strong></td>
                    <td>:</td>
                    <td><?= esc($lokasi_presensi['longitude']) ?></td>
                </tr>
                <tr>
                    <td><strong>Radius</strong></td>
                    <td>:</td>
                    <td><?= esc($lokasi_presensi['radius']) ?></td>
                </tr>
                <tr>
                    <td><strong>Zona Waktu</strong></td>
                    <td>:</td>
                    <td><?= esc($lokasi_presensi['zona_waktu']) ?></td>
                </tr>
                <tr>
                    <td><strong>Jam Masuk</strong></td>
                    <td>:</td>
                    <td><?= esc($lokasi_presensi['jam_masuk']) ?></td>
                </tr>
                <tr>
                    <td><strong>Jam Pulang</strong></td>
                    <td>:</td>
                    <td><?= esc($lokasi_presensi['jam_pulang']) ?></td>
                </tr>
            </table>
        </div>
    </div>
    </div>
    <div class="col-md-6">
        <div id="map"></div>
    </div>
</div>

<script>
    var map = L.map('map').setView([<?= esc($lokasi_presensi['latitude']) ?>, <?= esc($lokasi_presensi['longitude']) ?>], 13);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    var circle = L.circle([<?= esc($lokasi_presensi['latitude']) ?>, <?= esc($lokasi_presensi['longitude']) ?>], {
        color: 'red',
        fillColor: '#f03',
        fillOpacity: 0.5,
        radius: 500
    }).addTo(map);

</script>

<?= $this->endSection() ?>