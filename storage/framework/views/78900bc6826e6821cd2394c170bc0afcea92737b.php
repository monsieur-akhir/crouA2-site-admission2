<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
      <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
        <span class="icon-menu"></span>
      </button>
      <ul class="navbar-nav navbar-nav-right">
        <li class="nav-item nav-profile dropdown">
          <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
            <i class="icon-ellipsis"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
            <a href="<?php echo e(route('logout')); ?>" class="dropdown-item">
              <i class="ti-power-off text-primary"></i>
              Se Déconnecter
            </a>
          </div>
          <a href="<?php echo e(route('logout')); ?>" class="dropdown-item">
            <i class="ti-power-off text-primary"></i>
            Se Déconnecter
          </a>
        </li>
      </ul>
      
      <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
        <span class="icon-menu"></span>
      </button>
    </div>
  </nav><?php /**PATH /home/admin/web/croua2.ci/public_html/resources/views/partials/_navbar.blade.php ENDPATH**/ ?>