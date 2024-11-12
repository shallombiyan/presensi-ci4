<?= $this->extend('admin/layout.php') ?>

<?= $this->section('content') ?>

<div class="card col-md-8">
    <div class="card-body">
        <table class="table">
        <img style="border-radius: 10px" width="120 px" src="<?= base_url('profile/'. $pegawai['foto'])?>" alt="">
            <tr>
                <td><strong>Nip</strong></td>
                <td>:</td>
                <td><?= $pegawai['nip'] ?></td>
            </tr>
            <tr>
                <td><strong>Nama</strong></td>
                <td>:</td>
                <td><?= $pegawai['nama'] ?></td>
            </tr>
            <tr>
                <td><strong>Username</strong></td>
                <td>:</td>
                <td><?= $pegawai['username'] ?></td>
            </tr>
            <tr>
                <td><strong>Jenis Kelamin</strong></td>
                <td>:</td>
                <td><?= $pegawai['jenis_kelamin'] ?></td>
            </tr>
            <tr>
                <td><strong>Alamat</strong></td>
                <td>:</td>
                <td><?= $pegawai['alamat'] ?></td>
            </tr>
            <tr>
                <td><strong>No. Handphone</strong></td>
                <td>:</td>
                <td><?= $pegawai['no_handphone'] ?></td>
            </tr>
            <tr>
                <td><strong>Jabatan</strong></td>
                <td>:</td>
                <td><?= $pegawai['jabatan'] ?></td>
            </tr>
            <tr>
                <td><strong>Lokasi Presensi</strong></td>
                <td>:</td>
                <td><?= $pegawai['lokasi_presensi'] ?></td>
            </tr>
            <tr>
                <td><strong>Status</strong></td>
                <td>:</td>
                <td><?= $pegawai['status'] ?></td>
            </tr>
            <tr>
                <td><strong>Role</strong></td>
                <td>:</td>
                <td><?= $pegawai['role'] ?></td>
            </tr>
        </table>
    </div>
</div>

<?= $this->endSection() ?>