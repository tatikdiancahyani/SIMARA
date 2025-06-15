@extends('layouts.app')

@section('contents')

<h1 class="mb-0">Profile Settings</h1>
<hr />
<style>
    .img-profile {
        width: 150px;
        /* Ukuran gambar profil */
        height: 150px;
        /* Ukuran gambar profil */
        object-fit: cover;
        /* Agar gambar tetap dalam bentuk lingkaran */
        border-radius: 50%;
        /* Membuat gambar berbentuk bundar */
    }

</style>

<!-- Tampilkan Gambar Profil -->
<div class="text-center mb-3">
    <img src="{{ file_exists(public_path('storage/profile_pictures/' . auth()->id() . '/profile_picture.jpg')) 
                                    ? asset('storage/profile_pictures/' . auth()->id() . '/profile_picture.jpg') 
                                    : 'https://startbootstrap.github.io/startbootstrap-sb-admin-2/img/undraw_profile.svg' }}"
        class="img-profile rounded-circle" width="150" alt="Profile Picture">

    @if(session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
</div>
<div class="row">
    <div class="col-lg-6">
        @include('profile.form-profile')
    </div>
    <div class="col-lg-6">
        @include('profile.form-password')
    </div>
</div>
</form>

@endsection
