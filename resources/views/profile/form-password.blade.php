<form method="POST" action="{{ route('profile.password') }}">
    @csrf
    <div class="p-3 py-5">

        <h2>Ganti Password</h2>
        <div class="form-group">
            <label for="current_password">Current Password</label>
            <input id="current_password" type="password"
                class="form-control @error('current_password') is-invalid @enderror" name="current_password" required
                autocomplete="current-password">
            @error('current_password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">New Password</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                name="password" required autocomplete="new-password">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirm New Password</label>
            <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required
                autocomplete="new-password">
        </div>

        <div class="mt-5 text-center">
            <button id="btn" class="btn btn-primary profile-button" type="submit">Change Password</button>
        </div>
</form>
