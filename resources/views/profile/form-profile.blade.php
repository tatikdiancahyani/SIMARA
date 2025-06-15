
<form method="POST" enctype="multipart/form-data" id="profile_setup_frm"
    action="{{ route('profile.update') }}">
    @csrf
    <div class="p-3 py-5">
        <h2>Informasi User</h2>
        
        <div class="form-group">
            <label for="profile_picture" class="labels">Upload New Profile Picture</label>
            <input type="file" name="profile_picture" id="profile_picture" class="form-control">
        </div>

        <!-- Input Data Pribadi -->
        <div class="row mt-2">
            <div class="col-md-6">
                <label class="labels">Name</label>
                <input type="text" name="name" class="form-control" placeholder="first name"
                    value="{{ auth()->user()->name }}">
            </div>
            <div class="col-md-6">
                <label class="labels">Email</label>
                <input type="text" name="email" disabled class="form-control" value="{{ auth()->user()->email }}"
                    placeholder="Email">
            </div>
        </div>

        <div class="mt-5 text-center">
            <button id="btn" class="btn btn-primary profile-button" type="submit">Save Profile</button>
        </div>
    </div>
</form>
