<?php $__env->startSection('index', 'drops'); ?>
<?php $__env->startSection('title', 'Drops'); ?>
<?php $__env->startSection('zone', 'CMS'); ?>
<?php $__env->startSection('content'); ?>
  <?php echo $__env->make('partials.cms.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <section class="page-name parallax" data-paroller-factor="0.1" data-paroller-type="background" data-paroller-direction="vertical">
  <div class="container">
    <div class="row">
      <h1 class="page-title">
        Drops
      </h1>
      <div class="breadcrumbs">
        <a href="#">Home</a> /
        <a href="#">Server Info</a> /
        <span class="color-1">Drops</span>
      </div>
    </div>
  </div>
  </section>
  <section class="blog-content ptb150 each-element">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-7 col-xs-12">
            <div class="eventHeader3">
                <div class="fsize-14 fweight-700 uppercase" style="text-align: center">
                    <span>Drop List</span>
                </div>
            </div>
                        <article class="vertical-item format-thumb fsize-0 clearfix">
                            <div class="post-content col-lg-12 col-md-8 col-sm-12 col-xs-12 equal-height">
                                <div class="post-wrapper">
                                    <div class="table">
                                        <div class="table-row">
                                        </div>
                                    </div>
                                    <div class="mt15">
                                        <div class="lead" style="text-align: center">
                                                <p>📜 Information 📜</p>
                                                <br><medium>Higher mobs have more drop percentage</medium></br>
                                                <br></br>
                                                <p>⚔️ Every Farm Map ⚔️</p>
                                                <br><medium>Color Fragment</medium></br>
                                                <br></br>
                                                <p>🏜️ Deep Desert 1 🏜️</p>
                                                <br><medium>Crafting Materials (Dye)</medium></br>
                                                <br><br>
                                                <p>🌴 Deep Desert 2 🌴</p>
                                                <br><medium>1-100 Item Mall Points</medium></br>
                                                <br><br>
                                                <p>🦎 Jungle 🦎</p>
                                                <br><medium>1-100 Item Mall Points</medium></br>
                                                <br><br>
                                                <p>⛏️ Kanos ⛏️</p>
                                                <br><medium>Crafting Materials (Remedy | Special Lapis | Accessory Lapis)</medium></br><br><br><br>
                                                <p>🧵 Noria 🧵</p>
                                                <br><medium>Crafting Materials (Costume)</medium></br><br><br><br>
                                                <p>🧸 Lorencia 🧸</p>
                                                <br><medium>Crafting Materials (Pet)</medium></br>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </article>

        </div>
                <?php echo $__env->make('partials.cms.widgets', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
    </section>
	<?php echo $__env->make('layouts.cms.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.cms.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\ShaiyaCMS\resources\views/pages/cms/server/drops.blade.php ENDPATH**/ ?>