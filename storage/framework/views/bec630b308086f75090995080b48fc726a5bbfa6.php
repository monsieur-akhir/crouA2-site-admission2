<?php $__env->startSection('content'); ?>
<div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <?php echo $__env->make('partials._navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->
      <div class="theme-setting-wrapper">
        <div id="settings-trigger"><i class="ti-settings"></i></div>
        <div id="theme-settings" class="settings-panel">
          <i class="settings-close ti-close"></i>
          <p class="settings-heading">SIDEBAR SKINS</p>
          <div class="sidebar-bg-options selected" id="sidebar-light-theme"><div class="img-ss rounded-circle bg-light border mr-3"></div>Light</div>
          <div class="sidebar-bg-options" id="sidebar-dark-theme"><div class="img-ss rounded-circle bg-dark border mr-3"></div>Dark</div>
          <p class="settings-heading mt-2">HEADER SKINS</p>
          <div class="color-tiles mx-0 px-4">
            <div class="tiles success"></div>
            <div class="tiles warning"></div>
            <div class="tiles danger"></div>
            <div class="tiles info"></div>
            <div class="tiles dark"></div>
            <div class="tiles default"></div>
          </div>
        </div>
      </div>
      <!-- partial -->
      <!-- partial:partials/_sidebar.html -->
      <?php echo $__env->make('partials._sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <!-- partial -->
      <div class="main-panel">
      <div class="content-wrapper">
        <div class="card">
          <div class="card-body">
          <div class="row">
            <div class="col-md-12 grid-margin">
              <h4> NOMBRE DE DEMANDES PAR UNIVERSITE</h4>
              <div class="table-responsive pt-3">
              <table  class="table table-bordered">
                <thead>
                  <tr>
                    <?php $__currentLoopData = array_keys($demandeParUniversite); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dPU): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <th><?php echo e(DB::table('universites')->where('id',$dPU)->first()->libelle); ?></th>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <?php $__currentLoopData = $demandeParUniversite; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dPU): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <td><?php echo e($dPU); ?></td>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </tr>
                </tbody>
              </table>
              </div>
              <br>
              <h4>NOMBRE DE DEMANDES PAR UFR (UNIVERSITE NANGUI ABROGOUA)</h4>
              <div class="table-responsive pt-3">
              <table  class="table table-bordered">
                <thead>
                  <tr>
                    <?php $__currentLoopData = array_keys($demandeNanguiParDepartement); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dNPD): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <th><?php echo e(DB::table('departements')->where('id',$dNPD)->first()->libelle); ?></th>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <?php $__currentLoopData = $demandeNanguiParDepartement; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dNPD): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <td><?php echo e($dNPD); ?></td>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </tr>
                </tbody>
              </table>
              </div>
              <br>
              <h4> NOMBRE DE DEMANDES PAR UNIVERSITE (MASCULIN)</h4>
              <div class="table-responsive pt-3">
              <table  class="table table-bordered">
                <thead>
                  <tr>
                    <?php $__currentLoopData = array_keys($demandeParUniversiteMasculin); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dNPD): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <th><?php echo e(DB::table('universites')->where('id',$dNPD)->first()->libelle); ?></th>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <?php $__currentLoopData = $demandeParUniversiteMasculin; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dNPD): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <td><?php echo e($dNPD); ?></td>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </tr>
                </tbody>
              </table>
              </div>
              <br>
              <h4> NOMBRE DE DEMANDES PAR UNIVERSITE (FEMININ)</h4>
              <div class="table-responsive pt-3">
              <table  class="table table-bordered">
                <thead>
                  <tr>
                    <?php $__currentLoopData = array_keys($demandeParUniversiteFeminin); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dNPD): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <th><?php echo e(DB::table('universites')->where('id',$dNPD)->first()->libelle); ?></th>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <?php $__currentLoopData = $demandeParUniversiteFeminin; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dNPD): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <td><?php echo e($dNPD); ?></td>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </tr>
                </tbody>
              </table>
              </div>
              <br>
              <h4>NOMBRE DE DEMANDES PAR NIVEAU ACTUEL</h4>
              <div class="table-responsive pt-3">
              <table  class="table table-bordered">
                <thead>
                  <tr>
                    <?php $__currentLoopData = array_keys($demandeParNiveau); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dNPD): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <th><?php echo e($dNPD); ?></th>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <?php $__currentLoopData = $demandeParNiveau; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dNPD): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <td><?php echo e($dNPD); ?></td>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </tr>
                </tbody>
              </table>
              </div>
            </div>
          </div></div>
          </div>
          
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2021.  Premium <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a> from BootstrapDash. All rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="ti-heart text-danger ml-1"></i></span>
          </div>
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Distributed by <a href="https://www.themewagon.com/" target="_blank">Themewagon</a></span> 
          </div>
        </footer> 
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>   
    <!-- page-body-wrapper ends -->
  </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/admin/web/vps-8a0d3bf3.vps.ovh.net/public_html/resources/views/layouts/rapports.blade.php ENDPATH**/ ?>