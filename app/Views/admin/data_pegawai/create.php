<?= $this->extend('admin/layout.php') ?>

<?= $this->section('content') ?>

<div class="card col-md-6">
    <div class="card-body">
        <form method="POST" action="<?= base_url('admin/data_pegawai/store') ?>" enctype="multipart/form-data">

            <div class="input-style-1">
                <label for="nama">Nama</label>
                <input type="text" id="nama" class="form-control <?= ($validation->getError('nama')) ? 'is-invalid' : '' ?>" name="nama" placeholder="Nama" required />
                <div class="invalid-feedback"><?= $validation->getError('nama') ?></div>
            </div>

            <div class="input-style-1">
                <label for="jenis_kelamin">Jenis Kelamin</label>
                <select id="jenis_kelamin" name="jenis_kelamin" class="form-control <?= ($validation->hasError('jenis_kelamin')) ? 'is-invalid' : '' ?>">
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
                <div class="invalid-feedback"><?= $validation->getError('jenis_kelamin') ?></div>
            </div>

            <div class="input-style-1">
                <label for="alamat">Alamat</label>
                <textarea id="alamat" name="alamat" class="form-control <?= ($validation->getError('alamat')) ? 'is-invalid' : '' ?>" cols="30" rows="5" placeholder="Alamat"></textarea>
                <div class="invalid-feedback"><?= $validation->getError('alamat') ?></div>
            </div>


            <div class="input-style-1">
                <label for="no_handphone">No. Handphone</label>
                <textarea id="no_handphone" name="no_handphone" class="form-control <?= ($validation->getError('no_handphone')) ? 'is-invalid' : '' ?>" placeholder="No. Handphone"></textarea>
                <div class="invalid-feedback"><?= $validation->getError('no_handphone') ?></div>
            </div>

            <div class="input-style-1">
                <label>Jabatan</label>
                <select id="jabatan" name="jabatan" class="form-control <?= ($validation->hasError('jabatan')) ? 'is-invalid' : '' ?>">
                    <option value="">--Pilih Jabatan--</option>
                    <?php foreach ($jabatan as $jab): ?>
                        <option value="<?= $jab['jabatan'] ?>"><?= $jab
                        ['jabatan'] ?></option>
                    <?php endforeach; ?>
                </select>
                <div class="invalid-feedback"><?= $validation->getError('jabatan') ?></div>
            </div>

            <div class="input-style-1">
                <label>Lokasi Presensi</label>
                <select id="lokasi_presensi" name="lokasi_presensi" class="form-control <?= ($validation->hasError('lokasi_presensi')) ? 'is-invalid' : '' ?>">
                    <option value="">--Pilih lokasi Presensi--</option>
                    <?php foreach ($lokasi_presensi as $lok): ?>
                        <option value="<?= $lok['id'] ?>"><?= $lok
                        ['nama_lokasi'] ?></option>
                    <?php endforeach; ?>
                </select>
                <div class="invalid-feedback"><?= $validation->getError('lokasi_presensi') ?></div>
            </div>

            <div class="input-style-1">
                <label>Foto</label>
                <input type="file" id="foto" class="form-control <?= ($validation->hasError('foto')) ? 'is-invalid' : '' ?>" name="foto" required />
                <div class="invalid-feedback"><?= $validation->getError('foto') ?></div>
            </div>

            <div class="input-style-1">
                <label for="username">Username</label>
                <input type="text" id="username" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : '' ?>" name="username" placeholder="Username" required />
                <div class="invalid-feedback"><?= $validation->getError('username') ?></div>
            </div>

            <div class="input-style-1">
                <label>Password</label>
                <input type="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : '' ?>" name="password" placeholder="Password" required />
                <div class="invalid-feedback"><?= $validation->getError('password') ?></div>
            </div>

            <div class="input-style-1">
                <label>Konfirmasi Password</label>
                <input type="password" class="form-control <?= ($validation->hasError('konfirmasi_password')) ? 'is-invalid' : '' ?>" name="konfirmasi_password" placeholder="Konfirmasi Password" required />
                <div class="invalid-feedback"><?= $validation->getError('konfirmasi_password') ?></div>
            </div>

            <div class="input-style-1">
                <label for="role">Role</label>
                <select id="role" name="role" class="form-control <?= ($validation->hasError('role')) ? 'is-invalid' : '' ?>">
                    <option value="">--Pilih Role--</option>
                    <option value="Admin">Admin</option>
                    <option value="Pegawai">Pegawai</option>
                </select>
                <div class="invalid-feedback"><?= $validation->getError('role') ?></div>
            </div>
            
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>

<?= $this->endSection() ?>