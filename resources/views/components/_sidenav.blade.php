@php
  use App\Enums\UserRole;
@endphp
<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('dashboard/overview') }}">
    <div class="sidebar-brand-icon rotate-n-15">
      <!-- <i class="fas fa-laugh-wink"></i> -->
    </div>
    <div class="d-flex px-2">
      <div class="sidebar-brand-icon mx-1">
        <img src="/assets/img/akses-logo-white.png" alt="" style="max-width: 35px" />
      </div>
      <div class="sidebar-brand-text my-auto">
        <img src="/assets/img/akses-text-logo-white.png" style="max-width: 100px" alt="" />
      </div>
    </div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0" />

  <!-- Nav Item - Dashboard -->
  <li class="nav-item active">
    <a class="nav-link" href="{{ url('dashboard/overview') }}">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider" />

  <!-- Heading -->

  <!-- Nav Item - Pages Collapse Menu -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="{{ url('dashboard/formularium') }}">
      <i class="fas fa-fw fa-database"></i>
      <span>Formularium</span>
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
      aria-controls="collapseOne">
      <i class="fas fa-boxes"></i>
      <span>Gudang</span>
    </a>
    <div id="collapseOne" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Persediaan</h6>
        <a class="collapse-item fitur-belum-tersedia" href="{{ url('dashboard/persediaan/gudang?type=rutin') }}">Rutin</a>
        <a class="collapse-item fitur-belum-tersedia" href="{{ url('dashboard/persediaan/gudang?type=program') }}">Program</a>
      </div>
    </div>
  </li>
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
      aria-controls="collapseTwo">
      <i class="fas fa-fw fa-table"></i>
      <span>Pelayanan</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Persediaan</h6>
        <a class="collapse-item fitur-belum-tersedia" href="{{ url('dashboard/persediaan/pelayanan?type=rutin') }}">Rutin</a>
        <a class="collapse-item fitur-belum-tersedia" href="{{ url('dashboard/persediaan/pelayanan?type=program') }}">Program</a>
      </div>
    </div>
  </li>
  <li class="nav-item" @guest hidden @endguest>
    <a class="nav-link collapsed fitur-belum-tersedia" href="{{ url('dashboard/users') }}">
      <i class="fas fa-fw fa-user"></i>
      <span>Pengguna</span>
    </a>
    <a class="nav-link collapsed" href="{{ url('dashboard/settings') }}">
      <i class="fas fa-fw fa-user"></i>
      <span>Pengaturan</span>
    </a>
  </li>

  {{-- <li class="nav-item">
    <a class="nav-link collapsed" href="/farmasi-klinis">
      <i class="fas fa-clinic-medical"></i>
      <span>Farmasi Klinis</span>
    </a>
  </li> --}}
  {{-- <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true"
      aria-controls="collapseFour">
      <i class="fas fa-fw fa-file-alt"></i>
      <span>Laporan</span>
    </a>
    <div id="collapseFour" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Laporan</h6>
        <a class="collapse-item" href="/reports-program-data">Program (Data)</a>
        <a class="collapse-item" href="/reports-rutin">Rutin</a>
        <a class="collapse-item" href="/reports-program">Program</a>
      </div>
    </div>
  </li> --}}

  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block" />

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>
</ul>
<!-- End of Sidebar -->

<!-- jQuery -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).on('click', '.fitur-belum-tersedia', function (e) {
        e.preventDefault();
        Swal.fire({
            icon: 'info',
            title: 'Fitur Belum Tersedia',
            text: 'Maaf, fitur ini masih dalam tahap pengembangan. Nantikan update selanjutnya ya!',
            confirmButtonText: 'Oke'
        });
    });
</script>
