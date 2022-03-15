<?php
  list($ProductID, $ProductName, $ProductCode) = explode('~', $_POST['id']);
?>

<h4>Are you sure you want to remove this product?</h4>
<h5 class="text-center"><strong class="font-weight-bold"><?php echo e($ProductName); ?></strong></h5>

<form class="remove_product" id="remove_product" method="post">
<p class="text-center">
  <button type="button" class="btn btn-danger btn-lg" id="productRemoval">Yes</button>
  <button type="button" class="btn btn-primary btn-lg" data-dismiss="modal">No</button>
</p>
<input type="hidden" name="id" value="<?php echo e($ProductID); ?>"/>
<input type="hidden" name="code" value="<?php echo e($ProductCode); ?>"/>
</form>

<script>
	$(document).ready(function(){
		$("button#productRemoval").click(function(){
			$.ajax({
				type: "POST",
				url:"/resources/jquery/addons/ajax/admin/webmall/product_removal.php",
				data: $("form.remove_product").serialize(),
				success: function(message){
					$("#get_mP_rmv_modal #dynamic-content").html(message);
				},
				error: function(){
					alert("Error");
				}
			});
		});
		var form_enabled = true;
    // allow the user to submit the form only once each time the page loads
    $('#remove_product').on('submit', function(){
      if (form_enabled) {
        form_enabled = false;
        return true;
      }
      return false;
    });
	});
</script>
<?php /**PATH C:\laragon\www\shaiyabattles\public\resources\jquery\addons\ajax\admin\webmall/removeProduct.blade.php ENDPATH**/ ?>