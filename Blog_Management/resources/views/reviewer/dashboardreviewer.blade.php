<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reviewer Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
      body {
          background-color: #f4f6f9;
          font-family: 'Arial', sans-serif;
      }

      .navbar {
          background: linear-gradient(45deg, #007bff, #0056b3);
          padding: 15px;
      }

      .navbar-brand {
          color: white !important;
          font-weight: bold;
          font-size: 22px;
      }

      .navbar-nav .nav-link {
          color: white !important;
          font-size: 16px;
          transition: color 0.3s;
      }

      .nav-link:hover {
          color: #ffd700 !important;
          text-shadow: 0px 0px 5px rgba(255, 215, 0, 0.7);
      }

      .container {
          margin-top: 30px;
          padding: 20px;
          background: white;
          border-radius: 12px;
          box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
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
            <li class="nav-item"><a class="nav-link" href="{{ route('reviewer.requestreviewer') }}">Request Post</a></li>
        </ul>

        <ul class="navbar-nav ml-auto">
            @if(Auth::check())  
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
                        <img src="/images/profile/pic1.jpg" width="20" alt="">
                        <span>{{ Auth::user()->name }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item">
                            Logout
                        </a>

                        <form id="logout-form" action="{{ route('reviewer.logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            @else
                <li class="nav-item"><a class="nav-link" href="{{ route('reviewer.loginreviewer') }}">Logout</a></li>
            @endif
        </ul>
    </div>
</nav>

<!-- Main Content -->
<div class="container">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="text-center">
        <h2>Reviewer Dashboard</h2>
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
            @if($posts->count() > 0)
                @foreach($posts as $post)
                    <tr>
                        <td>
                            <img src="{{ asset('storage/' . $post->img) }}" alt="Post Image" width="100">
                        </td>
                        <td>{{ $post->title }}</td>
                        <td>{{ Str::limit($post->content, 50) }}</td>
                        <td>{{ $post->user->name ?? 'Unknown' }}</td>
                        <td>{{ $post->created_at->format('d M Y, h:i A') }}</td>
                        <td>{{ $post->updated_at->format('d M Y, h:i A') }}</td>
                        <td>
                            <form action="{{ route('post.delete', ['id' => $post->id]) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="7" class="text-center">No posts found.</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
