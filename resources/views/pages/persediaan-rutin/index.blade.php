<x-_layout>
  <x-slot:title>{{ $title }}</x-slot:title>
  <div class="mb-3">
    <a href="{{ url('dashboard/persediaan-rutin/create') }}" class="btn btn-primary">Tambah Data</a>
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


</x-_layout>
