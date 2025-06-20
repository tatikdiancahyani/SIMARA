@extends('layouts.app')

@section('contents')

<h1 class="mb-0">Profile Settings</h1>
<hr />

<div class="row">
    <div class="col-lg-6">
        @include('profile.form-password')
    </div>
</div>
</form>

@endsection
