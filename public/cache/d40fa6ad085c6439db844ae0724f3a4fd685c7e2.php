<?php $__env->startSection('index', 'moveTerra'); ?>
<?php $__env->startSection('title', 'Move To Terra'); ?>
<?php $__env->startSection('zone', 'CMS'); ?>
<?php $__env->startSection('content'); ?>
  <?php echo $__env->make('partials.cms.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <section class="content-wrap">
    <div class="youplay-banner banner-top youplay-banner-parallax small">
      <div class="image" style="background-image: url('/resources/themes/YouPlay/images/template/banner-blog-bg.jpg')"></div>
    </div>

    <div class="container youplay-content">
        <h2 class="mt-0 text-center">Move To Terra</h2>
        <?php if (\Illuminate\Support\Facades\Blade::check('guest')): ?>
          <p>Please login to continue.</p>
        <?php else: ?>
          <p class="text-center">Here you can move to our special map terra.</p>
          <p id="response"></p>
          <!-- TODO: first, check if item exists in warehouse, then do this .. -->
          <?php if(count($data['terra']->getAliveCharacters()) > 0): ?>
            <?php if(count($data['terra']->checkIfUserHasItem('100204', 1)) > 0): ?>
              <form class="form-inline" method="post">
                <div class="col-md-3"></div>
                <div class="col-md-8">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>Char Name</th>
                        <th>Select</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $__currentLoopData = $data['terra']->getAliveCharacters(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                          <td><?php echo e($fet->CharName); ?></td>
                          <td><input type="radio" name="CharID" value="<?php echo e($fet->CharID); ?>"></td>
                        </tr>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                  </table>
                </div>
                <?php separator(20) ?>
                <p class="text-center">
                  <button type="submit" class="btn btn-sm" name="submit" id="submit" style="margin-left:10px;">Select character</button>
                </p>
                <?php if(isset($_POST['submit'])): ?>
                  <?php if($data['terra']->checkIfCharNotSelected()): ?>
                    You must select a character to continue.
                  <?php else: ?>
                    <!-- If char selected, continue .. -->
                    <p class="text-center">
                      <button type="submit" class="btn btn-md" name="moveChar" id="moveChar" style="margin-left:10px;">Move character</button>
                    </p>
                  <?php endif; ?>
              <?php endif; ?>
              <?php if(isset($_POST["moveChar"]) || !empty($_POST["moveChar"])): ?>
                <?php if($data['terra']->movePlayerToMap()): ?>
                  <p class="text-center">
                    Character moved to Terra successfully.
                  </p>
                <?php else: ?>
                  <p class="text-center">
                    An error has occured.
                  </p>
                <?php endif; ?>
              <?php endif; ?>
              </form>
            <?php else: ?>
              <p class="text-center fw_bold">You do not have the required item to proceed.</p>
            <?php endif; ?>
          <?php else: ?>
            <p class="text-center fw_bold">You have no alive characters.</p>
          <?php endif; ?>
        <?php endif; ?>
    </div>
  </section>

  <?php echo $__env->make('layouts.cms.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php echo $__env->make('layouts.cms.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.cms.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\shaiyabattles\resources\views/pages/cms/user/moveTerra.blade.php ENDPATH**/ ?>