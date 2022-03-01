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
          <?php if(count($data['terra']->getAliveCharacters()) > 0): ?>
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
            </form>
          <?php else: ?>
            You have no alive characters.
          <?php endif; ?>
        <?php endif; ?>
    </div>
  </section>

  <?php echo $__env->make('layouts.cms.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php echo $__env->make('layouts.cms.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <script>
    const shareBtn = document.getElementById('submit');
    shareBtn.addEventListener('click', e => {
      e.preventDefault();

      const dp =  document.querySelector('input[name="dp"]').value;
      const char =  document.querySelector('input[name="char"]').value;

      const response =  document.querySelector('#response');

      fetch('/user/getShareDp', {
        method: 'post',
        mode: "same-origin",
        credentials: "same-origin",
        headers: {
          "Content-Type": "application/json"
        },
        body: JSON.stringify({
          dp,
          char
        })
      })
      .then(r => r.text())
      .then(data => {
        var parser = new DOMParser();
        var doc = parser.parseFromString(data, "text/html");
        response.innerHTML = doc.documentElement.innerHTML;
      })
    });
  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.cms.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\shaiyabattles\resources\views/pages/cms/user/moveTerra.blade.php ENDPATH**/ ?>