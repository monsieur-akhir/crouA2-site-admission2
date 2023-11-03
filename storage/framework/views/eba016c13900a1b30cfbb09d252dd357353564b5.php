<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item">
        <a href="<?php echo e(url('dashboard')); ?>" class="nav-link" >
          <i class="gg-home-alt" style="margin-right: 10px"></i>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
          <i class="gg-list" style="margin-right: 10px"></i>
          <span class="menu-title">Les Demandes</span>
        </a>
        <div class="collapse" id="ui-basic">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="<?php echo e(url('all-demande')); ?>">Toutes les demandes</a></li>
            <li class="nav-item"> <a class="nav-link" href="<?php echo e(url('traiter')); ?>">A traiter</a></li>
            
            <li class="nav-item"> <a class="nav-link" href="<?php echo e(url('refuser')); ?>">Refuser</a></li>
            <li class="nav-item"> <a class="nav-link" href="<?php echo e(url('dossier-deposer')); ?>">Dossier deposé</a></li>
            <li class="nav-item"> <a class="nav-link" href="<?php echo e(url('dossier-terminer')); ?>">Dossier Terminé</a></li>
          </ul>
        </div>
      </li>
      <?php if(Auth::user()->role == 'admin'): ?>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#ui-basic1" aria-expanded="false" aria-controls="ui-basic1">
          <i class="gg-copy" style="margin-right: 10px"></i>
          <span class="menu-title">Paramétrage</span>
        </a>
        <div class="collapse" id="ui-basic1">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="<?php echo e(url('cites')); ?>">Les cités</a></li>
            <li class="nav-item"> <a class="nav-link" href="<?php echo e(url('batiments')); ?>">Les batiments</a></li>
            <li class="nav-item"> <a class="nav-link" href="<?php echo e(url('paliers')); ?>">Les paliers</a></li>
            <li class="nav-item"> <a class="nav-link" href="<?php echo e(url('chambres')); ?>">Les chambres</a></li>
            <li class="nav-item"> <a class="nav-link" href="<?php echo e(url('lits')); ?>">Les lits</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo e(url('rapports')); ?>">
          <i class="gg-controller"  style="margin-right: 10px"></i>
          <span class="menu-title">Rapport Inscriptions </span>
        </a>
      </li>
      <li class="nav-item">
      <a class="nav-link" href="<?php echo e(url('rapports_depose')); ?>">
        <i class="gg-controller"  style="margin-right: 10px"></i>
        <span class="menu-title">Rapport Dossiers Déposés</span>
      </a>
    </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo e(url('liste-agent')); ?>">
          <i class="gg-music-speaker" style="margin-right: 10px"></i>
          <span class="menu-title">Liste des agents</span>
        </a>
      </li>
      <?php endif; ?>
    </ul>
  </nav><?php /**PATH /home/admin/web/croua2.ci/public_html/resources/views/partials/_sidebar.blade.php ENDPATH**/ ?>