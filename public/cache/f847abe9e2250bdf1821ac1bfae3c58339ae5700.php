<?php $__env->startSection('index', 'events'); ?>
<?php $__env->startSection('title', 'Events'); ?>
<?php $__env->startSection('zone', 'AP'); ?>
<?php $__env->startSection('content'); ?>
  <?php echo $__env->make('partials.ap.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php echo $__env->make('partials.ap.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <div class="pcoded-main-container">
    <div class="pcoded-wrapper">
      <div class="pcoded-content">
        <div class="pcoded-inner-content">
          
          <?php if($data['user']->isAuthorized()): ?>
            
            <?php if($data['user']->isADM() || $data['user']->isGM() || $data['user']->isGMA()): ?>
            <?php echo e(display('get_ticket_modal','','0','2','View Ticket')); ?>

              <div class="main-body">
                <div class="page-wrapper">
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="card align-items-center">
                        <div class="card-header">
                          <h5>Events</h5>
                        </div>
                        <div class="card-body">
                          <a href="/admin/site/newEvent" class="btn btn-sm btn-primary float-right">New Event</a>
                          <?php separator(50) ?>
                          <?php if(count($data['events']->getEvents()) > 0): ?>
                            <p id="response"></p>
                            <table class="table table-striped" id="events">
                              <thead>
                                <tr>
                                  <th>Event ID</th>
                                  <th>Title</th>
                                  <th>Details</th>
                                  <th>Start Time</th>
                                  <th>End Time</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php $__currentLoopData = $data['events']->getEvents(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <form method="post">
                                    <tr>
                                      <td><?php echo e($res->EventID); ?></td>
                                      <td>
                                        <input type="text" class="form-control" name="eventTitle<?php echo e($res->EventID); ?>" value="<?php echo e($res->Title); ?>"/>
                                      </td>
                                      <td>
                                        <input type="text" class="form-control" name="eventDetails<?php echo e($res->EventID); ?>" value="<?php echo e($res->Details); ?>"/>
                                      </td>
                                      <td>
                                        <input type="text" class="form-control" name="eventStartTime<?php echo e($res->EventID); ?>" value="<?php echo e($res->StartTime); ?>"/>
                                      </td>
                                      <td>
                                        <input type="text" class="form-control" name="eventEndTime<?php echo e($res->EventID); ?>" value="<?php echo e($res->EndTime); ?>"/>
                                      </td>
                                      <td>
                                        <button class="btn btn-sm btn-primary" name="submit" id="submit" data-id="<?php echo e($res->EventID); ?>">Update</button>
                                      </td>
                                      <td>
                                        <button class="btn btn-sm btn-danger" id="delete" data-id="<?php echo e($res->EventID); ?>">Delete</button>
                                      </td>
                                    </tr>
                                  </form>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              </tbody>
                            </table>
                          <?php else: ?>
                            There are no events to edit.
                          <?php endif; ?>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <?php endif; ?>
          <?php else: ?>
            <?php echo e(redirect('/admin/auth/login')); ?>

          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
  <script>
    $(document).ready(function(){
        $("button#submit").click(function(e){
          e.preventDefault();

          let eventId = $(this).data("id");
          let eventTitle = $("input[name=eventTitle"+eventId + "]").val();
          let eventDetails = $("input[name=eventDetails"+eventId + "]").val();
          let eventStartTime = $("input[name=eventStartTime"+eventId + "]").val();
          let eventEndTime = $("input[name=eventTitle"+eventId + "]").val();

          $.ajax(
                {
                    url: '/admin/site/updateEvent',
                    method: 'POST',
                    data: {
                        eventId,
                        eventTitle,
                        eventDetails,
                        eventStartTime,
                        eventEndTime,
                    },
                    success: function(response) {
                        $("#response").html(response);
                    },
                    dataType: 'text'
                }
            )
        });
        $("button#delete").click(function(e){
          e.preventDefault();

          let eventId = $(this).data("id");

          $.ajax(
                {
                    url: '/admin/site/deleteEvent',
                    method: 'POST',
                    data: {
                        eventId
                    },
                    success: function(response) {
                        $("#response").html(response);
                    },
                    dataType: 'text'
                }
            )
        });
    });
  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.ap.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\shaiyabattles\resources\views/pages/ap/site/events.blade.php ENDPATH**/ ?>