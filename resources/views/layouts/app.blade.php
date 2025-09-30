<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Task Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">Task Manager</a>
            <a class="nav-link text-light" href="{{ route('tasks.index') }}">タスク一覧</a>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>
</body>
</html>
