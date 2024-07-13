<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-2 text-gray-800">{{ $slot }}</h1>
  <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-book fa-sm text-white-50"></i> Panduan Penggunaan</a>
</div>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="index.html">{{ $slot }}</a>
    </li>
    {{-- <li class="breadcrumb-item active" aria-current="page">
      Formularium
    </li> --}}
  </ol>
</nav>