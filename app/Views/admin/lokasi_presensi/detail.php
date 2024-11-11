<?= $this->extend('admin/layout.php') ?>

<?= $this->section('content') ?>

<div class="card col-md-8">
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

<?= $this->endSection() ?>