@extends('layouts.app')

@section('contents')

    <style>
        .img-profile {
            width: 150px; /* Ukuran gambar profil */
            height: 150px; /* Ukuran gambar profil */
            object-fit: cover; /* Agar gambar tetap dalam bentuk lingkaran */
            border-radius: 50%; /* Membuat gambar berbentuk bundar */
        }
    </style>
    <h1 class="mb-0">Profile Settings</h1>
    <hr />

    <form method="POST" enctype="multipart/form-data" id="profile_setup_frm" action="{{ route('profile.update') }}">
        @csrf
        <div class="row">
            <div class="col-md-12 border-right">
                <div class="p-3 py-5">

                    <!-- Tampilkan Gambar Profil -->
                    <div class="text-center mb-3">
                        <img 
                            src="{{ file_exists(public_path('storage/profile_pictures/' . auth()->id() . '/profile_picture.jpg')) 
                                    ? asset('storage/profile_pictures/' . auth()->id() . '/profile_picture.jpg') 
                                    : 'https://startbootstrap.github.io/startbootstrap-sb-admin-2/img/undraw_profile.svg' }}" 
                            class="img-profile rounded-circle" 
                            width="150"
                            alt="Profile Picture">
                    </div>

                    <!-- Input untuk Unggah Gambar -->
                    <div class="form-group">
                        <label for="profile_picture" class="labels">Upload New Profile Picture</label>
                        <input type="file" name="profile_picture" id="profile_picture" class="form-control">
                    </div>

                    <!-- Input Data Pribadi -->
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <label class="labels">Name</label>
                            <input type="text" name="name" class="form-control" placeholder="first name" value="{{ auth()->user()->name }}">
                        </div>
                        <div class="col-md-6">
                            <label class="labels">Email</label>
                            <input type="text" name="email" disabled class="form-control" value="{{ auth()->user()->email }}" placeholder="Email">
                        </div>
                    </div>
                    
                    <div class="mt-5 text-center">
                        <button id="btn" class="btn btn-primary profile-button" type="submit">Save Profile</button>
                    </div>
                </div>
            </div>
        </div>   
    </form>

@endsection