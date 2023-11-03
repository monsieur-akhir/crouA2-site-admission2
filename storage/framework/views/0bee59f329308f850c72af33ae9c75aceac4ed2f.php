<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title><?php echo e(config('app.name')); ?></title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="assets/css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="<?php echo e(asset("assets/images/logo.png")); ?>" />
  <style type="text/css">
    #loader {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      width: 100%;
      background: rgba(0, 0, 0, 0.75) url(assets/images/loading2.gif) no-repeat center center;
      z-index: 10000;
    }
  </style>

</head>

<body>
  <div class="container-scroller">
    <!-- partial:assets/partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5" href="/">
          <img src="assets/images/logo.png" alt="logo" />
        </a>
        <a class="navbar-brand brand-logo-mini" href="assets/index.html">
          <img src="assets/images/logo.png" alt="logo" />
        </a>
      </div>
      <div class="navbar-menu-wrapper navbar-nav-right d-flex align-items-center justify-content-center">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="icon-menu"></span>
        </button>
        <ul class="navbar-nav mr-lg-2">
          <li class="nav-item d-lg-block">
            <a class="font-weight-bold" href="/">Accueil</a>
            <a class="font-weight-bold" href="/">Contact</a>
          </li>
          <li class="nav-item nav-profile align-items-right">
            +225 01 73 93 93 32
            <a class="nav-link">
              <img src="assets/images/phone.png" alt="profile" />
            </a>
          </li>
        </ul>
      </div>
    </nav>
    <div class="container-fluid page-body-wrapper">
      <div class="main-panel col-12 justify-content-center">
        <div class="content-wrapper">
          <div class="row justify-content-center">
            <div class="col-md-8 grid-margin stretch-card">
              <div class="card" style="background-color: transparent!important;">
                <div class="card-body">
                  <h3 class="text-center font-weight-bold">
                    <span class="text-warning">
                      RESULTAT DES ADMISSIONS ET READMISSIONS POUR LA CITE
                      UNIVERSITAIRE DES 220 LOGEMENTS
                    </span> <br><br>
                    ET <br><br>
                    <span style="color: #3C2A45;"> RESULTAT DES ADMISSIONS POUR LA CITE UNIVERSITAIRE DE WILLIAMSWILLE</span>
                  </h3>
                  <br>
                </div>
              </div>
            </div>
            <div class="col-md-8 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h3 class="text-center font-weight-bold">
                    Pour consulter votre résultat veuillez saisir
                    votre <span class="text-warning">identifiant</span>
                    tel qu'il est inscrit sur le formulaire de votre
                    <span class="text-warning">date de naissance JJ/MM/AAA</span>
                  </h3>
                  <br>
                  <?php if($errors->any()): ?>
                  <div class="alert alert-danger">
                      <ul>
                          <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <li><?php echo e($error); ?></li>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </ul>
                  </div>
                  <?php endif; ?>
                  <form method="POST" action="<?php echo e(url('consultation')); ?>" id="resultat_form" class="form-group">
                   <?php echo csrf_field(); ?>
                    <div id="response"></div>
                    <div class="form-row">
                      <div class="col">
                        <label for="">
                          <span class="font-weight-bold">
                            identifiant
                          </span>
                          <span class="text-danger">*</span>
                        </label>
                        <input value="<?php echo e(old('matricule_crou')); ?>" type="text" id="matricule_crou" name="matricule_crou"  class="form-control" placeholder="Identifiant" required>
                      </div>
                      <div class="col">
                        <label for="">
                          <span class="font-weight-bold">
                            Date de naissance
                          </span>
                          <span class="text-danger">*</span>
                        </label>
                        <input value="<?php echo e(old('date_naissance_etudiant')); ?>" required name="date_naissance_etudiant" id="date_naissance_etudiant" type="date" class="form-control">
                      </div>
                    </div>
                    <br>
                    <div class="form-group">
                      <button type="submit" class="btn btn-danger col-12 font-weight-bold">
                        Consulter votre résultat
                      </button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:assets/partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2021. Premium <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a> from BootstrapDash. All rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="ti-heart text-danger ml-1"></i></span>
          </div>
        </footer>
        <!-- partial -->
        <div id="loader"></div>
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  
</body>

</html><?php /**PATH /home/admin/web/croua2.ci/public_html/resources/views/layouts/consulter-resultat.blade.php ENDPATH**/ ?>