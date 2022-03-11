<?php $__env->startSection('index', 'home'); ?>
<?php $__env->startSection('title', 'Home'); ?>
<?php $__env->startSection('zone', 'CMS'); ?>
<?php $__env->startSection('content'); ?>
  <?php echo $__env->make('partials.cms.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <section class="content-wrap">
    <!-- Banner -->
    <section class="youplay-banner banner-top youplay-banner-parallax">
      <div class="image" style="background-image: url('/resources/themes/YouPlay/images/template/banner-bg.jpg')">
      </div>

      <div class="info">
        <div>
          <div class="container">
            <h1><?php echo e(APP['title']); ?></h1>
            <em>"quote here"</em>
            <br>
            <br>
            <br>
            <a class="btn btn-lg" href="/download">Download</a>
          </div>
        </div>
      </div>
    </section>

    <?php
      echo 'WTF';
      $ch = curl_init("https://discordapp.com/api/webhooks/951311758352605195/jl3yaD-ks0CYHfElL-JGTPdYdlImduM5fgBW-EAhpgQVwu1Pbf11fltG5v5uK5iuWxLK");
      curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
      curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(array("content" => "hello", "username" => "bot")));
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_SSLVERSION, 6);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
      $res = curl_exec($ch);
      var_dump($res);

    ?>

    <!-- Show server data such as players online,servertime,etc -->
    <?php echo $__env->make('pages.cms.home.partials.data', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('pages.cms.home.partials.info', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
    
    <?php echo $__env->make('pages.cms.home.partials.news', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('layouts.cms.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  
  <?php echo $__env->make('layouts.cms.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.cms.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\shaiyabattles\resources\views/pages/cms/home/index.blade.php ENDPATH**/ ?>