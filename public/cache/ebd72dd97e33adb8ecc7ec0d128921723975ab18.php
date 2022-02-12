<div class="col-auto mpl-sidebar" data-sr=widget data-sr-duration=1200 data-sr-distance=20>
    <?php if(count($data['widgets']->display()) > 0): ?>
        <?php $__currentLoopData = $data['widgets']->display(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $widget): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="mpl-widget mpl-widget-search">
                <h4 class="mpl-widget-title" data-sr-item="widget"><?php echo e($widget->Title); ?></h4>
                
                <div class="mpl-widget-content">
                    <?php echo e($data['widgets']->loadWidgets($widget->Name, $data)); ?>

                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
</div>
<?php /**PATH C:\laragon\www\shaiyabattles\resources\views/partials/cms/widgets.blade.php ENDPATH**/ ?>