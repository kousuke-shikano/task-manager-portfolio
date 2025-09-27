{{-- resources/views/tasks/edit.blade.php --}}
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>タスク編集</title>
</head>
<body>
    <h1>タスク編集</h1>

    <form action="{{ route('tasks.update', $task->id) }}" method="POST">
        @csrf
        @method('PUT') {{-- Laravelで更新時に必要 --}}

        <div>
            <label for="title">タイトル:</label>
            <input type="text" name="title" id="title" value="{{ old('title', $task->title) }}" required>
            @error('title')
                <p style="color:red;">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="description">説明:</label>
            <textarea name="description" id="description">{{ old('description', $task->description) }}</textarea>
        </div>

        <button type="submit">更新</button>
    </form>

    <a href="{{ route('tasks.index') }}">戻る</a>
</body>
</html>
