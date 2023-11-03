<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>{{ config('app.name') }}</title>
  <link rel="stylesheet" href="{{asset("assets/vendors/css/vendor.bundle.base.css")}}">
  <link rel="stylesheet" href="{{asset("assets/css/vertical-layout-light/style.css")}}">
</head>
<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <img style="display:block; margin-left: auto;margin-right: auto;" src="assets/images/logo.png" alt="logo">
              </div>
              <h4 class="text-center">Connexion agent</h4>
              @if(session()->get('inscri_success'))
              <div class="alert alert-success mg-b-0" role="alert">
                <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                  <span aria-hidden="true">&times;</span>
                </button>
                <strong>{{ session()->get('inscri_success') }}</strong>
              </div>
              @endif
              @if ($errors->any())
              <div class="alert alert-danger background-danger">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <i class="icofont icofont-close-line-circled text-white"></i>
                </button>
                @foreach ($errors->all() as $error)
                <strong>{{ $error }}</strong>
                @endforeach
              </div>
              @endif
              <form class="pt-3" action="{{ route('authenticate') }}" method="POST">
                @csrf
                <div class="form-group">
                  <input required maxlength="255" minlength="8" type="email" pattern="[^@]+@[^@]+\.[a-zA-Z]{2,6}" class="form-control form-control-lg" name="email" placeholder="Email">
                </div>
                <div class="form-group">
                  <input required maxlength="16" minlength="8" type="password" class="form-control form-control-lg" name="password" placeholder="Password">
                </div>
                <div class="mt-3">
                  <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" href="../../index.html">
                    CONNEXION
                  </button>
                </div>
                <div class="my-2 d-flex justify-content-between align-items-center">
                  <a href="{{ route('pass-oublie') }}" class="auth-link text-black">Mot de passe oublié ?</a>
                </div>
                <div class="text-center mt-4 font-weight-light">
                  Vous avez pas de compte ? <a href="{{ route('sinscrire') }}" class="text-primary">Inscription</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <link rel="stylesheet" href="{{asset("assets/vendors/css/vendor.bundle.base.css")}}">
</body>

</html>