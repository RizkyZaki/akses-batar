<x-_layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="mb-3">
        <a href="{{ url()->previous() }}" class="btn btn-primary">Kembali</a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            @if (session()->has('success'))
                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                    <strong>{{ session('success') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{ session('error') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <form method="POST" action="{{ url('dashboard/settings') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="app_name">Nama Aplikasi / Instansi</label>
                            <input class="form-control @error('app_name') is-invalid @enderror" name="app_name"
                                id="app_name" value="{{ old('app_name', appSetting()->app_name ?? '') }}"
                                type="text" placeholder="Masukkan Nama Aplikasi">
                            @error('app_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email">Email</label>
                            <input class="form-control @error('email') is-invalid @enderror" name="email"
                                id="email" value="{{ old('email', appSetting()->email ?? '') }}" type="email"
                                placeholder="Masukkan Email">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="phone">No. Telepon</label>
                            <input class="form-control @error('phone') is-invalid @enderror" name="phone"
                                id="phone" value="{{ old('phone', appSetting()->phone ?? '') }}" type="text"
                                placeholder="Masukkan Nomor Telepon">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="logo">Logo</label>
                            <input class="form-control @error('logo') is-invalid @enderror" name="logo"
                                id="logo" type="file" accept="image/*">
                            @error('logo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            @if (!empty(appSetting()->logo))
                                <div class="mt-2">
                                    <img src="{{ asset('storage/img/' . appSetting()->logo) }}" alt="Logo"
                                        style="height: 60px;">
                                </div>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="address">Alamat</label>
                            <textarea class="form-control @error('address') is-invalid @enderror" name="address" id="address" rows="4"
                                placeholder="Masukkan Alamat">{{ old('address', appSetting()->address ?? '') }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="footer_text">Teks Footer</label>
                            <textarea class="form-control @error('footer_text') is-invalid @enderror" name="footer_text" id="footer_text"
                                rows="2" placeholder="Masukkan Teks Footer">{{ old('footer_text', appSetting()->footer_text ?? '') }}</textarea>
                            @error('footer_text')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mt-3">
                    <button class="btn btn-secondary" type="submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</x-_layout>
