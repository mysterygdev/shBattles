<?php $__env->startSection('index', 'support'); ?>
<?php $__env->startSection('title', 'Support'); ?>
<?php $__env->startSection('zone', 'CMS'); ?>
<?php $__env->startSection('content'); ?>
  <?php echo $__env->make('partials.cms.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <section class="page-name parallax" data-paroller-factor="0.1" data-paroller-type="background" data-paroller-direction="vertical">
  <div class="container">
    <div class="row">
      <h1 class="page-title">
        Support
      </h1>
      <div class="breadcrumbs">
        <a href="#">Home</a> /
        <a href="#">User</a> /
        <span class="color-1">Support</span>
      </div>
    </div>
  </div>
  </section>
  <?php echo e(display('get_ticket_modal','','0','2','Create Ticket')); ?>

  <?php echo e(display('get_e_ticket_modal','','0','2','Edit Ticket')); ?>

  <section class="blog-content ptb150 each-element">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-7 col-xs-12">
          <div class="title-bl text-center wow fadeIn" data-wow-duration="2s">
            <div class="title color-white">
              Support
            </div>
          </div>
            <div class="text-center">
              <?php if (\Illuminate\Support\Facades\Blade::check('guest')): ?>
              <p>Please login to continue.</p>
              <?php else: ?>
              <div class="tabs info-tabs default-tabs text-center mt60">
                <div class="tabs-nav">
                  <ul class="list-inline nav nav-tabs fsize-0">
                    <li class="active">
                      <a href="#biografy" data-toggle="tab" class="fsize-14 fweight-700 uppercase" aria-expanded="true">
                        My Tickets
                      </a>
                    </li>
                    <li class="">
                      <a href="#tickos" data-toggle="tab" data-id="<?php echo e($data['user']->UserUID); ?>" class="fsize-14 fweight-700 uppercase" aria-expanded="false">
                        New Ticket
                      </a>
                    </li>
                  </ul>
                </div>
                <div class="tab-content relative">
                  <div class="tab-pane fade text-left clearfix active in" id="biografy">
                    <div class="main-text p60">
                      <div class="table-responsive dataTables_wrapper no-footer" id="TableLoader">
                        <table class="display dTables dataTable table table-sm table-dark table-striped text-center" id="TabularData">
                          <thead>
                            <tr class="text-center">
                              <td>Ticket ID</td>
                              <td>Subject</td>
                              <td>Status</td>
                              <td>Last Updated</td>
                              <td>Edit</td>
                            </tr>
                          </thead>
                          <tbody>
                              <?php
                                #display('get_e_ticket_modal','<i class="fas fa-user-plus"></i>','0','2','Edit Ticket');
                                $data['support']->getTickets();
                              ?>
                              <?php $__currentLoopData = $data['support']->fet; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <tr>
                                <td class="text-center"><?php echo e($res->TicketID); ?></td>
                                <td class="text-center"><?php echo e($res->Subject); ?></td>
                                <td class="text-center"><?php echo e($data['data']->tracker($res->Status)); ?></td>
                                <td class="text-center"><?php echo e($data['data']->convertTimeToDate('F d, Y h:i', $res->Date)); ?></td>
                                <td class="text-center"><a href="/support/ticket/<?php echo e($res->TicketID); ?>" target="_blank" class="btn gradient color-white">Edit</a></td>
                              </tr>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
              <div class="tab-pane fade text-left clearfix" id="tickos">
              <form class="send_ticket" method="POST">
                      <div class="text-center">
                        <label for="MessageTest">Please provide as much detail as possible so we can best assist you.</label>
                      </div>
                  <p id="response"></p>
                  <div class="row m_b_10">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                      <div class="text-center">
                        <label for="MessageTest">Category:</label>
                      </div>
                      <div class="input-wrap">
                        <select name="Category" id="Category" class="form-control form-custom tac">
                          <option>Choose One</option>
                          <option>Billing</option>
                          <option>Bug Reports</option>
                          <option>Player Reports</option>
                          <option>Ban Appeal</option>
                          <option>GM Services</option>
                          <option>Technical Issues</option>
                          <option>Others</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row m_b_10">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                      <div class="text-center">
                        <label for="MessageTest">Subject:</label>
                      </div>
                      <div class="input-wrap">
                        <input type="text" name="Subject" placeholder="Subject" class="form-control form-custom tac b_i"/>
                      </div>
                    </div>
                  </div>
                  <div class="row m_b_10">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                      <div class="text-center">
                        <label for="MessageTest">Message:</label>
                      </div>
                      <div class="input-wrap">
                        <textarea name="Message" placeholder="Message" class="form-control form-custom tac b_i"></textarea>
                      </div>
                    </div>
                  </div>
                  <?php Separator(20); ?>
                  <div class="row m_b_10">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                      <button type="button" class="btn gradient color-white text-center" id="send_ticket_submit">Create Ticket <i class="fa fa-send"></i></button>
                    </div>
                  </div>
                </form>
                </div>
                </div>
                </div>
              <?php endif; ?>
            </div>
        </div>
        <?php echo $__env->make('partials.cms.widgets', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      </div>
    </div>
  </section>
  <script>
	$(document).ready(function(){
		$("button#send_ticket_submit").click(function(){
			$.ajax({
				type: "POST",
				url:"/resources/jquery/addons/ajax/site/support/send_ticket_submit.php",
				data: $("form.send_ticket").serialize(),
				success: function(message){
					$("#response").html(message);
					$("#TableLoader").load(location.href + " #TabularData");
				},
				error: function(){
					alert("Error");
				}
			});
		});
	});
</script>
	<?php echo $__env->make('layouts.cms.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.cms.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\ShaiyaCMS\resources\views/pages/cms/help/support.blade.php ENDPATH**/ ?>