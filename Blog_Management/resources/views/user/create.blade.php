<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
    </style>
</head>

<body>
    <div class="container">
        <br>
        <h2>Create a New Post</h2>
        <form method="POST" action="{{ route('post.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="content">Content</label>
                <textarea class="form-control" id="content" name="content" rows="4" required></textarea>
            </div>
            <div class="form-group">
                <label for="img">Image</label>
                <input type="file" class="form-control-file" id="img" name="img">
            </div>

            <!-- Terms and Conditions Checkbox -->
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="terms" required>
                <label class="form-check-label" for="terms">I agree to the <a href="{{ route('terms') }}">Terms and Conditions</a></label>
            </div>

            <button type="submit" class="btn btn-primary" id="submitBtn" disabled>Create Post</button>
        </form>
    </div>

    <script>
        document.getElementById('terms').addEventListener('change', function () {
            document.getElementById('submitBtn').disabled = !this.checked;
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>


