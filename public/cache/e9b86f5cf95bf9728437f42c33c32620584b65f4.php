<?php $__env->startSection('index', 'polls'); ?>
<?php $__env->startSection('title', 'Polls'); ?>
<?php $__env->startSection('zone', 'CMS'); ?>
<?php $__env->startSection('content'); ?>
  <?php echo $__env->make('partials.cms.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <section class="content-wrap">
    <div class="youplay-banner banner-top youplay-banner-parallax small">
      <div class="image" style="background-image: url('/resources/themes/YouPlay/images/template/banner-blog-bg.jpg')"></div>
    </div>

    <div class="container youplay-content text-center">
        <h2 class="mt-0">Polls</h2>
        <?php if (\Illuminate\Support\Facades\Blade::check('guest')): ?>
          <p>Please login to continue.</p>
        <?php else: ?>
          <?php if(count($data['polls']->getPolls()) > 0): ?>
            <p id="response"></p>
            <form id="poll_form" method="post">
            </form>
            <?php $__currentLoopData = $data['polls']->getPolls(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <span id="<?php echo e($fet->id); ?>"><?php echo e($fet->poll_question); ?></span>
              <?php if(count($data['polls']->getPollOptions($fet->id)) > 0): ?>
                <?php $__currentLoopData = $data['polls']->getPollOptions($fet->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <div>
                    <input type="radio" class="poll" name="pollopt<?php echo e($res->id); ?>" id="pollopt<?php echo e($res->id); ?>" value="<?php echo e($res->poll_option); ?>"><?php echo e($res->poll_option); ?>

                  </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <input type="hidden" value="<?php echo e($fet->poll_question); ?>" id="pollquestion<?php echo e($fet->id); ?>">
                <button class="btn btn-sm" id="poll_submit">Submit</button>
                <br>
              <?php else: ?>
                no options exist
              <?php endif; ?>
              <br>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <?php else: ?>
            No polls exist.
          <?php endif; ?>
        <?php endif; ?>
    </div>
  </section>

    <?php echo $__env->make('layouts.cms.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('layouts.cms.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.cms.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\shaiyabattles\resources\views/pages/cms/community/polls.blade.php ENDPATH**/ ?>