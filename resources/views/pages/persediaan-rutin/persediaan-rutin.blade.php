<x-_layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="mb-3">
        <a href="/tambah-persediaan-rutin" class="btn btn-primary">Tambah Data</a>
    </div>
    <!-- DataTables -->
<div class="card shadow mb-4">
    <div class="card-body">
      <div class="table-responsive">
        <table
          class="table table-bordered"
          id="dataFormularium"
          width="100%"
          cellspacing="0"
        >
          <thead>
            <tr>
              <th>Kelas Terapi</th>
              <th>Sub-Kelas Terapi</th>
              <th>Nama Generik & Kekuatan Sediaan</th>
              <th>Penerapan Maksimal</th>
              <th>Keterangan</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>Kelas Terapi</th>
              <th>Sub-Kelas Terapi</th>
              <th>Nama Generik & Kekuatan Sediaan</th>
              <th>Penerapan Maksimal</th>
              <th>Keterangan</th>
              <th>Aksi</th>
            </tr>
          </tfoot>
          <tbody>
            <tr>
              <td>
                Analgetik, Anti Piretik, Anti Inflamasi Non Steroid
                (AINS)
              </td>
              <td>Analgetik Non Narkotik</td>
              <td>Natrium diklofenak 25 mg</td>
              <td>30 tab/bulan</td>
              <td>-</td>
              <td>
                <div class="">
                  <a href="edit.html" class="mx-auto">
                    <i class="fas fa-pen" style="color: #ffd43b"></i
                  ></a>
                  <a href="delete.html" class="mx-auto"
                    ><i
                      class="fas fa-trash-alt"
                      style="color: #fc1d1d"
                    ></i
                  ></a>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</x-_layout>