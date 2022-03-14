<?php
  list($ProductID, $ProductName) = explode('~', $_POST['id']);
?>

<h4>Are you sure you want to remove this product?</h4>
<h5 class="text-center"><strong class="font-weight-bold"><?php echo e($ProductName); ?></strong></h5>

<p class="text-center">
  <button type="button" class="btn btn-danger btn-lg">Yes</button>
  <button type="button" class="btn btn-primary btn-lg" data-dismiss="modal">No</button>
</p>
<?php /**PATH C:\laragon\www\shaiyabattles\public\resources\jquery\addons\ajax\admin\webmall/removeProduct.blade.php ENDPATH**/ ?>