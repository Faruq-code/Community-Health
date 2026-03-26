<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Issue Reporter') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=Syne:wght@700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'DM Sans', sans-serif; background-color: #0D0D0D; color: #FFFFFF; }
        h1, h2, h3, .syne { font-family: 'Syne', sans-serif; }
    </style>
</head>
<body class="antialiased">
    <div class="min-h-screen flex items-center justify-center p-6">
        @yield('content')
    </div>
</body>
</html>
