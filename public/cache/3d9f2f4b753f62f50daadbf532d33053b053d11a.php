<?php
  list($UserUID, $TicketID, $Type, $Status, $Category, $Subject, $Main, $RespUID) = explode('~', $_POST['id']);
?>

<?php $__currentLoopData = $data['tickets']->loadTicket($TicketID); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <div class="container">
    <?php if($res->Type == 0): ?>
      <div class="row">
        <div class="col-md-9 badge-pill badge-primary">
          <div class="row plr_15">
            <div class="col-md-12">
              <p class="b_i"><?php echo e($data['user']->getUserGameInfo($res->UserUID, 'UserID')); ?> said:</p>
            </div>
          </div>
          <div class="row plr_15">
            <div class="col-md-12">
              <?php echo e($res->Message); ?>

            </div>
          </div>
        </div>
      </div>
      <br>
    <?php elseif($res->Type == '1'): ?>
      <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-9 badge-pill badge-secondary">
          <div class="row tar plr_15">
            <div class="col-md-12">
              <p class="b_i"><?php echo e($data['user']->getUserGameInfo($res->RespUID, 'UserID')); ?> said:</p>
            </div>
          </div>
          <div class="row tar plr_15">
            <div class="col-md-12">
              <?php echo e($res->Message); ?>

            </div>
          </div>
        </div>
      </div>
      <br>
    <?php endif; ?>
  </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<form class="send_ticket" id="submit_tckt" method="post">
  <div class="row m_b_10">
    <div class="col-md-3"></div>
    <div class="col-md-6">
      <div class="text-center">
        <h4 class="u">Category: <?php echo e($Category); ?></h4>
      </div>
    </div>
  </div>
  <div class="row m_b_10">
    <div class="col-md-3"></div>
    <div class="col-md-6">
      <div class="text-center">
        <label for="Subject">Subject:</label>
      </div>
      <input type="text" name="Subject" placeholder="Subject" value="<?php echo e($Subject); ?>" class="form-control text-center b_i"/>
    </div>
  </div>
  <div class="row m_b_10">
    <div class="col-md-3"></div>
    <div class="col-md-6">
      <div class="text-center">
        <label for="Status">Status:</label>
      </div>
      <div class="input-group input-group-sm mb-3">
        <select name="Status" class="form-control" id="Status">
          <option disabled selected>Select Status Type*</option>
          <option value="1">New</option>
          <option value="2">Updated</option>
          <option value="3">Awaiting Response</option>
          <option value="4">Closed</option>
        </select>
      </div>
    </div>
  </div>
  <div class="row m_b_10">
    <div class="col-md-3"></div>
    <div class="col-md-6">
      <div class="text-center">
        <label for="Response">Your Response:</label>
      </div>
      <textarea name="YourAnswer" placeholder="Your Answer" class="form-control b_i"></textarea>
      <input type="hidden" name="UserUID" value="<?php echo e($UserUID); ?>"/>
      <input type="hidden" name="TicketID" value="<?php echo e($TicketID); ?>"/>
      <input type="hidden" name="Type" value="<?php echo e($Type); ?>"/>
      <input type="hidden" name="Category" value="<?php echo e($Category); ?>"/>
      <input type="hidden" name="Subject" value="<?php echo e($Subject); ?>"/>
      <input type="hidden" name="Main" value="<?php echo e($Main); ?>"/>
      <input type="hidden" name="RespUID" value="<?php echo e($RespUID); ?>"/>
    </div>
  </div>
  <div class="row m_b_10">
    <div class="col-md-3"></div>
    <div class="col-md-12 text-center">
      <button type="button" class="btn btn-sm btn-primary text-center" id="send_ticket_submit">Submit <i class="fa fa-paper-plane"></i></button>
    </div>
  </div>
</form>
<script>
	$(document).ready(function(){
		$("button#send_ticket_submit").click(function(){
			$.ajax({
				type: "POST",
				url:"/resources/jquery/addons/ajax/admin/tickets/ticket_submit.php",
				data: $("form.send_ticket").serialize(),
				success: function(message){
					$("#get_ticket_modal #dynamic-content").html(message);
				},
				error: function(){
					alert("Error");
				}
			});
		});
		var form_enabled = true;
       // allow the user to submit the form only once each time the page loads
       $('#submit_tckt').on('submit', function(){
               if (form_enabled) {
                       form_enabled = false;
                       return true;
               }
               return false;
        });
	});
</script>
<?php /**PATH C:\laragon\www\shaiyabattles\public\resources\jquery\addons\ajax\admin\tickets/ticket.blade.php ENDPATH**/ ?>