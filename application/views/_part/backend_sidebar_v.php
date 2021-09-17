<!-- Page Wrapper -->
<div id="wrapper">

  <!-- Sidebar -->
  <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
      <div class="sidebar-brand-icon rotate-n-15">
        <!-- <i class="fas fa-laugh-wink"></i> -->
      </div>
      <div class="sidebar-brand-text mx-3">Pelaporan <sup>PLN</sup></div>
    </a>
    
    <?php if ($this->session->userdata('level') == '1' OR $this->session->userdata('level') == '2') : ?>
    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
      <a class="nav-link" href="<?= base_url('Admin/DashboardController') ?>">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
      </li>
      <?php endif; ?>

      <!-- Divider -->
      <hr class="sidebar-divider mt-1 mb-0">

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item ">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-user"></i>
          <span>Profile</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?= base_url('User/ProfileController'); ?>">Profile Saya</a>
            <a class="collapse-item" href="<?= base_url('Auth/ChangePasswordController');  ?>">Ganti Password</a>
          </div>
        </div>
      </li>
      <!-- Divider -->
      <?php if($this->session->userdata('level') == '1') : ?>
      <hr class="sidebar-divider mt-1 mb-0">

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMaster" aria-expanded="true" aria-controls="collapseMaster">
          <i class="fas fa-user-cog"></i>
          <span>Master Data</span>
        </a>
        <div id="collapseMaster" class="collapse" aria-labelledby="headingMaster" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
              <a class="collapse-item" href="<?= base_url('Admin/UserController'); ?>">Master User</a>
              <a class="collapse-item" href="<?= base_url('Admin/UnitController'); ?>">Master Unit</a>
              <!-- <a class="collapse-item" href="<?= base_url('Admin/DeptController'); ?>">Master Department</a> -->
          </div>
        </div>
      </li>
      <?php endif; ?>


      <?php // form pengaduan diakses oleh masyarakat ?>
      <?php if ($this->session->userdata('nik') && $this->session->userdata('level') == '3') : ?>
        <hr class="sidebar-divider mt-1 mb-0">
      <!-- Nav Item - Utilities Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-search"></i>
          <span>Pelaporan</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?= base_url('Temuan/TemuanController'); ?>">Input Temuan</a>
            <a class="collapse-item" href="<?= base_url('Temuan/TemuanController/DaftarTemuan'); ?>">Daftar Temuan</a>
          </div>
        </div>
      </li>
    <?php endif; ?>
    <?php // end form pengaduan diakses oleh masyarakat ?>

    <?php // form pengaduan diakses oleh masyarakat ?>
      <?php if ($this->session->userdata('nik') && $this->session->userdata('level') == '2') : ?>
        <hr class="sidebar-divider mt-1 mb-0">
      <!-- Nav Item - Utilities Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-search"></i>
          <span>Pelaporan</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?= base_url('Temuan/MonitoringController/MonitoringTemuan'); ?>">Monitoring Temuan</a>
            <a class="collapse-item" href="<?= base_url('Temuan/MonitoringController/SummaryTemuan'); ?>">Summary Temuan</a>
          </div>
        </div>
      </li>
    <?php endif; ?>
    <?php // end form pengaduan diakses oleh masyarakat ?>

    <!-- Divider -->
    
    <?php // dropdown admin hanya oleh akun admin dan petugas ?>
    <?php if ( $this->session->userdata('level') == '2') : ?>
      <!-- Heading -->
      <!-- <div class="sidebar-heading">
        Admin
      </div> -->
      <hr class="sidebar-divider mt-1 mb-0">

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
        <i class="fas fa-user-cog"></i>
        <span>Moderator</span>
      </a>
      <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Temuan</h6>
          <a class="collapse-item" href="<?= base_url('Moderator/ModeratorController/moderatortemuan'); ?>">Temuan Masuk</a>
          <a class="collapse-item" href="<?= base_url('Moderator/ModeratorController/moderatoracc'); ?>">Temuan Disetujui</a>
          <a class="collapse-item" href="<?= base_url('Moderator/ModeratorController/moderatortolak'); ?>">Temuan Ditolak</a>
          <a class="collapse-item" href="<?= base_url('Moderator/ModeratorController/moderatordone'); ?>">Temuan Selesai</a>
          <div class="collapse-divider"></div>

          <?php // tambah petugas admin akses ?>
          <!-- <?php if ($this->session->userdata('level') == '1') : ?>
            <h6 class="collapse-header">Registrasi:</h6>
            <a class="collapse-item" href="<?= base_url('Admin/PetugasController'); ?>">Tambah Petugas</a>
          <?php endif; ?> -->
          <?php //end tambah petugas admin akses ?>


        </div>

      </div>
    </li>
  <?php endif; ?>
  <?php // end dropdown admin hanya oleh akun admin dan petugas ?>
  
  <?php if ($this->session->userdata('level') == '0') : ?>
  <hr class="sidebar-divider mt-1 mb-0">

  <?php // generate laporan akses admin ?>
  <!-- Nav Item - Generate Laporan -->
  <li class="nav-item">
    <a class="nav-link" href="<?= base_url('Admin/LaporanController'); ?>">
      <i class="fas fa-file-pdf"></i>
      <span>Generate Laporan</span></a>
    </li>
  <?php endif; ?>
  <?php // end generate laporan akses admin ?>

<hr class="sidebar-divider mt-1 mb-0">
    <!-- Nav Item - Logout -->
    <li class="nav-item">
      <a class="nav-link" href="<?= base_url('Auth/LogoutController'); ?>">
        <i class="fas fa-sign-out-alt"></i>
        <span>Logout</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->
