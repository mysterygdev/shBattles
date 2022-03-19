<?php $__env->startSection('index', 'addProduct'); ?>
<?php $__env->startSection('title', 'Add Product'); ?>
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
                      <div class="card align-items-center">
                        <div class="card-header">
                          <h5>Add Product</h5>
                        </div>
                        <div class="card-body">
                          <?php if(isset($_POST['submit'])): ?>
                            <?php if(!empty($data['addProduct']->checkErrors())): ?>
                              <!-- TODO: SHOW ALL ERRORS, NOT JUST ONE -->
                              
                              <?php if(count($data['addProduct']->errors)): ?>
                                <ul>
                                <?php $__currentLoopData = $data['addProduct']->errors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                              <?php endif; ?>
                            <?php else: ?>
                              <?php if($data['addProduct']->insertProduct() == true): ?>
                                <p><strong class="font-weight-bold">Product created successfully.</strong></p>
                              <?php else: ?>
                                Could not create new product.
                              <?php endif; ?>
                            <?php endif; ?>
                          <?php endif; ?>

                          <p>First select an image, and then fill out the rest of the information.</p>
                          <p>Only one Item id and count are required. fill out as many as you like to create a package product.</p>

                          <form method="post">
                            <?php
                              //echo $data['addProduct']->getPagination();
                              echo $data['addProduct']->loadImages();
                            ?>

                            <p id="response"></p>
                            
                            <br>
                            
                            
                            <div class="form-group">
                              <label for="ProductName">Product Name</label>
                              <input type="text" class="form-control" id="ProductName" name="ProductName" placeholder="Enter product name" value="<?php echo e(isset($data['addProduct']->name) ? $data['addProduct']->name : ''); ?>">
                              <small id="ProductName" class="form-text text-muted">Product Name</small>
                            </div>
                            <div class="form-group">
                              <label for="ProductDesc">Product Description</label>
                              <input type="text" class="form-control" id="ProductDesc" name="ProductDesc" placeholder="Enter product description" value="<?php echo e(isset($data['addProduct']->desc) ? $data['addProduct']->desc : ''); ?>">
                              <small id="ProductDesc" class="form-text text-muted">Product Description</small>
                            </div>
                            <div class="form-group">
                              <label for="ProductCost">Product Cost</label>
                              <input type="text" class="form-control" id="ProductCost" name="ProductCost" placeholder="Enter product cost" value="<?php echo e(isset($data['addProduct']->cost) ? $data['addProduct']->cost : ''); ?>">
                              <small id="ProductCost" class="form-text text-muted">Product Cost</small>
                            </div>
                            <div class="form-group">
                              <label for="ProductCategory">Product Category</label>
                              <?php if(!empty((WEBMALL['categories']))): ?>
                                <select name="category" class="form-control">
                                  <option value="n/a">Select a category..</option>
                                    <?php $__currentLoopData = WEBMALL['categories']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                      <option value="<?php echo e($id); ?>"><?php echo e($category); ?></option>
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
                                    <option value="<?php echo e($id); ?>"><?php echo e($tag); ?></option>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <small id="ProductTag" class="form-text text-muted">Product Tag</small>
                              <?php else: ?>
                                It looks like there are no tag options. Please make edits to the corresponding configuration file.
                              <?php endif; ?>
                            </div>
                            <div class="col-sm-4 form-group input_fields_wrap">
                              <div class="input-group mb-3">
                                <input type="text" class="form-control" name="Prod[ItemID][]" placeholder="Item ID">
                                <input type="text" class="mx-3 form-control" name="Prod[ItemCount][]" placeholder="Item Count">
                                <button class="btn btn-primary add_field_button">+</button>
                              </div>
                            </div>
                            <?php separator(20) ?>
                            <button type="submit" class="btn btn-sm btn-primary" name="submit">Create Product</button>
                          </form>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.ap.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\shaiyabattles\resources\views/pages/ap/webmall/addProduct.blade.php ENDPATH**/ ?>