<x-_layout>
  <x-slot:title>{{ $title }}</x-slot:title>
  <div class="mb-3">
    <a href="javascript:void(0);" class="btn btn-primary create">Tambah Data</a>
  </div>
  <!-- Filter Dropdowns -->
  <div class="m-2 ">Filter</div>
  <div class="row">
    <div class="col mb-3">
      <form id="filter-form" action="{{ url('dashboard/persediaan/filter') }}" method="POST" class="d-flex">
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
        <table class="table table-bordered" id="data-persediaan-gudang-rutin" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
              <th>Program</th>
              <th>Nama Sediaan</th>
              <th>Satuan</th>
              <th>Stok Tersedia</th>
              <th>Expired Date</th>
              <th>Masa Berlaku</th>
              <th>Aksi</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>
  <div class="modal fade" id="add-modal" tabindex="-1" role="dialog" aria-labelledby="add-moda-Title"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="add-moda-Title">Tambah Persediaan Rutin</h5>
          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3"><label for="name">Jenis</label><input class="form-control" name="name"
                  type="text" placeholder="Jenis"></div>
            </div>
            <div class="col-md-6">
              <div class="mb-3"><label for="nama_sediaan">Nama Sediaan</label><input class="form-control"
                  name="nama_sediaan" type="text"></div>
            </div>
            <div class="col-md-6">
              <div class="mb-3"><label for="satuan">Satuan</label><input class="form-control" name="satuan"
                  type="text"></div>
            </div>
            <div class="col-md-6">
              <div class="mb-3"><label for="stok">Stok Masuk</label><input class="form-control" name="stok"
                  type="number"></div>
            </div>
            <div class="col-md-12">
              <div class="mb-3"><label for="type-select">Tanggal Kadaluarsa</label>
                <input class="form-control" name="expired_date" type="date">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer"><button class="btn btn-primary add" type="button">Simpan</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="change-modal" tabindex="-1" role="dialog" aria-labelledby="change-moda-Title"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="change-moda-Title">Ubah Persediaan Rutin</h5>
          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6">
              <input type="hidden" name="id">
              <div class="mb-3"><label for="name">Jenis</label><input class="form-control" name="name"
                  type="text" placeholder="Jenis"></div>
            </div>
            <div class="col-md-6">
              <div class="mb-3"><label for="nama_sediaan">Nama Sediaan</label><input class="form-control"
                  name="nama_sediaan" type="text"></div>
            </div>
            <div class="col-md-6">
              <div class="mb-3"><label for="satuan">Satuan</label><input class="form-control" name="satuan"
                  type="text"></div>
            </div>
            <div class="col-md-6">
              <div class="mb-3"><label for="stok">Stok Masuk</label><input class="form-control" name="stok"
                  type="number"></div>
            </div>
            <div class="col-md-12">
              <div class="mb-3"><label for="type-select">Tanggal Kadaluarsa</label>
                <input class="form-control" name="expired_date" type="date">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer"><button class="btn btn-primary update" type="button">Simpan</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="stok-modal" tabindex="-1" role="dialog" aria-labelledby="stok-moda-Title"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="stok-moda-Title">Stok Persediaan Rutin</h5>
          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <div class="mb-3"><label for="type-select">Stok Keluar</label>
                <input class="form-control" name="stok" type="number">
                <input type="hidden" name="id">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer"><button class="btn btn-primary out" type="button">Simpan</button>
        </div>
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
    <script src="{{ asset('custom/js/persediaan/gudang/rutin.js') }}"></script>
    <script src="{{ asset('custom/js/utils/delete.js') }}"></script>
  @endpush

</x-_layout>
