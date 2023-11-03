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

<div class="col-xl-12 col-md-12 col-lg-12 d-flex align-items-stretch" style="background-color: white; height: 150vh"  data-aos="fade-left">
    <div class="icon-boxes d-flex flex-column justify-content-center col-md-12">

        <div class="row">

            <section class="get-in-touch">
                <h4 class="title"> J'ai oublié mon matricule du CROU</h4>
                <form class="contact-form row form-group" method="POST" action="{{url('idtrouver')}}" id="resultat_form" >
                    @csrf
                    <div id="response"></div>
                    <div class="form-field col-lg-6">
                        <input value="{{old('nom_etudiant')}}" type="text" id="nom_etudiant" name="nom_etudiant"  class="input-text js-input" type="text" required>
                        <label class="label" for="nom_etudiant">Nom de famille</label>
                    </div>

                    <div class="form-field col-lg-6">
                        <input value="{{old('prenoms_etudiant')}}" type="text" id="prenoms_etudiant" name="prenoms_etudiant"  class="input-text js-input" type="text" required>
                        <label class="label" for="prenoms_etudiant">Prénoms</label>
                    </div>
                    <div class="form-field col-lg-6">
                        <input value="{{old('lieu_naissance_etudiant')}}" type="text" id="lieu_naissance_etudiant" name="lieu_naissance_etudiant"  class="input-text js-input" type="text" required>
                        <label class="label" for="lieu_naissance_etudiant">Lieu de naissance</label>
                    </div>
                    <div class="form-field col-lg-6">
                        <input value="{{old('email_etudiant')}}" type="email" id="email_etudiant" name="email_etudiant"  class="input-text js-input" type="text" placeholder="Entrez l'e-mail utilisé lors de votre inscription" required>
                        <label class="label" for="email_etudiant">E-mail</label>
                    </div>
                    <div class="form-field col-lg-6">
                        <input value="{{old('contact_etudiant')}}" type="tel" id="contact_etudiant" name="contact_etudiant"  class="input-text js-input" type="text" placeholder="Entrez le numéro utilisé lors de votre inscription" required>
                        <label class="label" for="contact_etudiant">Téléphone</label>
                    </div>
                    <div class="form-field col-lg-6 ">
                        <input name="date_naissance_etudiant" id="date_naissance_etudiant" value="{{old('date_naissance_etudiant')}}" class="input-text js-input" type="date" required="required">
                        <label class="label" for="date_naissance_etudiant">Date de naissance</label>
                    </div>
                    <div class="form-field col-lg-12">
                        <input class="submit-btn" name="chercher-id" type="submit" value="Chercher">
                    </div>
                </form>
            </section>


        </div>
    </div><!-- End .content-->
</div>

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