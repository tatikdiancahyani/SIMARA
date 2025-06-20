<form method="POST" action="{{ route('profile.password') }}">
    @csrf
    <div class="p-4" style="max-width: 500px; margin: auto;">

        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" name="name" class="form-control"
                value="{{ auth()->user()->name }}" placeholder="Nama Lengkap">
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="text" name="email" class="form-control"
                value="{{ auth()->user()->email }}" disabled>
        </div>

        <div class="mb-3">
            <label class="form-label">Password Saat Ini</label>
            <input id="current_password" type="password"
                class="form-control @error('current_password') is-invalid @enderror"
                name="current_password" required autocomplete="current-password">
            @error('current_password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Password Baru</label>
            <input id="password" type="password"
                class="form-control @error('password') is-invalid @enderror"
                name="password" required autocomplete="new-password">
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label class="form-label">Konfirmasi Password Baru</label>
            <input id="password_confirmation" type="password"
                class="form-control" name="password_confirmation"
                required autocomplete="new-password">
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary px-4">Simpan Perubahan</button>
        </div>
    </div>
</form>
