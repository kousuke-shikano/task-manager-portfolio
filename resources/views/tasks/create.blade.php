{{-- resources/views/tasks/create.blade.php --}}
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>タスク作成</title>
</head>
<body>
    <h1>新しいタスクを作成</h1>

    <form action="{{ route('tasks.store') }}" method="POST">
        @csrf
        <div>
            <label for="title">タイトル:</label>
            <input type="text" name="title" id="title" value="{{ old('title') }}" required>
        </div>

        <div>
            <label for="description">説明:</label>
            <textarea name="description" id="description">{{ old('description') }}</textarea>
        </div>

        <div>
            <label for="priority">優先度:</label>
            <select name="priority" id="priority">
                <option value="low" {{ old('priority', $task->priority ?? '') == 'low' ? 'selected' : '' }}>低</option>
                <option value="medium" {{ old('priority', $task->priority ?? 'medium') == 'medium' ? 'selected' : '' }}>中</option>
                <option value="high" {{ old('priority', $task->priority ?? '') == 'high' ? 'selected' : '' }}>高</option>
            </select>
        </div>

        <div>
            <label for="due_date">期限日:</label>
            <input type="date" name="due_date" id="due_date" value="{{ old('due_date') }}">
        </div>

        <button type="submit">保存</button>
    </form>

    <a href="{{ route('tasks.index') }}">戻る</a>
</body>
</html>
