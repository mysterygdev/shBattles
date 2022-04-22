<?php $__env->startSection('index', 'editProduct'); ?>
<?php $__env->startSection('title', 'Edit Product'); ?>
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
              <div class="main-body">
                <div class="page-wrapper">
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="card">
                        <?php if(!isset($_GET['id'])): ?>
                          No product id specified.
                        <?php else: ?>
                          <?php if(!is_numeric($_GET['id'])): ?>
                            Product Id must be a numeric value.
                          <?php else: ?>
                            <?php if(isset($_POST['submit'])): ?>
                              <?php
                                $data['editProduct']->updateProductById($_GET['id']);
                              ?>
                            <?php endif; ?>
                            <?php if(count($data['editProduct']->getProductById($_GET['id'])) > 0): ?>
                              <div class="card-header text-center">
                                <h5>Editing product:
                                  <strong class="font-weight-bold"><?php echo e($data['editProduct']->getProductName($_GET['id'])); ?></strong>
                                </h5>
                              </div>
                              <div class="card-body">
                                <form method="post" id="editProd">
                                  <?php echo e($data['editProduct']->loadImages()); ?>

                                  <p id="response"></p>
                                  <?php $__currentLoopData = $data['editProduct']->getProductById($_GET['id']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="form-group">
                                      <label for="ProductName">Product Name</label>
                                      <input type="text" class="form-control" id="ProductName" name="ProductName" placeholder="Enter product name" value="<?php echo e(isset($fet->ProductName) ? $fet->ProductName : ''); ?>">
                                      <small id="ProductName" class="form-text text-muted">Product Name</small>
                                    </div>
                                    <div class="form-group">
                                      <label for="ProductDesc">Product Description</label>
                                      <input type="text" class="form-control" id="ProductDesc" name="ProductDesc" placeholder="Enter product description" value="<?php echo e(isset($fet->ProductDesc) ? $fet->ProductDesc : ''); ?>">
                                      <small id="ProductDesc" class="form-text text-muted">Product Description</small>
                                    </div>
                                    <div class="form-group">
                                      <label for="ProductCurrency">Product Currency</label>
                                      <input type="text" class="form-control" id="ProductCurrency" name="ProductCurrency" placeholder="Enter product cost" value="<?php echo e(isset($fet->ProductCurrency) ? $fet->ProductCurrency : ''); ?>">
                                      <small id="ProductCurrency" class="form-text text-muted">Product Currency</small>
                                    </div>
                                    <div class="form-group">
                                      <label for="ProductCost">Product Cost</label>
                                      <input type="text" class="form-control" id="ProductCost" name="ProductCost" placeholder="Enter product cost" value="<?php echo e(isset($fet->ProductCost) ? $fet->ProductCost : ''); ?>">
                                      <small id="ProductCost" class="form-text text-muted">Product Cost</small>
                                    </div>
                                    <div class="form-group">
                                      <label for="ProductCategory">Product Category</label>
                                      <?php if(!empty((WEBMALL['categories']))): ?>
                                        <select name="category" class="form-control">
                                          
                                            <?php $__currentLoopData = WEBMALL['categories']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                              <option value="<?php echo e($id); ?>" <?php echo e(($fet->Category == $id) ? 'selected="selected"' : ''); ?>><?php echo e($category); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <small id="ProductCategory" class="form-text text-muted">Product Category</small>
                                      <?php else: ?>
                                        <p>
                                          It looks like there are no category options. Please make edits to the corresponding configuration file.
                                        </p>
                                      <?php endif; ?>
                                    </div>
                                    <div class="form-group">
                                      <label for="ProductTag">Product Tag</label>
                                      <?php if(!empty((WEBMALL['tags']))): ?>
                                        <select name="tag" class="form-control">
                                          <option value="n/a">Select a tag..</option>
                                          <?php $__currentLoopData = WEBMALL['tags']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($id); ?>" <?php echo e(($fet->Tag == $id) ? 'selected="selected"' : ''); ?>><?php echo e($tag); ?></option>
                                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <small id="ProductTag" class="form-text text-muted">Product Tag</small>
                                      <?php else: ?>
                                        It looks like there are no tag options. Please make edits to the corresponding configuration file.
                                      <?php endif; ?>
                                    </div>
                                    <?php
                                      //var_dump($data['editProduct']->getProductItemIds($_GET['id']));
                                      /* foreach ($data['editProduct']->getProductItemIds($_GET['id']) as $res) {
                                        echo 'ssd';
                                      } */
                                    ?>
                                    <div class="col-sm-4 form-group input_fields_wrap">
                                      <?php $index=1; ?>
                                      <?php $__currentLoopData = $data['editProduct']->getProductItemIds($_GET['id']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="input-group mb-3">
                                          <input type="text" class="form-control" name="Prod[ItemID][]" placeholder="Item ID" value="<?php echo e($res->ItemID); ?>">
                                          <input type="text" class="mx-3 form-control" name="Prod[ItemCount][]" placeholder="Item Count" value="<?php echo e($res->ItemCount); ?>">
                                          <?php if($index > 1): ?>
                                            <button class="btn btn-danger remove_field">X</button>
                                          <?php else: ?>
                                            <button class="btn btn-primary add_field_button">+</button>
                                          <?php endif; ?>
                                        </div>
                                        <?php $index++; ?>
                                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                    <?php separator(20) ?>
                                    <button class="btn btn-sm btn-primary" name="submit" id="submit" data-id="<?php echo e($_GET['id']); ?>">Save Changes</button>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </form>
                              </div>
                              <!-- foreach -->
                            <?php else: ?>
                              <div class="card-header text-center">
                                Product doesn't exist.
                              </div>
                              <div class="card-body">
                                Product doesn't exist.
                              </div>
                            <?php endif; ?>
                          <?php endif; ?>
                        <?php endif; ?>
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
        var uid = $(this).data("id");
        ajaxPOST(
          "/resources/jquery/addons/ajax/admin/webmall/product_edit.php",
          $('form#editProd').serialize() + "&id="+uid,
          (message) => {
            $("#response").html(message)
          },
          'error'
        );
        /* ajaxPOST(
          '/resources/jquery/addons/ajax/admin/webmall/product_edit.php',
          1,
          (message) => {
            alert("gg");
            $("#response").html(message)
          },
          (error) => {
            'Error'
          },
        ) */
      });
    });
  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.ap.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\shaiyabattles\resources\views/pages/ap/webmall/editProduct.blade.php ENDPATH**/ ?>