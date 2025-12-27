<?php
    $selector = true;
?>

<?php $__env->startSection('title', 'Create SMS'); ?>

<?php $__env->startSection('nav_left'); ?>
    <?php echo $__env->make('admin.layouts.partials._left_nuv_bar', [
        'second' => 'SMS',
        'sRoute' => route('sms-workers.index'),
        'third' => 'Create',
    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_header'); ?>
    <?php echo $__env->make('admin.layouts.partials._page_header', [
        'title' => 'SMS Worker',
        'pTitle' => 'SMS',
        'pSubtitle' => 'Create',
        'pSRoute' => route('sms-workers.index'),
    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main_content'); ?>
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Create SMS</h3>
    </div>

    <form method="POST" action="<?php echo e(route('sms-workers.store')); ?>">
        <?php echo csrf_field(); ?>

        <div class="card-body">

            
            <div class="form-group row">
                <label class="col-lg-3">Receiver Number</label>
                <div class="col-lg-9">
                    <input type="text"
                           name="receiver"
                           class="form-control <?php $__errorArgs = ['receiver'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                           placeholder="01XXXXXXXXX"
                           value="<?php echo e(old('receiver')); ?>">
                    <?php $__errorArgs = ['receiver'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="invalid-feedback"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>

            
            <div class="form-group row">
                <label class="col-lg-3">Message</label>
                <div class="col-lg-9">
                    <textarea name="body"
                              rows="4"
                              class="form-control <?php $__errorArgs = ['body'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                              placeholder="Enter SMS content"><?php echo e(old('body')); ?></textarea>
                    <?php $__errorArgs = ['body'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="invalid-feedback"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>

            
            <div class="form-group row">
                <label class="col-lg-3">Sender</label>
                <div class="col-lg-9">
                    <input type="text"
                           name="sender"
                           class="form-control <?php $__errorArgs = ['sender'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                           value="<?php echo e(old('sender', '01517851911')); ?>">
                    <?php $__errorArgs = ['sender'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="invalid-feedback"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>

            
            <div class="form-group row">
                <label class="col-lg-3">Status</label>
                <div class="col-lg-9">
                    <select name="status"
                            class="form-control <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                        <option value="create">Create</option>
                        <option value="sent">Sent</option>
                        <option value="paid">Paid</option>
                        <option value="complete">Complete</option>
                    </select>
                    <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="invalid-feedback"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>

        </div>

        <div class="card-footer">
            <button class="btn btn-primary">
                <i class="fas fa-save"></i> Save SMS
            </button>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/Njobs/resources/views/admin/sms_workers/create.blade.php ENDPATH**/ ?>