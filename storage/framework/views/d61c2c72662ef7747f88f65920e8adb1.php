<?php
    $selector = true;
    $slug = true;
?>

<?php $__env->startSection('title', 'Edit Job'); ?>

<?php $__env->startSection('nav_left'); ?>
    <?php echo $__env->make('admin.layouts.partials._left_nuv_bar', [
        'second' => 'Jobs',
        'sRoute' => route('jobs.index'),
        'third' => 'Edit',
    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_header'); ?>
    <?php echo $__env->make('admin.layouts.partials._page_header', [
        'title' => 'Edit Job',
        'pTitle' => 'Jobs',
        'pSubtitle' => 'Index',
        'pSRoute' => route('jobs.index'),
    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main_content'); ?>
    <form method="POST" action="<?php echo e(route('jobs.update', $job->id)); ?>" class="row">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        
        <div class="col-lg-8">

            
            <div class="card mb-3">
                <h3 class="card-header card-title">Job Details</h3>
                <div class="card-body">

                    
                    <div class="form-group mb-3">
                        <label>Job Title *</label>
                        <input type="text" name="title" id="title"
                            class="form-control <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            value="<?php echo e(old('title', $job->title)); ?>" required>
                        <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    
                    <div class="form-group mb-3">
                        <label>Slug *</label>
                        <input type="text" name="slug" id="slug"
                            class="form-control <?php $__errorArgs = ['slug'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('slug', $job->slug)); ?>"
                            required>
                        <?php $__errorArgs = ['slug'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    
                    <div class="form-group mb-3">
                        <label>Company</label>
                        <input type="text" name="company" class="form-control <?php $__errorArgs = ['company'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            value="<?php echo e(old('company', $job->company)); ?>">
                        <?php $__errorArgs = ['company'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Salary</label>
                            <input type="text" name="salary" class="form-control <?php $__errorArgs = ['salary'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                value="<?php echo e(old('salary', $job->salary)); ?>">
                            <?php $__errorArgs = ['salary'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Vacancy</label>
                            <input type="text" name="vacancy" class="form-control <?php $__errorArgs = ['vacancy'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                value="<?php echo e(old('vacancy', $job->vacancy)); ?>">
                            <?php $__errorArgs = ['vacancy'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Job Type</label>
                            <select name="type" class="form-control">
                                <?php $__currentLoopData = ['full-time', 'part-time', 'contract']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($t); ?>"
                                        <?php echo e(old('type', $job->type) == $t ? 'selected' : ''); ?>>
                                        <?php echo e(ucfirst($t)); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Gender</label>
                            <select name="gender" class="form-control">
                                <?php $__currentLoopData = ['both', 'male', 'female', 'other']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $g): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($g); ?>"
                                        <?php echo e(old('gender', $job->gender) == $g ? 'selected' : ''); ?>>
                                        <?php echo e(ucfirst($g)); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>

                    
                    <div class="form-group mb-3">
                        <label>Educational Requirement</label>
                        <input type="text" name="educational" class="form-control"
                            value="<?php echo e(old('educational', $job->educational)); ?>">
                    </div>

                    
                    <div class="form-group mb-3">
                        <label>Experience</label>
                        <input type="text" name="experience" class="form-control"
                            value="<?php echo e(old('experience', $job->experience)); ?>">
                    </div>

                    
                    <div class="form-group mb-3">
                        <label>Additional Requirement</label>
                        <input type="text" name="additional" class="form-control"
                            value="<?php echo e(old('additional', $job->additional)); ?>">
                    </div>

                    
                    <div class="form-group mb-3">
                        <label>Description</label>
                        <textarea name="description" id="description" class="form-control">
                        <?php echo e(old('description', $job->description)); ?>

                    </textarea>
                    </div>

                </div>
            </div>

            
            <div class="card">
                <h3 class="card-header card-title">SEO Meta</h3>
                <div class="card-body">

                    <div class="form-group mb-3">
                        <label for="meta_title">Meta Title</label>
                        <input type="text" name="meta_title" id="meta_title"
                            class="form-control <?php $__errorArgs = ['meta_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            value="<?php echo e(old('meta_title', $job->meta_title)); ?>">
                        <?php $__errorArgs = ['meta_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="form-group mb-3">
                        <label for="meta_keywords">Meta Keywords</label>
                        <input type="text" name="meta_keywords" id="meta_keywords"
                            class="form-control <?php $__errorArgs = ['meta_keywords'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            value="<?php echo e(old('meta_keywords', $job->meta_keywords)); ?>">
                        <?php $__errorArgs = ['meta_keywords'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="form-group mb-3">
                        <label for="meta_description">Meta Description</label>
                        <textarea name="meta_description" id="meta_description" rows="5"
                            class="form-control <?php $__errorArgs = ['meta_description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"><?php echo e(old('meta_description', $job->meta_description)); ?></textarea>
                        <?php $__errorArgs = ['meta_description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="col-lg-4">

            
            <div class="card">
                <h3 class="card-header card-title">Application Schedule</h3>

                <div class="card-body">

                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="start_date">Start Date *</label>
                            <input type="date" name="start_date" id="start_date"
                                class="form-control <?php $__errorArgs = ['start_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                value="<?php echo e(old('start_date', isset($job) ? $job->start_date : '')); ?>" required>
                            <?php $__errorArgs = ['start_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="start_time">Start Time</label>
                            <input type="time" name="start_time" id="start_time"
                                class="form-control <?php $__errorArgs = ['start_time'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                value="<?php echo e(old('start_time', isset($job) ? $job->start_time : '')); ?>">
                            <?php $__errorArgs = ['start_time'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="deadline_date">Deadline Date *</label>
                            <input type="date" name="deadline_date" id="deadline_date"
                                class="form-control <?php $__errorArgs = ['deadline_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                value="<?php echo e(old('deadline_date', isset($job) ? $job->deadline_date : '')); ?>" required>
                            <?php $__errorArgs = ['deadline_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="deadline_time">Deadline Time</label>
                            <input type="time" name="deadline_time" id="deadline_time"
                                class="form-control <?php $__errorArgs = ['deadline_time'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                value="<?php echo e(old('deadline_time', isset($job) ? $job->deadline_time : '')); ?>">
                            <?php $__errorArgs = ['deadline_time'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                </div>
            </div>

            
            <div class="card">
                <h3 class="card-header card-title">Apply Information</h3>
                <div class="card-body">

                    <div class="form-group mb-3">
                        <label>Apply Method *</label>
                        <select name="apply" class="form-control" required>
                            <?php $__currentLoopData = ['url', 'email', 'in-person', 'address']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($a); ?>"
                                    <?php echo e(old('apply', $job->apply) == $a ? 'selected' : ''); ?>>
                                    <?php echo e(ucfirst($a)); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label>Apply Value *</label>
                        <input type="text" name="apply_value" class="form-control"
                            value="<?php echo e(old('apply_value', $job->apply_value)); ?>" required>
                    </div>

                    <div class="form-group mb-3">
                        <label>Source Link</label>
                        <input type="text" name="source_link" class="form-control"
                            value="<?php echo e(old('source_link', $job->source_link)); ?>">
                    </div>

                </div>
            </div>

            
            <div class="card mb-3">
                <h3 class="card-header card-title">Category</h3>
                <div class="card-body">
                    <select name="category_id" class="form-control">
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($category->id); ?>"
                                <?php echo e(old('category_id', $job->category_id) == $category->id ? 'selected' : ''); ?>>
                                <?php echo e($category->title); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>

            
            <div class="card mb-3">
                <h3 class="card-header card-title">Location</h3>
                <div class="card-body">

                    <select name="division_id" id="division_id" class="form-control mb-3">
                        <?php $__currentLoopData = $divisions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $division): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($division->id); ?>"
                                <?php echo e(old('division_id', $job->division_id) == $division->id ? 'selected' : ''); ?>>
                                <?php echo e($division->name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>

                    <div class="form-group mb-3">
                        <input type="text" name="location" class="form-control"
                            value="<?php echo e(old('location', $job->location)); ?>">
                    </div>

                </div>
            </div>

            
            <div class="card mb-3">
                <h3 class="card-header card-title">Gallery</h3>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="file-selector-container col-lg-12">
                            <div class="file-selector-item single-selector col-lg-12" data-toggle="modal"
                                data-target="#fileSelectorModal" data-selection-type="single" data-input-name="thumb"
                                data-title="Select Thumbnail">
                                <i class="fa fa-file"></i>
                                <span>Select Thumbnail</span>
                                <div class="selected-files single-file-names mt-2 text-muted"></div>
                            </div>
                        </div>
                        <div class="col-lg-12 mt-2">
                            <?php if($job->thumb): ?>
                                <img src="<?php echo e(get_file_url($job->thumb)); ?>" alt="Current Image" class="img-thumbnail"
                                    style="max-width: 100px;">
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="file-selector-container col-lg-12">
                            <div class="file-selector-item single-selector col-lg-12" data-toggle="modal"
                                data-target="#fileSelectorModal" data-selection-type="single"
                                data-input-name="attachment" data-title="Select Attachment">
                                <i class="fa fa-file"></i>
                                <span>Select Attachment</span>
                                <div class="selected-files single-file-names mt-2 text-muted"></div>
                            </div>
                        </div>
                        <div class="col-lg-12 mt-2">
                            <?php if($job->attachment): ?>
                                <a href="<?php echo e(get_file_url($job->attachment)); ?>" target="_blank"
                                    rel="noopener noreferrer">View Attachment</a>
                            <?php endif; ?>
                        </div>
                    </div>

                </div>
            </div>

            
            <div class="card mb-3">
                <h3 class="card-header card-title">Status</h3>
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label for="status">Job Status</label>
                        <select name="status" id="status" class="form-control <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            required>
                            <option value="1" <?php echo e(old('status', $job->status) == 1 ? 'selected' : ''); ?>>Active
                            </option>
                            <option value="0" <?php echo e(old('status', $job->status) == 0 ? 'selected' : ''); ?>>Inactive
                            </option>
                        </select>
                        <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
            </div>

            
            <div class="card">
                <div class="card-body text-center">
                    <button type="submit" class="btn btn-primary w-100">
                        Update Job
                    </button>
                </div>
            </div>

        </div>
    </form>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('plugins/summernote/summernote-bs4.min.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(asset('plugins/summernote/summernote-bs4.min.js')); ?>"></script>
    <script>
        $(function() {
            $('#title').on('keyup change', function() {
                generateSlug(this, document.getElementById('slug'));
            });
            $('#description').summernote()
            CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
                mode: "htmlmixed",
                theme: "monokai",
                height: 500,
                placeholder: 'Write job description here...',
                toolbar: [
                    ['style', ['bold', 'italic', 'underline']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link']],
                    ['view', ['fullscreen', 'codeview']]
                ]
            });
        })
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/Njobs/resources/views/admin/jobs/edit.blade.php ENDPATH**/ ?>