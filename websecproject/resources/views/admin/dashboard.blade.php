<!doctype html>
<html lang="ar">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard</title>

    <!-- Bootstrap (CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MDI Icons (CDN) -->
    <link href="https://cdn.materialdesignicons.com/7.2.96/css/materialdesignicons.min.css" rel="stylesheet">

    <style>
        body { background:#f4f6f9; }
        .content-wrapper { padding: 24px; }
        .card { border:0; border-radius:14px; box-shadow: 0 6px 18px rgba(0,0,0,.06); }
        .card-body { padding:18px; }
        .metric-title { font-size: 13px; color:#6c757d; margin:0; }
        .metric-value { font-weight:700; margin:0; }
    </style>
</head>

<body>

<nav class="navbar navbar-dark bg-dark px-3">
    <span class="navbar-brand mb-0 h1">Admin Panel</span>
</nav>

<div class="container-fluid">
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
