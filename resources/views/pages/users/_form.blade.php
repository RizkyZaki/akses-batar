@csrf
<div class="row">
  <div class="col-md-6">
    <div class="mb-3"><label for="">Nama</label>
      <input class="form-control form-control @error('name') is-invalid @enderror" name="name" id="name"
        value="{{ $data['name'] ?? '' }}" type="text" placeholder="Masukkan Nama">
      @error('name')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
      @enderror
    </div>
    <div class="mb-3"><label for="email">Email</label>
      <input class="form-control form-control @error('email') is-invalid @enderror" name="email" id="email"
        value="{{ $data['email'] ?? '' }}" type="email" placeholder="Masukkan Email">
      @error('email')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
      @enderror

    </div>
  </div>
  <div class="col-md-6">
    <div class="mb-3"><label for="password">Password</label>
      <input class="form-control form-control @error('password') is-invalid @enderror" name="password" id="password"
        value="{{ $data['password'] ?? '' }}" type="text" placeholder="Masukkan password">
      @error('password')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
      @enderror
    </div>
    <div class="mb-3"><label for="stok">Hak Akses</label>
      <select id="nama-sediaan-select" name="role" class="nama-sediaan-select form-control">
        <option value="2">Manajemen Farmasi </option>
        <option value="3">Pemeriksa Kesehatan</option>
      </select>
      @error('role')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
      @enderror
    </div>
  </div>
  <button class="btn btn-secondary" type="submit">Simpan</button>
</div>
