<?= $this->extend('admin/layout.php') ?>

<?= $this->section('content') ?>

    <form class="row g-3 mb-4">
        <div class="col-auto">
            <select name="filter_bulan" class="form-control">
                <option value="">--Pilih Bulan--</option>
                <option value="01">Januari</option>
                <option value="02">Februari</option>
                <option value="03">Maret</option>
                <option value="04">April</option>
                <option value="05">Mei</option>
                <option value="06">Juni</option>
                <option value="07">Juli</option>
                <option value="08">Agustus</option>
                <option value="09">September</option>
                <option value="10">Oktober</option>
                <option value="11">November</option>
                <option value="12">Desember</option>
            </select>
        </div>

        <div class="col-auto">
            <select name="filter_tahun" class="form-control">
                <option value="2024">2024</option>
                <option value="2025">2025</option>
                <option value="2026">2026</option>
            </select>
        </div>

        <div class="col-auto">
            <button type="submit" class="btn btn-primary w-100">Tampilkan</button>
        </div>
    </form>

    <div class="mb-3">
        <span>Menampilkan Data: 
            <?php if ($bulan) : ?>
                <?= date('F Y', strtotime($tahun . '-' . $bulan)) ?>
            <?php else : ?>
                <?= date('F Y') ?>
            <?php endif; ?>
        </span>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pegawai</th>
                <th>Tanggal</th>
                <th>Jam Masuk</th>
                <th>Jam Keluar</th>
                <th>Total Jam Kerja</th>
                <th>Total Keterlambatan</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($rekap_bulanan) : ?>
                <?php $no = 1; ?>
                    <?php foreach ($rekap_bulanan as $rekap): ?>
                        <?php 
                        // Menghitung total jam kerja
                        $timestamp_jam_masuk = strtotime($rekap['tanggal_masuk'] . ' ' . $rekap['jam_masuk']);
                        $timestamp_jam_keluar = strtotime($rekap['tanggal_keluar'] . ' ' . $rekap['jam_keluar']);
                        $selisih = $timestamp_jam_keluar - $timestamp_jam_masuk;
                        $jam = floor($selisih / 3600);
                        $selisih -= $jam * 3600;
                        $menit = floor($selisih / 60);

                        // Menghitung total keterlambatan
                        $jam_masuk_real = strtotime($rekap['jam_masuk']);
                        $jam_masuk_kantor = strtotime($rekap['jam_masuk_kantor']);
                        $selisih_terlambat = $jam_masuk_real - $jam_masuk_kantor;
                        $jam_terlambat = floor($selisih_terlambat / 3600);
                        $selisih_terlambat -= $jam_terlambat * 3600;
                        $menit_terlambat = floor($selisih_terlambat / 60);
                        ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= esc($rekap['nama']) ?></td>
                            <td><?= date('d F Y', strtotime($rekap['tanggal_masuk'])) ?></td>
                            <td><?= esc($rekap['jam_masuk']) ?></td>
                            <td><?= esc($rekap['jam_keluar']) ?></td>
                            <td>
                                <?php if ($rekap['jam_keluar'] == '00:00:00'): ?>
                                    0 Jam 0 Menit
                                <?php else: ?>
                                    <?= $jam . ' Jam ' . $menit . ' Menit' ?>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($selisih_terlambat < 0): ?>
                                    <span class="badge bg-success text-decoration-none mb-2">On Time</span>
                                <?php else: ?>
                                    <?= $jam_terlambat . ' Jam ' . $menit_terlambat . ' Menit' ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                <tr>
                    <td colspan="7">Data tidak tersedia</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

<?= $this->endSection() ?>