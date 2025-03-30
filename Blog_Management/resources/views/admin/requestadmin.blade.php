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
            <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('user.register') }}">Register</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        </ul>

        <ul class="navbar-nav ml-auto">
    @if(Auth::check())
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
                <img src="/images/profile/pic1.jpg" width="20" alt="">
                <span>{{ Auth::user()->name }}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
            <form action="{{ route('admin.logout') }}" method="POST">
    @csrf
    <button type="submit" class="dropdown-item">Logout</button>
</form>

            </div>
        </li>
    @endif
</ul>
    </div>
</nav>
</body>