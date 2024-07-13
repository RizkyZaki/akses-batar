<x-_layout>
  <x-slot:title>{{ $title }}</x-slot:title>
  <div class="mb-3">
    <a href="{{ url('dashboard/users/create') }}" class="btn btn-primary">Tambah Data</a>
  </div>
  <!-- DataTables -->
  <div class="card shadow mb-4">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataFormularium" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Nama</th>
              <th>Email</th>
              <th>Hak Akses</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($data as $item)
              <tr>
                <td>
                  {{ $item->name }}
                </td>
                <td>{{ $item->email }}</td>
                <td>{!! getRoleBadge($item->role) !!}</td>
                <td>
                  <div class="d-flex justify-content-center">
                    <!-- Tombol Edit -->
                    <a href="{{ url('dashboard/users/' . hashidEncode($item->id) . '/edit') }}"
                      class="mx-2">
                      <button class="btn btn-primary">
                        <i class="far fa-edit"></i>
                      </button>
                    </a>

                    <!-- Tombol Delete -->
                    <form action="{{ url('dashboard/users/' . hashidEncode($item->id)) }}" method="POST"
                      class="mx-2">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash-alt" style="color: #fff"></i>
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
