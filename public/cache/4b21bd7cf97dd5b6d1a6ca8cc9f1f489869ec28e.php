<?php $__env->startSection('index', 'support'); ?>
<?php $__env->startSection('title', 'Support'); ?>
<?php $__env->startSection('zone', 'CMS'); ?>
<?php $__env->startSection('content'); ?>
  <?php echo $__env->make('partials.cms.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <section class="content-wrap">
    <div class="youplay-banner banner-top youplay-banner-parallax small">
      <div class="image" style="background-image: url('/resources/themes/YouPlay/images/template/banner-blog-bg.jpg')"></div>

      
    </div>

    <div class="container youplay-content text-center">
        <h2 class="mt-0">Ticket</h2>
        <?php if (\Illuminate\Support\Facades\Blade::check('guest')): ?>
          <p>Please login to continue.</p>
        <?php else: ?>
          <?php echo e(display('get_ticket_modal','','0','2','Create Ticket')); ?>

          <?php echo e(display('get_e_ticket_modal','','0','2','Edit Ticket')); ?>

          <?php if(count($data['support']->getTicketData($_SESSION['User']['UserUID'], $data['ticketID'])) > 0): ?>
            <?php $__currentLoopData = $data['support']->getTicketData($_SESSION['User']['UserUID'], $data['ticketID']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div class="row m_b_10">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                  <div class="text-center">
                    <h4 class="u">Editing Ticket: <?php echo e($res->Subject); ?></h4>
                    <h5 class="u">Category: <?php echo e($res->Category); ?></h5>
                  </div>
                </div>
              </div>
              <form class="form-inline">
                <div class="row pl_10_p">
                  <div class="form-group mx-sm-3 mb-2">
                    <label class="pr_5" for="TcktTest">Ticket ID:</label>
                    <input type="text" name="ticketID" value="<?php echo e($res->TicketID); ?>" class="form-control form-custom input-sm tac b_i" readonly/>
                  </div>
                  <div class="form-group mx-sm-3 mb-2">
                    <label class="pr_5" for="SubTest">Subject:</label>
                    <input type="text" name="Subject" value="<?php echo e($res->Subject); ?>" class="form-control form-custom input-sm tac b_i" readonly/>
                  </div>
                </div>
              </form>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <div class="container">
              <?php $__currentLoopData = $data['support']->editTicket($_SESSION['User']['UserUID'], $data['ticketID']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tickets): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($tickets->Type == '0'): ?>
                  <div class="row">
                    <div class="col-md-4 col-md-offset-1 badge-pill badge-lightblue mt1p">
                      <div class="row plr_15">
                        <div class="col-md-12">
                          <p class="b_i"> <?php echo e($data['user']->getUserGameInfo($tickets->UserUID, 'UserID')); ?> said:</p>
                        </div>
                      </div>
                      <div class="row plr_15">
                        <div class="col-md-12">
                          <div class="float-left">
                            <?php echo e($tickets->Message); ?>

                          </div>
                          <div class="float-right">
                            <?php echo e(date('F d, Y h:i:s A', strtotime($tickets->Date))); ?>

                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php Separator(15); ?>
                <?php elseif($tickets->Type == '1'): ?>
                  <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-4 col-md-offset-1 badge-pill badge-indiega mt1p">
                      <div class="row tar plr_15">
                        <div class="col-md-12">
                          <p class="b_i"> <?php echo e($data['user']->getUserGameInfo($tickets->RespUID, 'UserID')); ?> said:</p>
                        </div>
                      </div>
                      <div class="row tar plr_15">
                        <div class="col-md-12">
                          <div class="float-left">
                            <?php echo e($tickets->Message); ?>

                          </div>
                          <div class="float-right">
                            <?php echo e(date('F d, Y h:i:s A', strtotime($tickets->Date))); ?>

                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php Separator(15); ?>
                <?php endif; ?>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <form class="edit_ticket">
              <input type="hidden" name="Category" value="<?php echo e($res->Category); ?>"/>
              <input type="hidden" name="UserUID" value="<?php echo e($res->UserUID); ?>"/>
              <input type="hidden" name="TicketID" value="<?php echo e($res->TicketID); ?>"/>
              <input type="hidden" name="Subject" value="<?php echo e($res->Subject); ?>"/>
              <?php if($res->Status==1 || $res->Status==2 || $res->Status==3): ?>
                <p id="response"></p>
                <div class="row m_b_10">
                  <div class="col-md-3"></div>
                  <div class="col-md-6">
                    <div class="text-center">
                      <label for="MessageTest">Message:</label>
                    </div>
                    <div class="youplay-textarea form-group">
                      <textarea name="Message" placeholder="Your message here..." class="general_input italic"></textarea>
                    </div>
                  </div>
                </div>
                <?php Separator(20); ?>
                <div class="row m_b_10">
                  <div class="col-md-3"></div>
                  <div class="col-md-6">
                    <button type="button" class="btn gradient color-white text-center" id="edit_ticket_answer">Send
                      Message <i class="fa fa-send"></i></button>
                  </div>
                </div>
              <?php else: ?>
              <div class="col-md-12 tac">
                <button class="btn btn-dark f_20">
                  This ticket has been closed and is no longer available for editing.
                </button>
              </div>
              <?php endif; ?>
            </form>
          <?php else: ?>
            <p>🤯 This is not your ticket 🤯</p>
          <?php endif; ?>
        <?php endif; ?>
    </div>
  </section>
  <?php echo $__env->make('layouts.cms.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php echo $__env->make('layouts.cms.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <script>
    $(document).ready(function(){
      $("button#edit_ticket_answer").click(function(){
        $.ajax({
          type: "POST",
          url:"/resources/jquery/addons/ajax/site/support/edit_ticket_answer.php",
          data: $("form.edit_ticket").serialize(),
          success: function(message){
            $("#response").html(message);
          },
          error: function(){
            alert("Error");
          }
        });
      });
    });
  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.cms.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\shaiyabattles\resources\views/pages/cms/help/support/ticket.blade.php ENDPATH**/ ?>