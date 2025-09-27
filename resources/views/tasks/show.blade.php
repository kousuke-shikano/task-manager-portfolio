{{-- resources/views/tasks/show.blade.php --}}
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>タスク詳細</title>
</head>
<body>
    <h1>タスク詳細</h1>

    <p><strong>タイトル:</strong> {{ $task->title }}</p>
    <p><strong>説明:</strong> {{ $task->description }}</p>

    <a href="{{ route('tasks.edit', $task->id) }}">編集</a>

    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit">削除</button>
    </form>

    <a href="{{ route('tasks.index') }}">一覧に戻る</a>
</body>
</html>
