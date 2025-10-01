@extends('layouts.app')

@section('content')
<div class="container">
    <h1>タスク編集</h1>

    <form action="{{ route('tasks.update', $task->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">タイトル</label>
            <input type="text" name="title" id="title" class="form-control"
                   value="{{ old('title', $task->title) }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">内容</label>
            <textarea name="description" id="description" class="form-control" rows="3">{{ old('description', $task->description) }}</textarea>
        </div>

        <div>
            <label for="priority">優先度:</label>
            <select name="priority" id="priority">
                    <option value="low" {{ old('priority', $task->priority ?? '') == 'low' ? 'selected' : '' }}>低</option>
                    <option value="medium" {{ old('priority', $task->priority ?? 'medium') == 'medium' ? 'selected' : '' }}>中</option>
                    <option value="high" {{ old('priority', $task->priority ?? '') == 'high' ? 'selected' : '' }}>高</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="due_date" class="form-label">期限</label>
            <input type="date" name="due_date" id="due_date" class="form-control"
                   value="{{ old('due_date', $task->due_date) }}">
        </div>

        <button type="submit" class="btn btn-primary">更新</button>
        <a href="{{ route('tasks.show', $task->id) }}" class="btn btn-secondary">戻る</a>
    </form>
</div>
@endsection
