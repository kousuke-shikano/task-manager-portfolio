@extends('layouts.app')

@section('content')
<div class="container">
    <h1>タスク編集</h1>

    <form action="{{ route('tasks.update', $task->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">タイトル</label>
            <input type="text" name="title" id="title" value="{{ old('title', $task->title) }}" class="form-control">
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">説明</label>
            <textarea name="description" id="description" class="form-control">{{ old('description', $task->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="due_date" class="form-label">期限</label>
            <input type="date" name="due_date" id="due_date" value="{{ old('due_date', $task->due_date) }}" class="form-control">
        </div>

        <div class="mb-3">
            <label for="priority" class="form-label">優先度</label>
            <select name="priority" id="priority" class="form-select">
                <option value="low" {{ old('priority', $task->priority) == 'low' ? 'selected' : '' }}>低</option>
                <option value="medium" {{ old('priority', $task->priority) == 'medium' ? 'selected' : '' }}>中</option>
                <option value="high" {{ old('priority', $task->priority) == 'high' ? 'selected' : '' }}>高</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">ステータス</label>
            <select name="status" id="status" class="form-select">
                <option value="pending" {{ old('status', $task->status) == 'pending' ? 'selected' : '' }}>未着手</option>
                <option value="in_progress" {{ old('status', $task->status) == 'in_progress' ? 'selected' : '' }}>進行中</option>
                <option value="done" {{ old('status', $task->status) == 'done' ? 'selected' : '' }}>完了</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">更新</button>
        <a href="{{ route('tasks.index') }}" class="btn btn-secondary">一覧に戻る</a>
    </form>
</div>
@endsection
