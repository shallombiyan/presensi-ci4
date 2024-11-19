<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon" />
    <title><?= $title ?></title>

    <!-- ========== All CSS files linkup ========= -->
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?> " />
    <link rel="stylesheet" href="<?= base_url('assets/css/lineicons.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/css/materialdesignicons.min.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/css/fullcalendar.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/css/main.css') ?>" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
     crossorigin=""/>

     <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
     integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
     crossorigin=""></script>

  </head>
  <body>
    <!-- ======== Preloader =========== -->
    <div id="preloader">
      <div class="spinner"></div>
    </div>
    <!-- ======== Preloader =========== -->

    <!-- ======== sidebar-nav start =========== -->
    <aside class="sidebar-nav-wrapper">
    <div class="navbar-logo">
        <a href="index.html">
        <img style="width: 90%;" src="<?= base_url('assets/images/logo/logo-presensi.png') ?> " alt="logo" />
        </a>
    </div>
    <nav class="sidebar-nav">
        <ul>
        <li class="nav-item">
            <a href="dashboard.html" class="d-flex align-items-center">
            <i class="fas fa-tachometer-alt"></i> <!-- Ikon Dashboard -->
            <span class="text ms-2">Dashboard</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="<?= base_url('admin/data_pegawai') ?>" class="d-flex align-items-center">
            <i class="fas fa-users"></i> <!-- Ikon Data Pegawai -->
            <span class="text ms-2">Data Pegawai</span>
            </a>
        </li>

        <li class="nav-item nav-item-has-children">
          <a
            href="#0"
            class="d-flex align-items-center collapsed"
            data-bs-toggle="collapse"
            data-bs-target="#master"
            aria-controls="ddmenu_1"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <i class="fas fa-database"></i> <!-- Ikon Master Data -->
            <span class="text ms-2">Master Data</span>
          </a>
          <ul id="master" class="collapse dropdown-nav">
            <li>
              <a href="<?= base_url(('admin/jabatan')) ?>" class="d-flex align-items-center">
                <i class="fas fa-briefcase"></i> <!-- Ikon untuk Data Jabatan -->
                <span class="ms-2">Data Jabatan</span>
              </a>
            </li>
            <li>
              <a href="<?= base_url('admin/lokasi_presensi') ?>" class="d-flex align-items-center">
                <i class="fas fa-map-marker-alt"></i> <!-- Ikon untuk Lokasi Presensi -->
                <span class="ms-2">Lokasi Presensi</span>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item nav-item-has-children">
            <a
            href="#0"
            class="d-flex align-items-center collapsed"
            data-bs-toggle="collapse"
            data-bs-target="#ddmenu_1"
            aria-controls="ddmenu_1"
            aria-expanded="false"
            aria-label="Toggle navigation"
            >
            <i class="fas fa-file-alt"></i> <!-- Ikon Rekap Presensi -->
            <span class="text ms-2">Rekap Presensi</span>
            </a>
            <ul id="ddmenu_1" class="collapse dropdown-nav">
            <li>
                <a href="rekap-harian.html" class="d-flex align-items-center">
                <i class="fas fa-calendar-day"></i> <!-- Ikon Rekap Harian -->
                <span class="ms-2">Rekap Harian</span>
                </a>
            </li>
            <li>
                <a href="rekap-bulanan.html" class="d-flex align-items-center">
                <i class="fas fa-calendar-alt"></i> <!-- Ikon Rekap Bulanan -->
                <span class="ms-2">Rekap Bulanan</span>
                </a>
            </li>
            </ul>
        </li>

        <li class="nav-item">
            <a href="ketidakhadiran.html" class="d-flex align-items-center">
            <i class="fas fa-user-times"></i> <!-- Ikon Ketidakhadiran -->
            <span class="text ms-2">Ketidakhadiran</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="logout.html" class="d-flex align-items-center">
            <i class="fas fa-sign-out-alt"></i> <!-- Ikon Logout -->
            <span class="text ms-2">Logout</span>
            </a>
        </li>
        </ul>
    </nav>
    </aside>
    <div class="overlay"></div>
    <!-- ======== sidebar-nav end =========== -->



    <!-- ======== main-wrapper start =========== -->
    <main class="main-wrapper">
      <!-- ========== header start ========== -->
      <header class="header">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-5 col-md-5 col-6">
              <div class="header-left d-flex align-items-center">
                <div class="menu-toggle-btn mr-15">
                  <button id="menu-toggle" class="main-btn primary-btn btn-hover">
                    <i class="lni lni-chevron-left me-2"></i> Menu
                  </button>
                </div>
              </div>
            </div>
            <div class="col-lg-7 col-md-7 col-6">
              <div class="header-right">
                <!-- profile start -->
                <div class="profile-box ml-15">
                  <button class="dropdown-toggle bg-transparent border-0" type="button" id="profile"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="profile-info">
                      <div class="info">
                        <div class="image">
                          <img src="<?= base_url('assets/images/profile/profile-image.png') ?>" alt="" />
                        </div>
                        <div>
                          <h6 class="fw-500 text-uppercase"><?= session()->get('username') ?></h6>
                          <p><?= session()->get('role') ?></p>
                        </div>
                      </div>
                    </div>
                  </button>
                  <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profile">
                    <li>
                      <div class="author-info flex items-center !p-1">
                        <div class="image">
                          <img src="<?= base_url('assets/images/profile/profile-image.png') ?>" alt="image">
                        </div>
                        <div class="content">
                          <h4 class="text-sm">Adam Joe</h4>
                          <a class="text-black/40 dark:text-white/40 hover:text-black dark:hover:text-white text-xs"
                            href="#">Email@gmail.com</a>
                        </div>
                      </div>
                    </li>
                    <li class="divider"></li>
                    <li>
                      <a href="#0">
                        <i class="lni lni-user"></i> View Profile
                      </a>
                    </li>
                    <li>
                      <a href="#0">
                        <i class="lni lni-alarm"></i> Notifications
                      </a>
                    </li>
                    <li>
                      <a href="#0"> <i class="lni lni-inbox"></i> Messages </a>
                    </li>
                    <li>
                      <a href="#0"> <i class="lni lni-cog"></i> Settings </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                      <a href="#0"> <i class="lni lni-exit"></i> Sign Out </a>
                    </li>
                  </ul>
                </div>
                <!-- profile end -->
              </div>
            </div>
          </div>
        </div>
      </header>
      <!-- ========== header end ========== -->

      <!-- ========== section start ========== -->
      <section class="section">
        <div class="container-fluid">
          <!-- ========== title-wrapper start ========== -->
          <div class="title-wrapper pt-30">
            <div class="row align-items-center">
              <div class="col-md-6">
                <div class="title">
                  <h2><?= $title ?></h2>
                </div>
              </div>
            </div>
            <!-- end row -->
          </div>
          <!-- ========== title-wrapper end ========== -->
          <?= $this->renderSection('content') ?>
        </div>
        <!-- end container -->
      </section>
      <!-- ========== section end ========== -->

      <!-- ========== footer start =========== -->
      <footer class="footer">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-6 order-last order-md-first">
              <div class="copyright text-center text-md-start">
                <p class="text-sm">
                  Designed and Developed by
                  <a href="https://plainadmin.com" rel="nofollow" target="_blank">
                    PlainAdmin
                  </a>
                </p>
              </div>
            </div>
            <!-- end col-->
            <div class="col-md-6">
              <div class="terms d-flex justify-content-center justify-content-md-end">
                <a href="#0" class="text-sm">Term & Conditions</a>
                <a href="#0" class="text-sm ml-15">Privacy & Policy</a>
              </div>
            </div>
          </div>
          <!-- end row -->
        </div>
        <!-- end container -->
      </footer>
      <!-- ========== footer end =========== -->
    </main>
    <!-- ======== main-wrapper end =========== -->

    <!-- ========= All Javascript files linkup ======== -->
    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/jvectormap.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/polyfill.js') ?>"></script>
    <script src="<?= base_url('assets/js/main.js') ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    

    <script>
      $(document).ready( function () {
          $('#datatables').DataTable();
      } );

      $(function(){
        <?php if (session()->has('berhasil')) { ?>
            const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.onmouseenter = Swal.stopTimer;
              toast.onmouseleave = Swal.resumeTimer;
            }
          });
          Toast.fire({
            icon: "success",
            title: "<?= $_SESSION ['berhasil'] ?>"
          });
          <?php } ?>
      });

      $('.tombol-hapus').on('click', function(e){
          e.preventDefault(); // Mencegah link dieksekusi langsung
          var getLink = $(this).attr('href');

          Swal.fire({
              title: "Anda yakin ingin menghapus?",
              text: "Data yang anda hapus tidak akan bisa dikembalikan!",
              icon: "warning",
              showCancelButton: true,
              confirmButtonColor: "#3085d6",
              cancelButtonColor: "#d33",
              confirmButtonText: "Yes, delete it!"
          }).then((result) => {
              if (result.isConfirmed) {
                  window.location.href = getLink; // Redirect ke link setelah konfirmasi
                  Swal.fire({
                      title: "Deleted!",
                      text: "Your file has been deleted.",
                      icon: "success"
                  });
              }
          });
      });

    </script>
  </body>
</html>
