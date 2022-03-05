<?php $__env->startSection('index', 'downloads'); ?>
<?php $__env->startSection('title', 'Downloads'); ?>
<?php $__env->startSection('zone', 'CMS'); ?>
<?php $__env->startSection('content'); ?>
  <div class="container-fluid">
    <div class="row">
      <header id="home">
        <?php echo $__env->make('partials.cms.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <h1>
          <img onload="this.style.opacity='1';" class="big-logo" src="/resources/themes/Originals/images/shaiya_titan_logo.png" alt="Dragonic big logo">
        </h1>
      </header>
    </div>
    <?php echo $__env->make('partials.cms.divider', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <main>
      <section class="container">
        <!-- Downloads -->
        <div class="container">
          <p>Thank you for choosing to download <strong><?php echo e(APP['title']); ?></strong> Please note that by downloading our server you agree to our <a href="/server/terms" class="terms">Terms of Service</a>.</p>
          <div class="table-responsive" style="width: 110%">
            <table class="table-dark table-striped table-bordered table-sm container">
              <thead>
                <tr>
                  <br>
                  <p>MEGA&emsp;<button onclick="window.open('#', '_blank')" class="btn btn-sm btn-dark m_auto"><img src="/resources/themes/Originals/images/icons/mega-logo.png" width="25"> Mega</button>&emsp;Last Updated on:</p>
                  <br>
                  <p>Google Drive&emsp;<button onclick="window.open('#', '_blank')" class="btn btn-sm btn-dark m_auto"><img src="/resources/themes/Originals/images/icons/Google-Drive-Icon.png" width="25">Google Drive</a></button>&emsp;Last Updated on:</p>
                  <br>
                  <?php echo $__env->make('partials.cms.separator', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                  <br>
                  <p>Game.exe Patch&emsp;<button onclick="window.open('#', '_blank')" class="btn btn-sm btn-dark m_auto"><img src="/resources/themes/Originals/images/images/icons/mega-logo.png" width="25"> Mega</button>&emsp;Last Updated on:</p>
                  <br>
                  <p>Updater.exe Patch&emsp;<button onclick="window.open('#', '_blank')" class="btn btn-sm btn-dark m_auto"><img src="/resources/themes/Originals/images/icons/Google-Drive-Icon.png" width="25">Google Drive</a></button>&emsp;Last Updated on:</p>
                  <br>
                </tr>
              </thead>
            </table>
          </div>
        </div>
        <!-- /Downloads -->
        <!-- System Requirements -->
        <p class="text-center" style="color: #FFF;">System requirements</p>
        <div class="table-responsive">
          <table class="table table-striped table-dark2">
            <thead>
              <tr>
                <td>Category</th>
                <td>Minimum</th>
                <td>Recommended</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th>Processor</th>
                <th>Pentium 4 1.5GHz</th>
                <th>i3 8100 3.6GHZ or higher</th>
              </tr>
              <tr>
                <td>Memory</th>
                <td>2 GB</th>
                <td>4 GB or higher</th>
              </tr>
              <tr>
                <th>Video</th>
                <th>3D graphics processor of minimum 256 MB</th>
                <th>3D graphics processor of minimum 1GB</th>
              </tr>
              <tr>
                <td>DirectX</th>
                <td>9c</th>
                <td>9c</th>
              </tr>
              <tr>
                <th>Operating System</th>
                <th>Windows XP</th>
                <th>Windows Vista / 7 / 8 / 8.1 / 10</th>
              </tr>
              <tr>
                <td>Hard Drive Space</th>
                <td>10GB</th>
                <td>50GB</th>
              </tr>
              <tr>
                <th>Internet connection</th>
                <th>Yes</th>
                <th>Yes</th>
              </tr>
            </tbody>
          </table>
        </div>
        <!-- /System Requirements -->
        <!-- Drivers -->
        <p class="text-center" style="color: #FFF;">Are your drivers up to date?</p>
          <p style="color: #FFF;">We want you to get the most out of your gaming experience. If you haven\'t recently updated your Graphic Card Drivers please download and install the newest versions before you start gaming.</p>
          <?php separator(20) ?>
          <a href="https://www.nvidia.com/Download/index.aspx"><img class="img-fluid" src="/resources/themes/originals/images/drivers/nvidia.png" width="150" height="150"></a>
          <a href="http://support.amd.com/us/gpudownload/Pages/index.aspx"><img class="img-fluid" src="/resources/themes/originals/images/drivers/amd-ryzen.png" width="150" height="150"></a>
        <!-- /Drivers -->
      </section>
    </main>
  </div>

    <?php echo $__env->make('layouts.cms.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  
  <?php echo $__env->make('layouts.cms.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.cms.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\originals\resources\views/pages/cms/server/download.blade.php ENDPATH**/ ?>