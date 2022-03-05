<?php $__env->startSection('index', 'home'); ?>
<?php $__env->startSection('title', 'Home'); ?>
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
    <div class="row pattern">
      <section class="features" id="features">
        <div class="container">
          <table width="100%">
            <tr>
              <td style="width: 60%">
                <img height="95%"; width="95%"; src="/resources/themes/Originals/images/container2.png" align="left";>
              </td>
              <td style="width: 90%; align=right;">
                <h2>Server Status</h2>
                <?php separator(10) ?>
                Server Status
                <h2>Players Online</h2>
                Players Online
                <p class="text-center">Total players online: 1</p>
                <p class="text-center">AoL: 1</p>
                <p class="text-center">UoF: 1</p>
              </td>
            </tr>
          </table>
        </div>
      </section>
    </div>
  </div>

    <?php echo $__env->make('layouts.cms.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  
  <?php echo $__env->make('layouts.cms.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.cms.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\originals\resources\views/pages/cms/home/index.blade.php ENDPATH**/ ?>