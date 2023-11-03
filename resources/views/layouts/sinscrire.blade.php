<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>{{ config('app.name') }}</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{asset('assets/vendors/css/vendor.bundle.base.css')}}">
  <link rel="stylesheet" href="{{asset('assets/vendors/css/vendor.bundle.base.css')}}">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{asset('assets/css/vertical-layout-light/style.css')}}">
  <!-- endinject -->

</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <img style="display:block; margin-left: auto;margin-right: auto; height:50px;width:50;" src="assets/images/logo.png" alt="logo">
              </div>
              <h4 class="text-center">Inscription agent</h4>
              <div id="response"></div>
              <form  class="pt-3" id="inscription_form" method="POST">
                @csrf
                <div class="form-group">
                  <input required type="text" class="form-control form-control-lg" maxlength="30" minlength="2" name="nom" id="nom" placeholder="Nom">
                </div>
                <div class="form-group">
                  <input required type="text" class="form-control form-control-lg" maxlength="50" minlength="2" name="prenoms" id="prenoms" placeholder="Prénoms">
                </div>
                <div class="form-group">
                  <input required type="text" class="form-control form-control-lg" maxlength="10" minlength="10" name="telephone" id="telephone" placeholder="Téléphone">
                </div>
                <div class="form-group">
                  <input required type="email" pattern="[^@]+@[^@]+\.[a-zA-Z]{2,6}" class="form-control form-control-lg" maxlength="255" minlength="8" name="email" id="email" placeholder="Email">
                </div>
                <div class="input-group form-group">
                  <span class='message'></span>
                  <input style="border-right: none !important;" required type="password" class="form-control form-control-lg col-11" maxlength="16" id="password" minlength="8" name="password" placeholder="Mot de passe">
                  <a style="border-left: none !important;" href="javascript:;" onclick="showPassord()" id="show_hide_password" class="form-control col-1 text-center">
                    <i class="mdi mdi-eye" id="eye"></i>
                    <i class="mdi mdi-eye-off" id="eye_slash" style="display: none;"></i>
                  </a>
                </div>
                <div class="form-group">
                  <span class='message'></span>
                  <input required type="password" class="form-control form-control-lg" name="confirmation_password" id="confirmation_password" placeholder="Confirmé mot de passe">
                </div>
                <div class="mt-3">
                  <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" href="../../index.html">
                    S'INSCRIRE
                  </button>
                </div>
                <div class="my-2 d-flex justify-content-between align-items-center">
                  <a href="#" class="auth-link text-black">Mot de passe oublié ?</a>
                </div>
                <div class="text-center mt-4 font-weight-light">
                  Vous avez un compte? <a href="{{ route('login') }}" class="text-primary">Connectez-vous</a>
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
  <!-- container-scroller -->
  <!-- plugins:js -->
 
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="{{asset('assets/js/jquery-1.11.3.min.js')}}"></script>
  <script>
      function showPassord() {
            var x = document.getElementById("password");
            var eye_slash = document.getElementById("eye_slash");
            var eye = document.getElementById("eye");

            if (x.type === "password") {
                eye_slash.style.display = "block";
                eye.style.display = "none";
                x.type = "text";
            } else {
                eye.style.display = "block";
                eye_slash.style.display = "none";
                x.type = "password";
            }
        }

    $('#inscription_form').submit(function(event) {
      event.preventDefault();
       // alert('bam');
      let password = $("#password").val();
      let email = $("#email").val();
      let nom = $("#nom").val();
      let prenoms = $("#prenoms").val();
      let telephone = $("#telephone").val();
      let confirmation_password = $("#confirmation_password").val();
      let _token = $("input[name=_token]").val();
      //alert(telephone);
      if (password == '' || password === undefined) {
        $('#response').append("<div  class='alert alert-danger text-center'>Veuillez saisir le mot de passe<button type='button' class='close text-danger' data-dismiss='alert' aria-hidden='true'>×</button></div></div>")
      } else if (nom == '' || nom === undefined) {
        $('#response').append("<div  class='alert alert-danger text-center'>Veuillez saisir le nom <button type='button' class='close text-danger' data-dismiss='alert' aria-hidden='true'>×</button></div></div>")
      } else if (prenoms == '' || prenoms === undefined) {
        $('#response').append("<div  class='alert alert-danger text-center'>Veuillez saisir le prénom <button type='button' class='close text-danger' data-dismiss='alert' aria-hidden='true'>×</button></div></div>")
      } else if (telephone == '' || telephone === undefined) {
        $('#response').append("<div  class='alert alert-danger text-center'>Veuillez saisir le numéro de téléphone <button type='button' class='close text-danger' data-dismiss='alert' aria-hidden='true'>×</button></div></div>")
      } else {

        $('#loader').show();
        $.ajax({
          type: "POST",
          url: "{{ url('creer-compte') }}",
          data: {
            password: password,
            email: email,
            nom: nom,
            prenoms: prenoms,
            telephone: telephone,
            confirmation_password: confirmation_password,
            _token: _token
          },
          success: function(response) {
            console.log(response);
            if (response.error) {
              // for (var count = 0; count < response.error.length; count++) {
              $('#response').append("<div class='alert alert-danger text-center'>" + response.error + "<button type='button' class='close text-danger' data-dismiss='alert' aria-hidden='true'>×</button></div></div>")
              // }

            } else if (response.success) {
              //for (var count = 0; count < response.success.length; count++) {
              $('#response').append("<div class='alert alert-success text-center'>" + response.success + "<button type='button' class='close text-success' data-dismiss='alert' aria-hidden='true'>×</button></div></div>")
              //}
              $(".message").html('');
              window.location.href = "inscrisuccess";
              //$("#inscription_form")[0].reset();


              //location.reload();
            }
          }
        });
      }
    });

    var verify_input = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,16}$/;
    $('#password, #confirmation_password').on('keyup', function() {
      if ($('#password').val().match(verify_input)) {
        if ($('#password').val() == $('#confirmation_password').val()) {
          $('.message').html('Les mots de passes correspondent').css('color', 'green');
        } else {
          $('.message').html('Les mots de passes ne correspondent pas').css('color', 'red');
        }
      } else {
        $('.message').html('Le mot de passe doit contenir au moins une minuscule, une majuscule, un chiffre, un caractère spécial et doit être entre 8 carcatères et 16 caractères.').css('color', 'red');
      }

    });
  </script>
  <!-- endinject -->



</body>

</html>