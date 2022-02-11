<?php
  list($PrizeID,$K1Reward,$UserUID) = explode("~",$_POST["id"]);
?>
<form class="send_prize" method="POST">
  <div class="row m_b_10">
    <div class="col-md-6">
      <div class="text-center">
        <h3 class="u">Redeem Prize</h3>
        <h5 class="text-white">Prize: #{{$PrizeID}}</h5>
        <h5 class="text-white">Reward: {{$K1Reward}}</h5>
      </div>
      <input type="hidden" name="id" value="{{$PrizeID}}"/>
      <input type="hidden" name="UserUID" value="{{$UserUID}}"/>
      <input type="hidden" name="K1Reward" value="{{$K1Reward}}"/>
    </div>
  </div>

  <div class="row m_b_10">
    <div class="col-md-6">
      <div class="text-center">
        @if (count($data['rewards']->validateKills($PrizeID)) == 0)
          <button type="button" class="btn gradient color-white" id="send_prize_submit">
            Redeem <i class="fa fa-send"></i>
          </button>
        @else
          You already redeemed this Prize!
        @endif
      </div>
    </div>
  </div>
</form>
<script>
	$(document).ready(function(){
		$("button#send_prize_submit").click(function(){
			$.ajax({
				type: "POST",
				url:"/resources/jquery/addons/ajax/site/pvpRewards/redeem.submit.php",
				data: $("form.send_prize").serialize(),
				success: function(message){
					$("#get_reward_modal #dynamic-content").html(message);
					$("#TableLoader").load(location.href + " #TabularData");
				},
				error: function(){
					alert("Error");
				}
			});
		});
	});
</script>
