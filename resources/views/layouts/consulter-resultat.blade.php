<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>{{ config('app.name') }}</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <!-- Favicons -->
  <link rel="shortcut icon" href="{{asset("assets/images/logo.png")}}" />
  <link href="{{asset("assets/images/logo.png")}}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Krub:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets2/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets2/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets2/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets2/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets2/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets2/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets2/css/style.css" rel="stylesheet">


</head>

<body>

<!-- ======= Header ======= -->
<header id="header" class="fixed-top">
  <div class="container d-flex align-items-center justify-content-between">

    <h4 class="logo"> <img src="http://admission.croua2.ci/assets/images/logo.png" style="max-height: 100px; height: 80px; width: 80px"><a href="http://admission.croua2.ci/consulter-resultat">CROU Abidjan 2</a></h4>
    <!-- Uncomment below if you prefer to use an image logo -->
    <!-- <a href="index.html" class="logo"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

    <nav id="navbar" class="navbar">
      <ul>
        <li><a class="nav-link scrollto active" href="#hero">Accueil</a></li>
        <li><a class="nav-link scrollto" href="{{('trouver-id')}}">J'ai oublié mon ID </a></li>
        <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
        <li><a class="nav-link scrollto" href="tel:+2250173939332" style="color: #3C2A45; font-size: large">+225 07 59 95 83 61 <i class="bi bi-telephone" ></i></a>


      </ul>
      <i class="bi bi-list mobile-nav-toggle"></i>
    </nav><!-- .navbar -->

  </div>
</header><!-- End Header -->

<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex align-items-center">

  <div class="container d-flex flex-column align-items-center justify-content-center" data-aos="fade-up">
    <h2 style="color: #fd7e14;" class="m-4" >CENTRE RÉGIONAL DES ŒUVRES UNIVERSITAIRES ABIDJAN 2 <br> (CROU ABIDJAN 2)</h2>
    <h4 style="color: #3C2A45;">RÉSULTAT DES ADMISSIONS EN CITÉ UNIVERSITAIRE ABOBO 1</h4>
    <a href="#about" class="btn-get-started scrollto" style="background: #fd7e14;">Je consulte mon résultat</a>
    <img src="assets2/img/features-2.png" class="img-fluid hero-img" alt="" data-aos="zoom-in" data-aos-delay="150">
  </div>

</section><!-- End Hero -->

<main id="main">

  <!-- ======= About Section ======= -->
  <section id="about" class="about">
    <div class="container">

      <div class="row no-gutters">
        <div class="content col-xl-5 col-md-5 col-lg-5 d-flex align-items-stretch" data-aos="fade-right">
          <div class="content">
            <h3>Pour consulter votre résultat vous aurez besoin de votre:</h3>
            <ul>

              <span class="bi bi-check" style="color: #fd7e14;">identifiant</span>
              <br>

              <span class="bi bi-check" style="color: #fd7e14;">
                  date de naissance <strong>JJ/MM/AAAA</strong>
                </span>
            </ul>
            <p>
              Votre <strong>identifiant</strong>  doit être tel qu'il est inscrit sur le formulaire de demande ainsi que votre date de naissance <strong>JJ/MM/AAAA</strong>
            </p>
            @if ($errors->any())
              <div class="alert alert-danger">
                <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif
          </div>
        </div>
        <div class="col-xl-7 col-md-7 col-lg-7 d-flex align-items-stretch" style="background-color: white;"  data-aos="fade-left">
          <div class="icon-boxes d-flex flex-column justify-content-center col-md-12">

            <div class="row">

              <section class="get-in-touch">
                <h4 class="title"> Je Consulte Mon Résultat</h4>
                <form class="contact-form row form-group" method="POST" action="{{url('consultation')}}" id="resultat_form" >
                  @csrf
                  <div id="response"></div>
                  <div class="form-field col-lg-6">
                    <input value="{{old('matricule_crou')}}" type="text" id="matricule_crou" name="matricule_crou"  class="input-text js-input" type="text" required>
                    <label class="label" for="matricule_crou">Identifiant</label>
                  </div>
                  <div class="form-field col-lg-6 ">
                    <input name="date_naissance_etudiant" id="date_naissance_etudiant" value="{{old('date_naissance_etudiant')}}" class="input-text js-input" type="date" required="required">
                    <label class="label" for="date_naissance_etudiant">Date de naissance</label>
                  </div>
                  <div class="form-field col-lg-12">
                    <input class="submit-btn" name="admission" type="submit" value="Admission">
{{--                    <input class="submit-btn" name="readmission" type="submit" value="Readmission">--}}
                  </div>
                </form>
              </section>


            </div>
          </div><!-- End .content-->
        </div>
      </div>

    </div>
  </section><!-- End About Section -->



</main><!-- End #main -->

<!-- ======= Footer ======= -->
<footer id="footer">


  <div class="container d-md-flex py-4">

    <div class="me-md-auto text-center text-md-start">
      <div class="copyright">
        &copy; Copyright <strong><span>Service Informatique CROU Abidjan 2 </span></strong>. All Rights Reserved
      </div>
    </div>
    <div class="social-links text-center text-md-right pt-3 pt-md-0">
      <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>

    </div>
  </div>
</footer><!-- End Footer -->

<div id="preloader"></div>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="assets2/vendor/aos/aos.js"></script>
<script src="assets2/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets2/vendor/glightbox/js/glightbox.min.js"></script>
<script src="assets2/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="assets2/vendor/swiper/swiper-bundle.min.js"></script>
<script src="assets2/vendor/php-email-form/validate.js"></script>
<!-- Template Main JS File -->
<script src="assets2/js/main.js"></script>

</body>
</html>