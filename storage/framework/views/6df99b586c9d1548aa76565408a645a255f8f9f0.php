<?php $__env->startSection('content'); ?>
    <main id="main">

        <!-- ======= About Section ======= -->

        <section id="about" class="about">
            <?php if($demande): ?>
                <div class="container">
                    <?php if($demande->statut == 3): ?>
                        <div class="row no-gutters">
                            <div class="content col-xl-5 col-md-5 col-lg-5 d-flex align-items-stretch"
                                 data-aos="fade-right">
                                <div class="content content text-center center">
                                    <script src="https://cdn.lordicon.com/xdjxvujz.js"></script>
                                    <lord-icon
                                            src="https://cdn.lordicon.com/lupuorrc.json"
                                            trigger="loop"
                                            colors="primary:#110a5c,secondary:#08a88a"
                                            style="width:140px;height:140px">
                                    </lord-icon>

                                    <h2 class="text-center" style="color: #00FF00;">FELICITATIONS !</h2>
                                    <h2 CLASS="text-center">Monsieur/Madame <b><?php echo e($demande->nom_etudiant); ?></b>
                                        <b><?php echo e($demande->prenoms_etudiant); ?> </b> vous êtes admis(e) en
                                        Résidence Universitaire. <br><br></h2>
                                    <p>
                                        Veuillez vous muni de votre fiche d'admission et vous rendre à l'Administration du CROU Abidjan 2 sise à
                                        l'Université Nangui Abrogoua - Villa N° 6,
                                        face Scolarité pour les formalités d'usage.<br><br>

                                        <button type="button" class="btn btn-outline-light text-dark">
                                            <a class="link-light " href="http://admission.croua2.ci/consulter-resultat">Nouvelle
                                                recherche</a>
                                        </button>
                                    </p>
                                </div>
                            </div>
                            <div class="col-xl-7 col-md-7 col-lg-7 d-flex align-items-stretch"
                                 style="background-color: white; color: orangered" data-aos="fade-left">
                                <div class="icon-boxes d-flex flex-column justify-content-center col-md-12">

                                    <div class="row">

                                        <section class="get-in-touch">
                                            <h4 class="title">Mes informations</h4>

                                            <span class="mt-5">


               <h3 class="text-align-center">
                                        <p style="font-size: 25px"> Nom et Prénom(s): <b><?php echo e($demande->nom_etudiant); ?></b>
                                            <b><?php echo e($demande->prenoms_etudiant); ?> </b><br> <br></p>
               <p> Identifiant CROU Abidjan 2: <b><?php echo e($demande->matricule_crou); ?></b> <br> <br></p>
               <p> N° Carte Etudiant(CE): <b><?php echo e($demande->num_carte); ?></b>  <br><br></p>
                <p>Date de naissance: <b><?php echo e($demande->date_naissance_etudiant); ?></b> <br>  </p></h3>
                                                  </span>
                                            <div class="row">
                                                <form action="ma-fiche-resultat" method="post">
                                                    <?php echo csrf_field(); ?>
                                                    <input type="text" hidden name="matricule_crou" value="<?php echo e($demande->matricule_crou); ?>">
                                                    <button  type="submit" class="btn btn-success btn-icon-text m-2">
                                                        
                                                        Télécharger ma fiche d'admission
                                                    </button>
                                                </form>
                                                </div>
                                        </section>
                                    </div>
                                </div><!-- End .content-->

                            </div>
                        </div>
                </div>

            <?php else: ?>
                <div class="container">

                    <div class="row no-gutters">

                        <div class="content col-xl-5 col-md-5 col-lg-5 d-flex align-items-stretch"
                             data-aos="fade-right">
                            <div class="content text-center center">
                                <h3 class=" text-center font-weight-bold" style="color: #ff0022; text-transform:uppercase ">
                                    Désolé </h3>
                                <h3 class=" text-center font-weight-bold"> Monsieur/Madame
                                    <b><?php echo e($demande->nom_etudiant); ?></b>
                                    <b><?php echo e($demande->prenoms_etudiant); ?>, vous n'êtes pas admis en Résidence Universitaire.</b> <br>
                                </h3>
                                <img style="width: 200px; display: block; margin-left: auto; margin-right: auto;"
                                     src="assets2/img/refuse.png" class="mx-auto d-block center"> <br>

                                <button type="button" class="btn btn-outline-light text-dark center">
                                    <a class="link-light " href="http://admission.croua2.ci/consulter-resultat">Nouvelle
                                        recherche</a>
                                </button>
                            </div>
                        </div>
                        <div class="col-xl-7 col-md-7 col-lg-7 align-items-stretch"
                             style="background-color: white; color: orangered" data-aos="fade-left">
                            <div class="icon-boxes d-flex flex-column justify-content-center col-md-12">

                                <div class="row">

                                    <section class="get-in-touch">
                                        <h4 class="title">Mes informations</h4>
                                        <p style="font-size: 25px"> Nom et Prénom(s): <b><?php echo e($demande->nom_etudiant); ?></b>
                                            <b><?php echo e($demande->prenoms_etudiant); ?> </b></p>
                                        <p style="font-size: 25px">Identifiant CROU Abidjan 2:
                                            <b><?php echo e($demande->matricule_crou); ?></b></p>
                                        <p style="font-size: 25px"> N° Carte Etudiant (CE):
                                            <b><?php echo e($demande->num_carte); ?></b></p>
                                        <p style="font-size: 25px"> Date de naissance:
                                            <b><?php echo e($demande->date_naissance_etudiant); ?></b></p>
                                    </section>
                                </div>
                            </div>
                        </div>


                    </div>


                </div>

                <!-- End About Section -->
            <?php endif; ?>
            <?php else: ?>
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 b-center"><h2 class="">Demande introuvable </h2>
                            <script src="https://cdn.lordicon.com/xdjxvujz.js"></script>
                            <lord-icon
                                    src="https://cdn.lordicon.com/tdrtiskw.json"
                                    trigger="loop"
                                    style="width:150px;height:150px">
                            </lord-icon>
                        </div>
                        <div class="col-md-6"><p class="text-center">Nous vous prions de vous rendre à la Direction du
                                CROU Abidjan 2,sis à
                                l’Université Nangui-Abrogoua -Villa N° 6, face à la Scolarité pour
                                toutes reclamations. </p><br></div>
                    </div>
                </div>
            <?php endif; ?>
        </section>

    </main><!-- End #main -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('index2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/admission.croua2.ci/public_html/resources/views/layouts/resultatconsultation.blade.php ENDPATH**/ ?>