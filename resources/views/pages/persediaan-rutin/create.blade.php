<x-_layout>
  <x-slot:title>{{ $title }}</x-slot:title>
  <div class="mb-3">
    <a href="{{ url('dashboard/persediaan-rutin') }}" class="btn btn-primary">Kembali</a>
  </div>
  <!-- DataTables -->
  <div class="card shadow mb-4">
    <div class="card-body">
      <form action="{{ url('dashboard/persediaan-rutin') }}" method="post">
        @include('pages.persediaan-rutin._form', ['data' => old()])
      </form>
    </div>
  </div>


</x-_layout>
