<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>SB Admin 2 - Login</title>
  <!-- Custom fonts for this template-->
  <link href="{{ asset('admin_assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  
  <!-- Custom styles for this template-->
  <link href="{{ asset('admin_assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>
<style>
 /* Kurangi padding dalam form */
 .bg-login-image {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 50%; /* Pastikan tingginya sama dengan form */
  empty-cells: 30vh;dge-to-edge
  }


  .row {
    min-height: 100vh; /* Pastikan konten memenuhi tinggi layar */
  }
    /* Pastikan tinggi penuh untuk kontainer row */
  .row {
    height: 100vh; /* 100% tinggi layar */
    display: flex; /* Mengaktifkan Flexbox */
  }

  /* Optimalkan ukuran row */
  .row {
    max-width: 100%; /* Batasi ukuran row */
    margin: 0 auto; /* Pusatkan konten */
  }

  /* Kolom gambar */
  .bg-login-image {
    display: flex;
    justify-content: center;
    align-items: center;
  }
</style>
<body class="bg-gradient-primary">
  <div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center">
      <div class="col-xl-10 col-lg-12 col-md-9">
        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row align-items-center" style="height: 100vh;"> <!-- Flexbox dengan tinggi layar -->
              <!-- Kolom Gambar -->
              <div class="col-lg-6 bg-login-image d-flex justify-content-center align-items-center">
                <img src="{{ asset('foto/Logo.jpg') }}" alt="Login Image" class="img-fluid" style="max-height: 80%; max-width: 80%; object-fit: contain;">
              </div>

              <!-- Kolom Form Login -->
              <div class="col-lg-6 d-flex justify-content-center align-items-center">
                <div class="p-5 w-100" style="max-width: 400px;">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                  </div>
                  <form action="{{ route('login.action') }}" method="POST" class="user">
                    @csrf
                    @if ($errors->any())
                      <div class="alert alert-danger">
                        <ul>
                          @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                          @endforeach
                        </ul>
                      </div>
                    @endif
                    <div class="form-group">
                      <input name="email" type="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                    </div>
                    <div class="form-group">
                      <input name="password" type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input name="remember" type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Remember Me</label>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block btn-user">Login</button>
                  </form>
                  <hr>
                  {{-- <div class="text-center">
                    <a class="small" href="{{ route('register') }}">Create an Account!</a>
                  </div> --}}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Bootstrap core JavaScript-->
  <script src="{{ asset('admin_assets/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('admin_assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <!-- Core plugin JavaScript-->
  <script src="{{ asset('admin_assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
  <!-- Custom scripts for all pages-->
  <script src="{{ asset('admin_assets/js/sb-admin-2.min.js') }}"></script>
</body>
</html>
