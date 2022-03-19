<?php
  list($ID, $Reward, $Bonus, $Price) = explode('~', $_POST['id']);
?>

<h4>Are you sure you want to remove this donation?</h4>
<h5 class="text-center"><strong class="font-weight-bold">{{$Reward}}</strong></h5>

<form class="remove_donation" id="remove_donation" method="post">
<p class="text-center">
  <button type="button" class="btn btn-danger btn-lg" id="donationRemoval">Yes</button>
  <button type="button" class="btn btn-primary btn-lg" data-dismiss="modal">No</button>
</p>
<input type="hidden" name="id" value="{{$ID}}"/>
</form>

<script>
	$(document).ready(function(){
		$("button#donationRemoval").click(function(){
			$.ajax({
				type: "POST",
				url:"/resources/jquery/addons/ajax/admin/donations/donation_removal.php",
				data: $("form.remove_donation").serialize(),
				success: function(message){
					$("#get_mD_rmv_modal #dynamic-content").html(message);
				},
				error: function(){
					alert("Error");
				}
			});
		});
		var form_enabled = true;
    // allow the user to submit the form only once each time the page loads
    $('#remove_donation').on('submit', function(){
      if (form_enabled) {
        form_enabled = false;
        return true;
      }
      return false;
    });
	});
</script>
