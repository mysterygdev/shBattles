<?php
  list($ID, $RewardName, $RewardDesc, $RewardImage, $Tier) = explode('~', $_POST['id']);
?>

<h4>Are you sure you want to remove this reward?</h4>
<h5 class="text-center"><strong class="font-weight-bold">{{$ID}}</strong></h5>

<form class="remove_reward" id="remove_reward" method="post">
<p class="text-center">
  <button type="button" class="btn btn-danger btn-lg" id="rewardRemoval">Yes</button>
  <button type="button" class="btn btn-primary btn-lg" data-dismiss="modal">No</button>
</p>
<input type="hidden" name="id" value="{{$ID}}"/>
</form>

<script>
	$(document).ready(function(){
		$("button#rewardRemoval").click(function(){
			$.ajax({
				type: "POST",
				url:"/resources/jquery/addons/ajax/admin/tierRewards/reward_removal.php",
				data: $("form.remove_reward").serialize(),
				success: function(message){
					$("#get_mTR_rmv_modal #dynamic-content").html(message);
				},
				error: function(){
					alert("Error");
				}
			});
		});
		var form_enabled = true;
    // allow the user to submit the form only once each time the page loads
    $('#remove_reward').on('submit', function(){
      if (form_enabled) {
        form_enabled = false;
        return true;
      }
      return false;
    });
	});
</script>
