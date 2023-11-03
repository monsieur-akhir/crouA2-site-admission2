<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#ui-bas" aria-expanded="false" aria-controls="ui-basic">
          <i class="gg-list" style="margin-right: 10px"></i>
          <span class="menu-title">Dashboard</span>
        </a>
        <div class="collapse" id="ui-bas">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="<?php echo e(url('dashboard')); ?>">Admission</a></li>
            <li class="nav-item"> <a class="nav-link" href="<?php echo e(url('dashboard-readmission')); ?>">Readmission</a></li>
          </ul>
        </div>
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
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#ui-basiz" aria-expanded="false" aria-controls="ui-basic">
          <i class="gg-list" style="margin-right: 10px"></i>
          <span class="menu-title">Les Réadmissions</span>
        </a>
        <div class="collapse" id="ui-basiz">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="<?php echo e(url('all-demande-readmission')); ?>">Toutes les demandes</a></li>
           <li class="nav-item"> <a class="nav-link" href="<?php echo e(url('traiter-readmission')); ?>">A traiter</a></li>
           <li class="nav-item"> <a class="nav-link" href="<?php echo e(url('refuser-readmission')); ?>">Refuser</a></li>
           <li class="nav-item"> <a class="nav-link" href="<?php echo e(url('dossier-deposer-readmission')); ?>">Dossier deposé</a></li>
           <li class="nav-item"> <a class="nav-link" href="<?php echo e(url('dossier-terminer-readmission')); ?>">Dossier Terminé</a></li>
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
        <a class="nav-link" data-toggle="collapse" href="#ui-rappord-admission" aria-expanded="false" aria-controls="ui-basic">
          <i class="gg-list" style="margin-right: 10px"></i>
          <span class="menu-title">Rapports Admission</span>
        </a>
        <div class="collapse" id="ui-rappord-admission">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="<?php echo e(url('rapports')); ?>">Inscriptions</a></li>
            <li class="nav-item"> <a class="nav-link" href="<?php echo e(url('rapports_depose')); ?>">Dossiers Déposés</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#ui-rappord-readmission" aria-expanded="false" aria-controls="ui-basic">
          <i class="gg-list" style="margin-right: 10px"></i>
          <span class="menu-title">Rapports Readmission</span>
        </a>
        <div class="collapse" id="ui-rappord-readmission">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="<?php echo e(url('rapports-readmission')); ?>">Inscriptions</a></li>
            <li class="nav-item"> <a class="nav-link" href="<?php echo e(url('rapports_depose-readmission')); ?>">Dossiers Déposés</a></li>
          </ul>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="<?php echo e(url('liste-agent')); ?>">
          <i class="gg-music-speaker" style="margin-right: 10px"></i>
          <span class="menu-title">Liste des agents</span>
        </a>
      </li>
      <?php endif; ?>
    </ul>
  </nav><?php /**PATH /var/www/admission.croua2.ci/public_html/resources/views/partials/_sidebar.blade.php ENDPATH**/ ?>