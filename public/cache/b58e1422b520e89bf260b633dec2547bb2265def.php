<div class="sidebar col-lg-4 col-md-4 col-sm-5 col-xs-12">
    <?php if(count($data['widgets']->display()) > 0): ?>
        <?php $__currentLoopData = $data['widgets']->display(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $widget): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="widget-bl insta-widget">
                <h5 class="fsize-20 text-center"><?php echo e($widget->Title); ?></h5>
                <div class="widget-wrapper clearfix">
                    <?php echo e($data['widgets']->loadWidgets($widget->Name, $data)); ?>

                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
</div>
<?php /**PATH C:\laragon\www\ShaiyaCMS\resources\views/partials/cms/widgets.blade.php ENDPATH**/ ?>