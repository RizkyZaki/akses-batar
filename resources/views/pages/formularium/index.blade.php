<x-_layout>
  <x-slot:title>{{ $title }}</x-slot:title>
  <div class="mb-3">
    <a href="{{ url('dashboard/formularium/create') }}" class="btn btn-primary">Tambah Data</a>
  </div>
  <!-- Filter Dropdowns -->
  <div class="m-2 ">Filter</div>
  <div class="row">
    <div class="col mb-3">
      <form id="filter-form" action="{{ url('dashboard/formularium/filter') }}" method="POST" class="d-flex">
        @csrf
        <select id="kelas-terapi-select" name="kelas_terapi[]" class="kelas-terapi-select form-control mr-2" multiple="multiple">
  @foreach ($kelasTerapiOptions as $kelasTerapi)
    <option value="{{ $kelasTerapi }}"
      {{ in_array($kelasTerapi, old('kelas_terapi', request('kelas_terapi', []))) ? 'selected' : '' }}>
      {{ $kelasTerapi }}
    </option>
  @endforeach
</select>

<select id="sub-kelas-terapi-select" name="sub_kelas_terapi[]" class="sub-kelas-terapi-select form-control mr-2" multiple="multiple">
  @foreach ($subKelasTerapiOptions as $subKelasTerapi)
    <option value="{{ $subKelasTerapi }}"
      {{ in_array($subKelasTerapi, old('sub_kelas_terapi', request('sub_kelas_terapi', []))) ? 'selected' : '' }}>
      {{ $subKelasTerapi }}
    </option>
  @endforeach
</select>

<select id="nama-sediaan-select" name="nama_sediaan[]" class="nama-sediaan-select form-control mr-2" multiple="multiple">
  @foreach ($namaSediaanOptions as $namaSediaan)
    <option value="{{ $namaSediaan }}"
      {{ in_array($namaSediaan, old('nama_sediaan', request('nama_sediaan', []))) ? 'selected' : '' }}>
      {{ $namaSediaan }}
    </option>
  @endforeach
</select>
        <button type="submit" class="btn btn-primary my-auto">Filter</button>
      </form>
    </div>
  </div>

  <!-- DataTables -->
  <div class="card shadow mb-4">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataFormularium" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Kelas Terapi</th>
              <th>Sub Kelas Terapi</th>
              <th>Nama Generik & Kekuatan Sediaan</th>
              <th>Peresepan Maksimal</th>
              <th>Keterangan</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($data as $item)
              <tr>
                <td>{{ $item->kelas_terapi }}</td>
                <td>{{ $item->sub_kelas_terapi }}</td>
                <td>{{ $item->nama_sediaan }}</td>
                <td>{{ $item->peresepan_maksimal }}</td>
                <td>{{ $item->keterangan }}</td>
                <td>
                  <div class="d-flex justify-content-center">
                    <!-- Tombol Edit -->
                    <a href="{{ url('dashboard/formularium/' . hashidEncode($item->id) . '/edit') }}">
                      <button class="btn btn-primary">
                        <i class="far fa-edit"></i>
                      
                      </button>
                    </a>

                    <!-- Tombol Delete -->
                    <form action="{{ url('dashboard/formularium/' . hashidEncode($item->id)) }}" method="POST"
                      class="mx-2">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash-alt" style="color: #ffffff"></i>
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
            @endforeach

          </tbody>
        </table>
      </div>
    </div>
  </div>
  @push('customJs')
    <script>
      $(document).ready(function() {
        $('.kelas-terapi-select').select2({
          placeholder: 'Kelas Terapi',
          allowClear: true
        });
        $('.sub-kelas-terapi-select').select2({
          placeholder: 'Sub Kelas Terapi',
          allowClear: true
        });
        $('.nama-sediaan-select').select2({
          placeholder: 'Nama Generik & Kekuatan Sediaan',
          allowClear: true
        });

      });
    </script>
  @endpush

</x-_layout>
