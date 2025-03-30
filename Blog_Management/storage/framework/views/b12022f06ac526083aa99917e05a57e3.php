<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
/* General Styling */
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
    <!-- Bootstrap Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#"> Laravel 11 Blog Site </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                <a class="nav-link active" href="<?php echo e(route('home')); ?>">Home</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link active" href="#">Dashboard <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(route('user.register')); ?>">Register</a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(route('user.login')); ?>" style="margin-left: 100px;">Login</a>
                </li> -->
            </ul>

            <ul class="navbar-nav ml-auto">
                <!-- User Profile Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="/images/profile/pic1.jpg" width="20" alt="">
                        <div class="header-info">
                            <?php if(isset($LoggedUser)): ?>
                                <span><?php echo e($LoggedUser->name); ?></span>
                            <?php endif; ?>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                        <form id="logout-form" action="<?php echo e(route('user.logout')); ?>" method="post">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="dropdown-item ai-icon" style="border: none; background: none;">
                                <svg xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18" height="18"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                    <polyline points="16 17 21 12 16 7"></polyline>
                                    <line x1="21" y1="12" x2="9" y2="12"></line>
                                </svg>
                                <span class="ml-2">Logout</span>
                            </button>
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <?php if(session('success')): ?>
            <div class="alert alert-success mt-2">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <div class="container">
            <br>
            <div class="text-center">
                <h2><?php echo e($LoggedUser->name ?? 'Your'); ?> Blog Posts</h2>
            </div>
            <a href="<?php echo e(route('post.create')); ?>" class="btn btn-primary mb-3 btn-sm">Create New Blog</a>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Content</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(isset($LoggedUser) && $LoggedUser->posts->count() > 0): ?>
                        <?php $__currentLoopData = $LoggedUser->posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>
                                    <img src="<?php echo e(asset('storage/' . $post->img)); ?>" alt="Image" width="100">
                                </td>
                                <td><?php echo e($post->title); ?></td>
                                <td><?php echo e(Str::limit($post->content, 50)); ?></td>
                                <td>
                                    
                                <a href="<?php echo e(route('post.edit', ['id' => $post->id])); ?>" class="btn btn-primary btn-sm">Edit</a>


<form action="<?php echo e(route('post.delete', ['id' => $post->id])); ?>" method="POST" style="display:inline;">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form> 
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center">You don't have any posts yet.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap JavaScript dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
<?php /**PATH C:\xampp\htdocs\Blog-Management\resources\views/user/dashboard.blade.php ENDPATH**/ ?>