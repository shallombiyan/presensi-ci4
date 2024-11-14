<?= $this->extend('pegawai/layout.php') ?>

<?= $this->section('content') ?>
<style>
  .parent-clock {
    display: grid;
    grid-template-columns: auto auto auto auto auto;
    font-size: 35px;
    font-weight: bold;
    justify-content: center;
  }
</style>

<div class="d-flex justify-content-center">
  <!-- Presensi Masuk -->
  <div class="col-md-4 me-3">
    <div class="card h-100">
      <div class="card-header">Presensi Masuk</div>
      <?php if ($cek_presensi < 1): ?>
      <div class="card-body text-center">
        <div class="fw-bold"><?= date('d F Y') ?></div>
        <div class="parent-clock">
          <div id="jam-masuk"></div>
          <div>:</div>
          <div id="menit-masuk"></div>
          <div>:</div>
          <div id="detik-masuk"></div>
        </div>
        <form method="post" action="<?= base_url('pegawai/presensi_masuk') ?>">
        <?php
          if ($lokasi_presensi['zona_waktu'] == 'WIB') {
            date_default_timezone_set('Asia/Jakarta');
          } elseif ($lokasi_presensi['zona_waktu'] == 'WITA') {
            date_default_timezone_set('Asia/Makassar');
          } elseif ($lokasi_presensi['zona_waktu'] == 'WIT') { 
            date_default_timezone_set('Asia/Jayapura');
          }
        ?>

          <input type="hidden" name="latitude_kantor" value="<?= $lokasi_presensi ['latitude'] ?>">
          <input type="hidden" name="longitude_kantor" value="<?= $lokasi_presensi ['longitude'] ?>">
          <input type="hidden" name="radius" value="<?= $lokasi_presensi ['radius'] ?>">


          <input type="hidden" name="latitude_pegawai" id="latitude_pegawai">
          <input type="hidden" name="longitude_pegawai" id="longitude_pegawai">

          <input type="hidden" name="jam_masuk" value="<?= date('H:i:s') ?>">
          <input type="hidden" name="tanggal_masuk" value="<?= date('Y-m-d') ?>">
          <input type="hidden" name="id_pegawai" value="<?= session()->get('id_pegawai') ?>">
          <button class="btn btn-primary mt-3">Masuk</button>
        </form>
      </div>
      <?php else: ?>
        <div class="card-body">
          <h5 class="text-center"><i class="fas fa-check-circle"></i> Anda telah melakukan presensi masuk</h5>
        </div>
      <?php endif; ?>
    </div>
  </div>

  <!-- Presensi Keluar -->
  <div class="col-md-4 ms-3">
    <div class="card">
      <div class="card-header">Presensi Keluar</div>
      <div class="card-body text-center">
        <div class="fw-bold"><?= date('d F Y') ?></div>
        <div class="parent-clock">
          <div id="jam-keluar"></div>
          <div>:</div>
          <div id="menit-keluar"></div>
          <div>:</div>
          <div id="detik-keluar"></div>
        </div>
        <form action="">
          <button class="btn btn-danger mt-3">Keluar</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  // Set interval to update the clock every second
  window.setInterval(waktuMasuk, 1000);

  function waktuMasuk() {

    const waktu = new Date();

    document.getElementById("jam-masuk").innerHTML = formatWaktu(waktu.getHours());
    document.getElementById("menit-masuk").innerHTML = formatWaktu(waktu.getMinutes());
    document.getElementById("detik-masuk").innerHTML = formatWaktu(waktu.getSeconds());

    document.getElementById("jam-keluar").innerHTML = formatWaktu(waktu.getHours());
    document.getElementById("menit-keluar").innerHTML = formatWaktu(waktu.getMinutes());
    document.getElementById("detik-keluar").innerHTML = formatWaktu(waktu.getSeconds());
  }
  function formatWaktu(waktu) {
    return waktu < 10 ? "0" + waktu : waktu;
  }

  getLocation();
  function getLocation(){
    if(navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(showPosition);
    }else{
      alert("Browser Anda tidak mendukung Geolocation");
    }
  }

  function showPosition(position){
    document.getElementById('latitude_pegawai').value = position.coords.latitude;
    document.getElementById('longitude_pegawai').value = position.coords.longitude;
  }
</script>
<?= $this->endSection() ?>