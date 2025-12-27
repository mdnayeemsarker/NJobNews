<?php
    $selector = true;
?>
<?php $__env->startSection('title', 'Ads'); ?>

<?php $__env->startSection('nav_left'); ?>
    <?php echo $__env->make('admin.layouts.partials._left_nuv_bar', [
        'second' => 'Ads',
        'sRoute' => route('ads.index'),
        'third' => 'Create',
    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_header'); ?>
    <?php echo $__env->make('admin.layouts.partials._page_header', [
        'title' => 'Ads',
        'pTitle' => 'Ads',
        'pSubtitle' => 'Index',
        'pSRoute' => route('ads.index'),
    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main_content'); ?>
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Ad Create</h3>
        </div>
        <form method="POST" action="<?php echo e(route('ads.store')); ?>" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="card-body">

                
                <div class="form-group row">
                    <label for="location" class="col-lg-3">Location</label>
                    <div class="col-lg-9">
                        <input type="text" name="location"
                            class="form-control <?php $__errorArgs = ['location'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            id="location" placeholder="Enter Ad Location"
                            value="<?php echo e(old('location')); ?>">
                        <?php $__errorArgs = ['location'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="invalid-feedback"><strong><?php echo e($message); ?></strong></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                
                <div class="form-group row">
                    <label for="thumb" class="col-lg-3">Thumbnail</label>
                    <div class="file-selector-container col-lg-9">
                        <div class="file-selector-item single-selector col-lg-6"
                            data-toggle="modal"
                            data-target="#fileSelectorModal"
                            data-selection-type="single"
                            data-input-name="thumb"
                            data-title="Select Ad Thumbnail">
                            <i class="fa fa-file"></i>
                            <span>Select Thumbnail</span>
                            <div class="selected-files single-file-names mt-2 text-muted"></div>
                        </div>
                    </div>
                </div>

                
                <div class="form-group row">
                    <label for="link" class="col-lg-3">Link</label>
                    <div class="col-lg-9">
                        <input type="url" name="link"
                            class="form-control <?php $__errorArgs = ['link'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            id="link" placeholder="Enter Ad Link"
                            value="<?php echo e(old('link')); ?>">
                        <?php $__errorArgs = ['link'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="invalid-feedback"><strong><?php echo e($message); ?></strong></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                
                <div class="form-group row">
                    <label for="height" class="col-lg-3">Height</label>
                    <div class="col-lg-9">
                        <input type="text" name="height"
                            class="form-control <?php $__errorArgs = ['height'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            id="height" placeholder="Enter Ad Height"
                            value="<?php echo e(old('height')); ?>">
                        <?php $__errorArgs = ['height'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="invalid-feedback"><strong><?php echo e($message); ?></strong></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                
                <div class="form-group row">
                    <label for="width" class="col-lg-3">Width</label>
                    <div class="col-lg-9">
                        <input type="text" name="width"
                            class="form-control <?php $__errorArgs = ['width'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            id="width" placeholder="Enter Ad Width"
                            value="<?php echo e(old('width')); ?>">
                        <?php $__errorArgs = ['width'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="invalid-feedback"><strong><?php echo e($message); ?></strong></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                
                <div class="form-group row">
                    <label for="status" class="col-lg-3">Status</label>
                    <div class="col-lg-9">
                        <select name="status"
                            class="form-control <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            id="status">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                        <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="invalid-feedback"><strong><?php echo e($message); ?></strong></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/Njobs/resources/views/admin/ads/create.blade.php ENDPATH**/ ?>