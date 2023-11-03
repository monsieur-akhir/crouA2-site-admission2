<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo e(config('app.name')); ?></title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/vendors/css/vendor.bundle.base.css')); ?>">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/vertical-layout-light/style.css')); ?>">
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
                                <img style="display:block; margin-left: auto;margin-right: auto;" src="assets/images/logo.png" alt="logo">
                            </div>
                            <h4 class="text-center">VALIDER CODE</h4>
                            <?php if(session()->get('otp_success')): ?>
                            <div class="alert alert-success mg-b-0" role="alert">
                                <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <strong><?php echo e(session()->get('otp_success')); ?></strong>
                            </div>
                            <?php endif; ?>

                            <?php if($errors->any()): ?>
                            <div class="alert alert-danger background-danger">
                                <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <strong><?php echo e($error); ?></strong>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <?php endif; ?>
                            <form class="pt-3" action="<?php echo e(route('valider-otp')); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <div class="form-group">
                                    <input required maxlength="5" minlength="5" type="text" class="form-control form-control-lg" name="otp" placeholder="opt">
                                </div>
                                <div class="mt-3">
                                    <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" href="../../index.html">
                                        VALIDER OTP
                                    </button>
                                </div>
                                <div class="my-2 d-flex justify-content-between align-items-center">
                                    <a href="#" class="auth-link text-black">Mot de passe oublié ?</a>
                                </div>
                                <div class="text-center mt-4 font-weight-light">
                                    Vous avez pas de compte ? <a href="<?php echo e(route('sinscrire')); ?>" class="text-primary">Inscription</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <link rel="stylesheet" href="<?php echo e(asset('assets/vendors/css/vendor.bundle.base.css')); ?>">

</body>

</html><?php /**PATH /home/admin/web/vps-8a0d3bf3.vps.ovh.net/public_html/resources/views/layouts/otp.blade.php ENDPATH**/ ?>