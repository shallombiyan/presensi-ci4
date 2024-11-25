<?= $this->extend('pegawai/layout.php') ?>

<?= $this->section('content') ?>

<div class="card col-md-6">
    <div class="card-body">
        <form method="POST" action="<?= base_url('pegawai/ketidakhadiran/store') ?>" enctype="multipart/form-data">

            <?= csrf_field() ?>
            <input type="hidden" value="<?= session()->get('id_pegawai') ?>" name="id_pegawai">

            <div class="input-style-1">
                <label for="keterangan">Keterangan</label>
                <select id="keterangan" name="keterangan" class="form-control <?= ($validation->hasError('keterangan')) ? 'is-invalid' : '' ?>" required>
                    <option value="">Pilih Keterangan</option>
                    <option value="Izin">Izin</option>
                    <option value="Sakit">Sakit</option>
                </select>
                <div class="invalid-feedback"><?= $validation->getError('keterangan') ?></div>
            </div>

            <div class="input-style-1">
                <label for="tanggal">Tanggal Ketidakhadiran</label>
                <input type="date" id="tanggal" name="tanggal" class="form-control <?= ($validation->getError('tanggal')) ? 'is-invalid' : '' ?>" required>
                <div class="invalid-feedback"><?= $validation->getError('tanggal') ?></div>
            </div>

            <div class="input-style-1">
                <label for="deskripsi">Deskripsi</label>
                <textarea id="deskripsi" name="deskripsi" class="form-control <?= ($validation->getError('deskripsi')) ? 'is-invalid' : '' ?>" cols="30" rows="5" placeholder="Deskripsi" required></textarea>
                <div class="invalid-feedback"><?= $validation->getError('deskripsi') ?></div>
            </div>

            <div class="input-style-1">
                <label for="file">File</label>
                <input type="file" id="file" name="file" class="form-control <?= ($validation->getError('file')) ? 'is-invalid' : '' ?>" required>
                <div class="invalid-feedback"><?= $validation->getError('file') ?></div>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Ajukan</button>
        </form>
    </div>
</div>

<?= $this->endSection() ?>