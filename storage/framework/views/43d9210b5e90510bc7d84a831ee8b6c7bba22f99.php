<div class="card bg-none card-box p-5">
    <form method="POST" action="<?php echo e("/projects/$project->id/files"); ?>" enctype="multipart/form-data">
        <input type="hidden" name="project_id" value="<?php echo e($project->id); ?>">
        <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">

        <input type="file" name="files[]" multiple class="dropify">

        <input type="submit" value="<?php echo e(__('Upload')); ?>" class="btn-create badge-blue">
    </form>
</div>

<script>
    $('.dropify').dropify();
</script>
<?php /**PATH /home/i9finance/public_html/resources/views/files/create.blade.php ENDPATH**/ ?>