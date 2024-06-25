@csrf
<div class="row">
  <div class="col-md-6">
    <div class="mb-3"><label for="name">Jenis</label>
      <input class="form-control form-control @error('jenis') is-invalid @enderror" name="jenis" id="jenis"
        value="{{ $data['jenis'] ?? '' }}" type="text" placeholder="Masukkan Jenis">
      @error('jenis')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
      @enderror
    </div>
    <div class="mb-3"><label for="nama_sediaan">Nama Sediaan</label>
      <input class="form-control form-control @error('nama_sediaan') is-invalid @enderror" name="nama_sediaan"
        id="nama_sediaan" value="{{ $data['nama_sediaan'] ?? '' }}" type="text" placeholder="Masukkan Nama Sediaan">
      @error('nama_sediaan')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
      @enderror

    </div>
  </div>
  <div class="col-md-6">
    <div class="mb-3"><label for="satuan">Satuan</label>
      <input class="form-control form-control @error('satuan') is-invalid @enderror" name="satuan" id="satuan"
        value="{{ $data['satuan'] ?? '' }}" type="text" placeholder="Masukkan Satuan">
      @error('satuan')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
      @enderror
    </div>
    <div class="mb-3"><label for="stok">Stok Sediaan</label>
      <input class="form-control form-control @error('stok') is-invalid @enderror" name="stok" id="stok"
        value="{{ $data['stok'] ?? '' }}" type="text" placeholder="Masukkan Stok Sediaan">
      @error('stok')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
      @enderror
    </div>
  </div>
  <div class="col-md-12">

    <div class="mb-3"><label for="expired_date">Tanggal Kadaluarsa</label>
      <input class="form-control form-control @error('expired_date') is-invalid @enderror" name="expired_date"
        id="expired_date" type="date" value="{{ $data['expired_date'] ?? '' }}">
      @error('expired_date')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
      @enderror
    </div>
  </div>

  <div class="col-md-3">
    <button class="btn btn-secondary" type="submit">Simpan</button>
  </div>
</div>
