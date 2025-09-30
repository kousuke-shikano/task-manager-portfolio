@extends('layouts.app')

@section('content')
<div class="container">
    <h1>タスク詳細</h1>

    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">{{ $task->title }}</h5>
            <p class="card-text">{{ $task->description }}</p>
            <p class="card-text"><strong>期限:</strong> {{ $task->due_date }}</p>
            <p class="card-text"><small class="text-muted">作成日: {{ $task->created_at }}</small></p>
        </div>
    </div>

    <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning">編集</a>

    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger"
            onclick="return confirm('削除してよろしいですか？')">削除</button>
    </form>

    <a href="{{ route('tasks.index') }}" class="btn btn-secondary">一覧に戻る</a>
</div>
@endsection
