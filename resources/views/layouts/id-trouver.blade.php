<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>{{ config('app.name') }}</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <!-- Favicons -->
    <link rel="shortcut icon" href="{{asset("assets/images/logo.png")}}"/>
    <link href="{{asset("assets/images/logo.png")}}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Krub:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
          rel="stylesheet">

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

        <h4 class="logo"><img src="http://admission.croua2.ci/assets/images/logo.png"
                              style="max-height: 100px; height: 80px; width: 80px"><a
                    href="http://admission.croua2.ci/consulter-resultat">CROU Abidjan 2</a></h4>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html" class="logo"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

        <nav id="navbar" class="navbar">
            <ul>
                <li><a class="nav-link scrollto active" href="#hero">Accueil</a></li>
                <li><a class="nav-link scrollto" href="{{('trouver-id')}}">J'ai oublié mon ID </a></li>
                <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
                <li><a class="nav-link scrollto" href="tel:+2250173939332" style="color: #3C2A45; font-size: large">+225
                        07 59 95 83 61 <i class="bi bi-telephone"></i></a>


            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->

    </div>
</header><!-- End Header -->
<main id="main">

    <!-- ======= About Section ======= -->

    <section id="about" class="about">
        @if ($demande)
            <div class="container">
                @if ($demande->statut == 3)
                    <div class="row no-gutters">
                        <div class="col-xl-12 col-md-7 col-lg-12 d-flex align-items-stretch"
                             style="background-color: white; color: orangered" data-aos="fade-left">
                            <div class="icon-boxes d-flex flex-column justify-content-center col-md-12">

                                <div class="row">
                                    <div class="row">

                                        <section class="get-in-touch">
                                            <h4 class="title">Mes informations</h4>
                                            <p style="font-size: 25px"> Nom et Prénom(s):
                                                <b>{{$demande->nom_etudiant}}</b>
                                                <b>{{$demande->prenoms_etudiant}} </b></p>
                                            <p style="font-size: 25px">Identifiant CROU Abidjan 2:
                                                <b>{{$demande->matricule_crou}}</b></p>
                                            <p style="font-size: 25px"> N° Carte Etudiant (CE):
                                                <b>{{$demande->num_carte}}</b></p>
                                            <p style="font-size: 25px"> Date de naissance:
                                                <b>{{$demande->date_naissance_etudiant}}</b></p>
                                            <p style="font-size: 25px"> Lieu de naissance:
                                                <b>{{$demande->lieu_naissance_etudiant}}</b></p>
                                            <p style="font-size: 25px"> Email:
                                                <b>{{$demande->email_etudiant}}</b></p>
                                            <p style="font-size: 25px"> Numéro de téléphone:
                                                <b>{{$demande->contact_etudiant}}</b></p>
                                            <p style="font-size: 25px"> Nom du tuteur/parent:
                                                <b>{{$demande->nom_tuteur}}</b></p>
                                        </section>
                                    </div>
                                </div>
                            </div><!-- End .content-->

                        </div>
                    </div>
            </div>

        @else
            <div class="container">

                <div class="row no-gutters">

                    <div class="col-xl-12 col-md-12 col-lg-12 align-items-stretch"
                         style="background-color: white; color: orangered" data-aos="fade-left">
                        <div class="icon-boxes d-flex flex-column justify-content-center col-md-12">

                            <div class="row">

                                <section class="get-in-touch">
                                    <h4 class="title">Mes informations</h4>
                                    <p style="font-size: 25px"> Nom et Prénom(s): <b>{{$demande->nom_etudiant}}</b>
                                        <b>{{$demande->prenoms_etudiant}} </b></p>
                                    <p style="font-size: 25px">Identifiant CROU Abidjan 2:
                                        <b>{{$demande->matricule_crou}}</b></p>
                                    <p style="font-size: 25px"> N° Carte Etudiant (CE):
                                        <b>{{$demande->num_carte}}</b></p>
                                    <p style="font-size: 25px"> Date de naissance:
                                        <b>{{$demande->date_naissance_etudiant}}</b></p>
                                    <p style="font-size: 25px"> Lieu de naissance:
                                        <b>{{$demande->lieu_naissance_etudiant}}</b></p>
                                    <p style="font-size: 25px"> Email:
                                        <b>{{$demande->email_etudiant}}</b></p>
                                    <p style="font-size: 25px"> Numéro de téléphone:
                                        <b>{{$demande->contact_etudiant}}</b></p>
                                    <p style="font-size: 25px"> Nom du tuteur/parent:
                                        <b>{{$demande->nom_tuteur}}</b></p>
                                </section>
                            </div>
                        </div>
                    </div>


                </div>


            </div>

            <!-- End About Section -->
        @endif
        @else
            <div class="container">
                <div class="row">
                    <div class="col-md-12 b-center mt-5">

                        <script src="https://cdn.lordicon.com/xdjxvujz.js"></script>
                        <h2 class="mt-5 text-center">Demande introuvable </h2>
                        <p class="text-center mt-5">Nous vous prions de vous rendre à la Direction du
                            CROU Abidjan 2,sis à
                            l’Université Nangui-Abrogoua -Villa N° 6, face à la Scolarité pour
                            toutes reclamations.
                            <lord-icon
                                    src="https://cdn.lordicon.com/tdrtiskw.json"
                                    trigger="loop"
                                    style="width:150px;height:150px ; align: center">
                            </lord-icon>
                        </p>

                    </div>
                </div>
            </div>
        @endif
    </section>

</main><!-- End #main -->

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
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

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
