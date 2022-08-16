<!-- Modal -->
<div class="modal fade" id="<?php echo e('comments' . $file->id); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="background-color: white !important">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?php echo e(__('Comments')); ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body p-4">
        <?php $__currentLoopData = $file->comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <p><b><?php echo e($comment->user->name); ?> (<?php echo e($comment->date); ?>)</b>: <?php echo e($comment->comment); ?></p>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
      <div class="modal-footer">
        <input type="text" class="form-control" name="comment">

        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(__('Close')); ?></button>
        <button type="button" class="btn btn-primary"><?php echo e(__('Send comment')); ?></button>
      </div>
    </div>
  </div>
</div>
<?php /**PATH /home/i9finance/public_html/resources/views/files/comments.blade.php ENDPATH**/ ?>