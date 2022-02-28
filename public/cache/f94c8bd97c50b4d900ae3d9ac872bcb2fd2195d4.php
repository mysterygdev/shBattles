<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="<?php echo e(APP['desc']); ?>">
<meta name="keywords" content="<?php echo e(APP['keywords']); ?>">
<meta name="author" content="<?php echo e(APP['author']); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!-- Favicon -->
<link href="/resources/themes/core/images/icons/favicon.png" rel="icon" type="image/x-icon">
<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i"
rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Cabin:400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
<?php echo $__env->make('layouts.cms.styles', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<title><?php echo $__env->yieldContent('title', 'undefined'); ?> - <?php echo e(APP['title']); ?></title>
<?php /**PATH C:\laragon\www\shaiyabattles\resources\views/layouts/cms/head.blade.php ENDPATH**/ ?>