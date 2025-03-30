<!DOCTYPE html>
<html>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

    <body>
<div class="container">
    <h1>Edit Post</h1>

    <?php if(session('error')): ?>
    <div class="alert alert-danger">
        <?php echo e(session('error')); ?>

    </div>
    <?php endif; ?>

    <form action="<?php echo e(route('post.update', ['id' => $post->id])); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="<?php echo e(old('title', $post->title)); ?>">
        </div>

        <div class="form-group">
            <label for="content">Content</label>
            <textarea class="form-control" id="content" name="content"><?php echo e(old('content', $post->content)); ?></textarea>
        </div>

        <div class="form-group">
            <label for="img">Image</label>
            <input type="file" class="form-control-file" id="img" name="img">
            <?php if($post->img): ?>
            <img src="<?php echo e(asset('storage/' . $post->img)); ?>" alt="Current Image" width="100">
            <?php endif; ?>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div> 
</main> <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html><?php /**PATH C:\xampp\htdocs\Blog-Management\resources\views/user/edit.blade.php ENDPATH**/ ?>