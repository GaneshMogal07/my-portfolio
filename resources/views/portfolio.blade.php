<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Portfolio</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="p-6">
    <header class="mb-6">
        <h1>My Portfolio</h1>
        <nav class="mt-2">
            <a href="{{ route('admin.login') }}">Admin Login</a>
        </nav>
    </header>
    <section>
        <p>Welcome to my portfolio homepage.</p>
    </section>
</body>
</html>
