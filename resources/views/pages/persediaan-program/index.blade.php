<x-_layout>
  <x-slot:title>{{ $title }}</x-slot:title>
  <div class="mb-3">
    <a href="{{ url('dashboard/persediaan-program/create') }}" class="btn btn-primary">Tambah Data</a>
  </div>
  <!-- Filter Dropdowns -->
  <div class="m-2 ">Filter</div>
  <div class="row">
    <div class="col mb-3">
      <form id="filter-form" action="{{ url('dashboard/persediaan-program/filter') }}" method="POST" class="d-flex">
        @csrf
        <select id="jenis-select" name="jenis[]" class="jenis-select form-control mr-2" multiple="multiple">
          @foreach ($jenisOptions as $jenis)
            <option value="{{ $jenis }}">{{ $jenis }}</option>
          @endforeach
        </select>
        <select id="nama-sediaan-select" name="nama_sediaan[]" class="nama-sediaan-select form-control mr-2"
          multiple="multiple">
          @foreach ($namaSediaanOptions as $namaSediaan)
            <option value="{{ $namaSediaan }}">{{ $namaSediaan }}</option>
          @endforeach
        </select>
        <select id="masa-berlaku-select" name="masa_berlaku[]" class="masa-berlaku-select form-control mr-2"
          multiple="multiple">
          @foreach ($masaBerlakuOptions as $masaBerlaku)
            <option value="{{ $masaBerlaku }}">{{ timeUntil($masaBerlaku) }}</option>
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
              <th>Program</th>
              <th>Nama Sediaan</th>
              <th>Satuan</th>
              <th>Stok Tersedia</th>
              <th>Expired Date</th>
              <th>Masa Berlaku</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($data as $item)
              <tr>
                <td>
                  {{ $item->program }}
                </td>
                <td>{{ $item->nama_sediaan }}</td>
                <td>{{ $item->satuan }}</td>
                <td>{{ $item->stok }}</td>
                <td>{{ $item->expired_date }}</td>
                <td class="{{ getTimeUntilClass($item->expired_date) }}">{{ timeUntil($item->expired_date) }}</td>
                <td>
                  <div class="d-flex justify-content-center">
                    <!-- Tombol Edit -->
                    <a href="{{ url('dashboard/persediaan-program/' . hashidEncode($item->id) . '/edit') }}">
                      <button class="btn btn-primary">
                        <i class="far fa-edit"></i>
                      
                      </button>
                    </a>

                    <!-- Tombol Delete -->
                    <form action="{{ url('dashboard/persediaan-program/' . hashidEncode($item->id)) }}" method="POST"
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
        $('.jenis-select').select2({
          placeholder: 'Jenis',
          allowClear: true
        });
        $('.nama-sediaan-select').select2({
          placeholder: 'Nama Sediaan',
          allowClear: true
        });
        $('.masa-berlaku-select').select2({
          placeholder: 'Masa Berlaku',
          allowClear: true
        });

      });
    </script>
  @endpush

</x-_layout>
