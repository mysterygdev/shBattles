<?php $__env->startSection('index', 'about'); ?>
<?php $__env->startSection('title', 'About'); ?>
<?php $__env->startSection('zone', 'CMS'); ?>
<?php $__env->startSection('content'); ?>
  <?php echo $__env->make('partials.cms.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <section class="content-wrap">
    <div class="youplay-banner banner-top youplay-banner-parallax small">
      <div class="image" style="background-image: url('/resources/themes/YouPlay/images/template/banner-blog-bg.jpg')"></div>
    </div>

    <div class="container youplay-content text-center">
        <h2 class="mt-0">Share Dp</h2>
        <?php if (\Illuminate\Support\Facades\Blade::check('guest')): ?>
          <p>Please login to continue.</p>
        <?php else: ?>
          <p>Here you can share your donation points with other players.</p>
          <h4>Available donation points: <?php echo e($data['share']->getSenderDp()); ?></h4>
          <p id="response"></p>
          <form class="form-inline" method="post">
            <div class="form-group">
              <div class="youplay-input">
                <input type="text" placeholder="how much dp?" class="form-control" name="dp" id="dp"/>
              </div>
            </div>
            <div class="form-group">
              <div class="youplay-input">
                <input type="text" placeholder="char name" class="form-control m_l_5" name="char" id="char"/>
              </div>
            </div>
            <?php separator(20) ?>
            <button type="submit" class="btn btn-sm" name="submit" id="submit" style="margin-left:10px;">Submit</button>
          </form>
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

<?php echo $__env->make('layouts.cms.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\shaiyabattles\resources\views/pages/cms/user/shareDp.blade.php ENDPATH**/ ?>