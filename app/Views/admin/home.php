<?= $this->extend('admin/layout.php') ?>

<?= $this->section('content') ?>

<div class="row">
  <div class="col-xl-3 col-lg-4 col-sm-6">
    <div class="icon-card mb-30">
      <div class="icon purple">
        <i class="lni lni-users"></i> <!-- Mengganti ikon untuk total pegawai -->
      </div>
      <div class="content">
        <h6 class="mb-10">Total Pegawai</h6>
        <h3 class="text-bold mb-10">0</h3>
      </div>
    </div>
    <!-- End Icon Card -->
  </div>
  <!-- End Col -->
  <div class="col-xl-3 col-lg-4 col-sm-6">
    <div class="icon-card mb-30">
      <div class="icon success">
        <i class="lni lni-checkmark-circle"></i> <!-- Mengganti ikon untuk hadir -->
      </div>
      <div class="content">
        <h6 class="mb-10">Hadir</h6>
        <h3 class="text-bold mb-10">0</h3>
      </div>
    </div>
    <!-- End Icon Card -->
  </div>
  <!-- End Col -->
  <div class="col-xl-3 col-lg-4 col-sm-6">
    <div class="icon-card mb-30">
      <div class="icon primary">
        <i class="lni lni-close"></i> <!-- Mengganti ikon untuk alpha -->
      </div>
      <div class="content">
        <h6 class="mb-10">Alpha</h6>
        <h3 class="text-bold mb-10">0</h3>
      </div>
    </div>
    <!-- End Icon Card -->
  </div>
  <!-- End Col -->
  <div class="col-xl-3 col-lg-4 col-sm-6">
    <div class="icon-card mb-30">
      <div class="icon orange">
        <i class="lni lni-calendar"></i> <!-- Mengganti ikon untuk cuti/izin/sakit -->
      </div>
      <div class="content">
        <h6 class="mb-10">Cuti/Izin/Sakit</h6>
        <h3 class="text-bold mb-10">0</h3>
      </div>
    </div>
    <!-- End Icon Card -->
  </div>
  <!-- End Col -->
</div>

<?= $this->endSection() ?>