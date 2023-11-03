<?php $__env->startSection('content'); ?>
    <section id="hero" class="d-flex align-items-center">

        <div class="container">
            <div class="row">
                <div class="col-lg-6 d-lg-flex flex-lg-column justify-content-center align-items-stretch pt-5 pt-lg-0 order-2 order-lg-1">
                    <div>
                        <h1>BIENVENUE SUR LE PORTAIL</h1>
                        <h2 style="color: #3C2A45;">DE DEMANDE D'ADMISSION ET DE READMISSION EN RESIDENCE
                            UNIVERSITAIRE</h2>
                        <p style="padding-top:0px ;">je veux faire une:</p>
                        <a href="<?php echo e(url('demande')); ?>" class="download-btn" data-bs-toggle="modal"
                           data-bs-target="#demandeModal"><i class='bx bxs-file-doc'></i> Demande</a>
                        <!-- Modal demande -->
                        <div class="modal fade" id="demandeModal" tabindex="-1" aria-labelledby="demandeModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog modal-md">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="demandeModalLabel">Je veux faire une demande</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body d-flex">
                                        <div class="d-flex justify-content-around">
                                            <div class="p-2 order-1">
                                                <button type="button" class="btn btn-secondary btn-md" ><a href="<?php echo e(url('demande')); ?>" class="text-white"><i
                                                                class='bx bxs-file-doc'></i> Admission</a></button>
                                            </div>
                                            <div class="p-2 order-2">
                                                <button type="button" class="btn btn-md" style="background-color:#3C2A45">

                                                <a href="<?php echo e(url('reattribution-chambre')); ?>" class="text-white"><i class='bx bxs-file-doc'></i>
                                                    Readmission</a>
                                                </button>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                                            Annuler
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Fin Modal demande -->

                        <a type="button" class="download-btn" style="background-color:#3C2A45 ;" data-bs-toggle="modal"
                           data-bs-target="#exampleModal"><i class='bx bxs-edit-alt'></i>
                            Modification
                        </a>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Modifier ma demande</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <form action="/trouver-fiche" method="get">
                                        <div class="modal-body">

                                            
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <label>IDENTIFIANT</label>
                                                    <input required style="text-transform:uppercase" type="text"
                                                           class="form-control" name="matricule_crou"
                                                           placeholder="IDENTIFIANT">
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label>DATE DE NAISSANCE</label>
                                                    <input required style="text-transform:lowercase" type="date"
                                                           class="form-control" name="date_naissance_etudiant"
                                                           placeholder="DATE DE NAISSANCE">
                                                </div>
                                            </div>


                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                                                Annuler
                                            </button>
                                            <button type="submit" class="btn btn-success">Rechercher</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-lg-6 d-lg-flex flex-lg-column align-items-stretch order-1 order-lg-2 hero-img animated fadeInUp">
                    <img src="assets2/img/hero-img.png" class="img-fluid" alt="">
                </div>
            </div>
        </div>


    </section><!-- End Hero -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('index3', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/admission.croua2.ci/public_html/resources/views/layouts/starter.blade.php ENDPATH**/ ?>