<x-_layout>
  <x-slot:title>{{ $title }}</x-slot:title>
  <div class="mb-3">
    <a href="{{ url('dashboard/persediaan-program') }}" class="btn btn-primary">Kembali</a>
  </div>
  <!-- DataTables -->
  <div class="card shadow mb-4">
    <div class="card-body">
      <form action="{{ url('dashboard/persediaan-program/' . hashidEncode($data->id)) }}" method="post">
        @method('PUT')
        @include('pages.persediaan-program._form', ['data' => $data])
      </form>
    </div>
  </div>


</x-_layout>
