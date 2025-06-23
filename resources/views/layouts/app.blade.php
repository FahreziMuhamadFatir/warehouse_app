<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Warehouse</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background-color: #f8f9fa;
        }

        .sidebar {
            width: 250px;
            min-height: 100vh;
            background: linear-gradient(135deg, #007bff, #0056b3);
            color: white;
            padding: 20px;
        }

        .sidebar a {
            color: white;
            display: block;
            padding: 10px 15px;
            border-radius: 8px;
            text-decoration: none;
            margin-bottom: 10px;
            transition: background-color 0.3s ease;
        }

        .sidebar a:hover {
            background-color: rgba(255,255,255,0.15);
        }

        .sidebar h2 {
            font-size: 1.5rem;
            text-align: center;
            margin-bottom: 30px;
        }

        .content-wrapper {
            flex-grow: 1;
            padding: 30px;
            overflow-x: hidden;
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <div class="sidebar flex-shrink-0">
            @include('partials.sidebar')
        </div>

        <div class="content-wrapper">
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
