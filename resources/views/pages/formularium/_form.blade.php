@csrf
<div class="row">
  <div class="col-md-6">
    <div class="mb-3"><label for="kelas_terapi">Kelas Terapi</label>
      <input class="form-control form-control @error('kelas_terapi') is-invalid @enderror" name="kelas_terapi" id="kelas_terapi"
        value="{{ $data['kelas_terapi'] ?? '' }}" type="text" placeholder="Masukkan Kelas Terapi">
      @error('kelas_terapi')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
      @enderror
    </div>
    <div class="mb-3"><label for="sub_kelas_terapi">Sub Kelas Terapi</label>
      <input class="form-control form-control @error('sub_kelas_terapi') is-invalid @enderror" name="sub_kelas_terapi" id="sub_kelas_terapi"
        value="{{ $data['sub_kelas_terapi'] ?? '' }}" type="text" placeholder="Masukkan Sub Kelas Terapi">
      @error('sub_kelas_terapi')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
      @enderror
    </div>
  </div>
  <div class="col-md-6">
    <div class="mb-3"><label for="nama_sediaan">Nama Sediaan</label>
      <input class="form-control form-control @error('nama_sediaan') is-invalid @enderror" name="nama_sediaan"
        id="nama_sediaan" value="{{ $data['nama_sediaan'] ?? '' }}" type="text" placeholder="Masukkan Nama Sediaan">
      @error('nama_sediaan')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
      @enderror
    </div>
    <div class="mb-3"><label for="peresepan_maksimal">Peresepan Maksimal</label>
      <input class="form-control form-control @error('peresepan_maksimal') is-invalid @enderror" name="peresepan_maksimal" id="peresepan_maksimal"
        value="{{ $data['peresepan_maksimal'] ?? '' }}" type="text" placeholder="Masukkan Peresepan Maksimal">
      @error('peresepan_maksimal')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
      @enderror
    </div>
  </div>
  <div class="col-md-12">

    <div class="mb-3"><label for="keterangan">Keterangan</label>
      <input class="form-control form-control @error('keterangan') is-invalid @enderror" name="keterangan" id="keterangan"
        value="{{ $data['keterangan'] ?? '' }}" type="text" placeholder="Masukkan Keterangan">
      @error('keterangan')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
      @enderror
    </div>
  </div>
  <button class="btn btn-secondary" type="submit">Simpan</button>
</div>
