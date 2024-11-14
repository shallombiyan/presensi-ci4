<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon" />
    <title><?= $title ?></title>

    <!-- ========== All CSS files linkup ========= -->
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?> " />
    <link rel="stylesheet" href="<?= base_url('assets/css/lineicons.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/css/materialdesignicons.min.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/css/fullcalendar.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/css/main.css') ?>" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

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
            <a href="data-pegawai.html" class="d-flex align-items-center">
            <i class="fas fa-file-alt"></i> <!-- Ikon Data Pegawai -->
            <span class="text ms-2">Rekap Presensi</span>
            </a>
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
            <div class="col-md-6 mx-auto">
                <div class="copyright text-center">
                <p class="text-sm">
                    Made In Heaven by
                    <a href="https://www.instagram.com/shallombiyan/" rel="nofollow" target="_blank">
                    Me
                    </a>
                </p>
                </div>
            </div>
            <!-- end col-->
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
      $(function(){
        <?php if (session()->has('gagal')) { ?>
          Swal.fire({
          icon: "error",
          title: "Oops...",
          text: "<?= session()->get('gagal') ?>",
        });
          <?php } ?>
      });
    </script>

  </body>
</html>
