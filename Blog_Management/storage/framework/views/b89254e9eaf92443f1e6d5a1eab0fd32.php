<!DOCTYPE html>
<html>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<head>
    <!-- Add your CSS styles here to style the tiles -->
    <style>
body {
    background-color: #f9fafb;
    font-family: 'Arial', sans-serif;
    
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

.navbar {
    background: linear-gradient(45deg, #6a11cb, #2575fc);
}

.navbar-brand {
    color: white !important;
    font-weight: bold;
    font-size: 22px;
}

.navbar-nav .nav-link {
    color: white !important;
    font-size: 18px;
    margin-right: 15px;
    transition: 0.3s;
}

.navbar-nav .nav-link:hover {
    color: #ffd700 !important;
}

.post-tile {
    background: #ffffff;
    border-radius: 10px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    padding: 20px;
    transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
}

.post-tile:hover {
    transform: translateY(-5px);
    box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.15);
}

.post-title {
    font-size: 22px;
    font-weight: bold;
    color: #333;
}

.post-content {
    font-size: 16px;
    color: #555;
}

.card {
    border: none;
    border-radius: 12px;
    overflow: hidden;
    transition: all 0.3s ease-in-out;
}

.card:hover {
    transform: scale(1.03);
    box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.15);
}

.card img {
    border-top-left-radius: 12px;
    border-top-right-radius: 12px;
    height: 200px;
    object-fit: cover;
}

.card-body {
    background: #ffffff;
    padding: 20px;
}

.card-title {
    font-size: 18px;
    font-weight: bold;
}

.card-subtitle {
    font-size: 14px;
    color: #666;
}

.card-text {
    font-size: 14px;
    color: #777;
}

h1 {
    color: #333;
    font-size: 28px;
    font-weight: bold;
}


    </style>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#"><b>Laravel 11 Blog Site</b></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href=" ">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/user/register">Register</a>
      </li>
      
      <li class="nav-item">
        <a class="nav-link" href="/user/login" style="margin-left: 1000px;">Login</a>
      </li>
       
    </ul>
   
  </div>
</nav><main role="main" class="container">
    <div class="my-3 p-3 bg-white rounded box-shadow">
        <h1 class="mb-4 my-3 p-3 bg-white rounded box-shadow text-center">Our Blog Site</h1>
        <h6 class="border-bottom border-gray pb-2 mb-4">Recent updates</h6>

        <!-- Loop through the posts and display them as tiles -->
        <div class="row">
            <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $user = $post->user; // Assuming there's a user relationship in your Post model
                ?>

                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="<?php echo e(asset('storage/' . $post->img)); ?>" alt="Image" class="card-img-top">
                        <div class="card-body">
                            <?php if($user): ?>
                                <h5 class="card-title">Created By: <?php echo e($user->name); ?></h5>
                            <?php else: ?>
                                <h5 class="card-title">Unknown User</h5>
                            <?php endif; ?>
                            <h6 class="card-subtitle mb-2 text-muted">Title: <?php echo e($post->title); ?></h6>
                            <p class="card-text">Content: <?php echo e($post->content); ?></p>
                            <p class="card-text">Created At: <?php echo e($post->created_at); ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <!-- End of posts -->
    </div>
    <?php echo e($posts->links()); ?>

</main>
 <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>

<?php /**PATH C:\xampp\htdocs\Blog-Management\resources\views/welcome.blade.php ENDPATH**/ ?>