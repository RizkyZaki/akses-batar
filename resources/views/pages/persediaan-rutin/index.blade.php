<x-_layout>
  <x-slot:title>{{ $title }}</x-slot:title>
  <div class="mb-3">
    <a href="{{ url('dashboard/persediaan-rutin/create') }}" class="btn btn-primary">Tambah Data</a>
  </div>
<!-- Filter Dropdowns -->
<div class="m-2 ">Filter</div>
<div class="d-flex mb-3">
  <select id="jenis-select" class="jenis-select form-control" multiple="multiple">
    @foreach ($jenisOptions as $jenis)
      <option value="{{ $jenis }}">{{ $jenis }}</option>
    @endforeach
  </select>
  <select id="nama-sediaan-select" class="nama-sediaan-select form-control" multiple="multiple">
    @foreach ($namaSediaanOptions as $namaSediaan)
      <option value="{{ $namaSediaan }}">{{ $namaSediaan }}</option>
    @endforeach
  </select>
  <select id="masa-berlaku-select" class="masa-berlaku-select form-control" multiple="multiple">
    @foreach ($masaBerlakuOptions as $masaBerlaku)
      <option value="{{ $masaBerlaku }}">{{ $masaBerlaku }}</option>
    @endforeach
  </select>
</div>

  <!-- DataTables -->
  <div class="card shadow mb-4">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataFormularium" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Jenis</th>
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
                  {{ $item->jenis }}
                </td>
                <td>{{ $item->nama_sediaan }}</td>
                <td>{{ $item->satuan }}</td>
                <td>{{ $item->stok }}</td>
                <td>{{ $item->expired_date }}</td>
                <td>{{ timeUntil($item->expired_date) }}</td>
                <td>
                  <div class="d-flex justify-content-center">
                    <!-- Tombol Edit -->
                    <a href="{{ url('dashboard/persediaan-rutin/' . hashidEncode($item->id) . '/edit') }}"
                      class="mx-2">
                      <i class="fas fa-pen" style="color: #ffd43b"></i>
                    </a>

                    <!-- Tombol Delete -->
                    <form action="{{ url('dashboard/persediaan-rutin/' . hashidEncode($item->id)) }}" method="POST"
                      class="mx-2">
                      @csrf
                      @method('DELETE')
                      <button type="submit" style="border: none; background: none;">
                        <i class="fas fa-trash-alt" style="color: #fc1d1d"></i>
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

  {{-- <script>
    $(document).ready(function() {
  // Inisialisasi Select2 dengan opsi multiple
  $('.jenis-select, .nama-sediaan-select, .masa-berlaku-select').select2({
    placeholder: 'Pilih opsi...',
    allowClear: true
  });

  // Menangani perubahan pada Select2 untuk filtering
  $('.jenis-select, .nama-sediaan-select, .masa-berlaku-select').on('change', function() {
    var jenis = $('.jenis-select').val();
    var namaSediaan = $('.nama-sediaan-select').val();
    var masaBerlaku = $('.masa-berlaku-select').val();

    // Lakukan filtering data sesuai dengan nilai yang dipilih
    var table = $('#dataFormularium').DataTable();
    table.columns(0).search(jenis ? '^' + jenis.join('|') + '$' : '', true, false);
    table.columns(1).search(namaSediaan ? '^' + namaSediaan.join('|') + '$' : '', true, false);
    table.columns(5).search(masaBerlaku ? '^' + masaBerlaku.join('|') + '$' : '', true, false);
    table.draw();
  });
});
  </script> --}}


</x-_layout>
