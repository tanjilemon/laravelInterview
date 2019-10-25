<?php $__env->startSection('content'); ?>
    <style>
        .table-filter{
            display: block;
            width:100%;
            padding:15px;
        }
    </style>
    <div class="container">
        <div class="row"><br><br><br><br>
            <div class="col-md-12">
                <div class="table-filter">
                    <form class="form-inline">
                        <div class="form-group mb-2">
                            <input type="text" class="form-control filter-name" id="staticEmail2" placeholder="search here">
                        </div>
                        <div class="form-group mx-sm-3 mb-2">
                            <input type="date" class="form-control filter-date" id="inputPassword2" placeholder="Date">
                        </div>
                        <div class="form-group">
                            <select class="form-control filter-group" id="exampleFormControlSelect1">
                                <option value="null">Choose one</option>
                                <option value="all">All Groups</option>
                                <?php $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($group->type); ?>">
                                    <?php if($group->type == 'upload'): ?>
                                        Content Upload
                                    <?php elseif($group->type == 'curation'): ?>
                                        Content Curation
                                    <?php elseif($group->type == 'rss-automation'): ?>
                                        RSS Automation
                                    <?php endif; ?>
                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </form>
                </div>
                <table class="table table-bordered">
                    <thead class="thead-dark" style="background: #9d9d9d;color:#fff;">
                    <tr>
                        <th scope="col">Group Name</th>
                        <th scope="col">Group Type</th>
                        <th scope="col">Account Name</th>
                        <th scope="col">Post Text</th>
                        <th scope="col">Time</th>
                    </tr>
                    </thead>
                    <tbody class="ajax-content">
                    <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <th scope="row"><?php echo e($post->groupInfo->name); ?></th>
                            <td>
                                <?php if($post->groupInfo->type == 'upload'): ?>
                                    <span>Content Upload</span>
                                <?php elseif($post->groupInfo->type == 'curation'): ?>
                                    <span>Content Curation</span>
                                <?php elseif($post->groupInfo->type == 'rss-automation'): ?>
                                    <span>RSS Automation</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="account-info" style="position: relative;">
                                    <img src="<?php echo e($post->accountInfo->avatar); ?>" alt="<?php echo e($post->accountInfo->name); ?>" style="width: 48px;height: 48px;border-radius: 50%;" class="img-responsive">
                                    <span style="position: absolute;top: -10px;left: 35%;background: #398ee6;padding: 5px;border-radius: 50%;height: 30px;width: 30px; display: flex;justify-content: center;align-items: center;color: #fff;    border: 2px solid #fff;">
                                        <?php if($post->accountInfo->type == 'facebook'): ?>
                                            <i class="fa fa-facebook" aria-hidden="true"></i>
                                        <?php elseif($post->accountInfo->type == 'linkedin'): ?>
                                            <i class="fa fa-linkedin" aria-hidden="true"></i>
                                        <?php elseif($post->accountInfo->type == 'google'): ?>
                                            <i class="fa fa-google" aria-hidden="true"></i>
                                        <?php elseif($post->accountInfo->type == 'twitter'): ?>
                                            <i class="fa fa-twitter" aria-hidden="true"></i>
                                        <?php elseif($post->accountInfo->type == 'instagram'): ?>
                                            <i class="fa fa-instagram" aria-hidden="true"></i>
                                        <?php endif; ?>
                                    </span>
                                </div>
                            </td>
                            <td><?php echo e($post->post_text); ?></td>
                            <td> <?php echo e(Carbon\Carbon::parse($post->updated_at)->format('j M, Y h:i a')); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <div style="width: 100%;display: block;text-align: center;">
                    <?php echo e($posts->links()); ?>

                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script>
        $(document).ready(function(){
            $('.filter-group').change(function () {
                var value = $(this).val();
                $.ajax({
                    url: "<?php echo e(route('search-type')); ?>",
                    data : {type:value},
                    type: "get",
                    success : function(response){
                        console.log(response);
                        $('.ajax-content').html(response);
                    },

                });
//                console.log($(this).val());
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>