<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
      body {
    background-color: #f4f6f9;
    font-family: 'Arial', sans-serif;
}

/* Navbar */
.navbar {
    background: linear-gradient(45deg, #007bff, #0056b3);
    padding: 15px;
}

.navbar-brand {
    color: white !important;
    font-weight: bold;
    font-size: 22px;
}

.navbar-toggler {
    border: none;
}

.navbar-toggler-icon {
    background-color: white;
}

.navbar-nav .nav-item {
    margin-right: 20px;
}

.nav-link {
    color: white !important;
    font-size: 16px;
    transition: color 0.3s ease-in-out;
}

.nav-link:hover {
    color: #ffd700 !important;
    text-shadow: 0px 0px 5px rgba(255, 215, 0, 0.7);
}

/* Dropdown */
.dropdown-menu {
    background-color: white;
    border-radius: 8px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.15);
}

.dropdown-item {
    color: black;
    transition: 0.3s;
}

.dropdown-item:hover {
    background: #007bff;
    color: white;
}

/* User Info */
.header-info {
    display: inline-block;
    margin-left: 8px;
    font-size: 16px;
    color: white;
}

/* Container */
.container {
    margin-top: 30px;
    padding: 20px;
    background: white;
    border-radius: 12px;
    box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
}

/* Blog Table */
.table {
    margin-top: 20px;
}

.table th {
    background-color: #007bff;
    color: white;
    text-align: center;
}

.table td {
    text-align: center;
    vertical-align: middle;
}

.table img {
    border-radius: 8px;
    object-fit: cover;
}

/* Buttons */
.btn-primary {
    background: linear-gradient(45deg, #007bff, #0056b3);
    border: none;
    padding: 8px 15px;
    border-radius: 8px;
    font-size: 14px;
    transition: 0.3s;
}

.btn-primary:hover {
    background: linear-gradient(45deg, #0056b3, #003f7f);
    transform: translateY(-2px);
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
}

.btn-danger {
    background: linear-gradient(45deg, #dc3545, #a71d2a);
    border: none;
    padding: 8px 15px;
    border-radius: 8px;
    font-size: 14px;
    transition: 0.3s;
}

.btn-danger:hover {
    background: linear-gradient(45deg, #a71d2a, #780b1a);
    transform: translateY(-2px);
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
}
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg">
    <a class="navbar-brand" href="#">Laravel 11 Blog Site</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item"><a class="nav-link" href="<?php echo e(route('home')); ?>">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="<?php echo e(route('user.register')); ?>">Register</a></li>
            <li class="nav-item"><a class="nav-link" href="<?php echo e(route('admin.requestadmin')); ?>">Request Post</a></li>
            <!-- <li class="nav-item"><a class="nav-link" href="<?php echo e(route('user.login')); ?>" style="margin-left: 1000px;">Login</a></li> -->
        </ul>

        <ul class="navbar-nav ml-auto">
    <?php if(Auth::check()): ?>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
                <img src="/images/profile/pic1.jpg" width="20" alt="">
                <span><?php echo e(Auth::user()->name); ?></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
            <form action="<?php echo e(route('admin.logout')); ?>" method="POST">
    <?php echo csrf_field(); ?>
    <button type="submit" class="dropdown-item">Logout</button>
</form>

            </div>
        </li>
    <?php endif; ?>
</ul>
    </div>
</nav>

<!-- Main Content -->
<div class="container">
    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <div class="text-center">
        <h2>Admin Dashboard</h2>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Image</th>
                <th>Title</th>
                <th>Content</th>
                <th>Author</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if($posts->count() > 0): ?>
                <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td>
                            <img src="<?php echo e(asset('storage/' . $post->img)); ?>" alt="Post Image" width="100">
                        </td>
                        <td><?php echo e($post->title); ?></td>
                        <td><?php echo e(Str::limit($post->content, 50)); ?></td>
                        <td><?php echo e($post->user->name ?? 'Unknown'); ?></td>
                        <td><?php echo e($post->created_at->format('d M Y, h:i A')); ?></td>
                        <td><?php echo e($post->updated_at->format('d M Y, h:i A')); ?></td>
                        <td>
                            <form action="<?php echo e(route('post.delete', ['id' => $post->id])); ?>" method="POST" style="display:inline;">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" class="text-center">No posts found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
<?php /**PATH C:\xampp\htdocs\Blog-Management\resources\views/admin/dashboardadmin.blade.php ENDPATH**/ ?>