@extends('layouts.app')

@section('content')
<div class="container">
    <h1>タスク詳細</h1>

    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">{{ $task->title }}</h5>
            <p class="card-text">{{ $task->description }}</p>
            <p class="card-text"><strong>期限:</strong> {{ $task->due_date }}</p>

            {{-- 優先度 --}}
            <p class="card-text">
                <strong>優先度:</strong>
                <span class="badge
                    @if($task->priority == 'high') bg-danger
                    @elseif($task->priority == 'medium') bg-warning text-dark
                    @else bg-success
                    @endif
                ">
                    @if($task->priority == 'high') 高
                    @elseif($task->priority == 'medium') 中
                    @else 低
                    @endif
                </span>
            </p>

            {{-- ステータス --}}
            <p class="card-text">
                <strong>ステータス:</strong>
                <span class="badge
                    @if($task->status == 'pending') bg-secondary
                    @elseif($task->status == 'in_progress') bg-info text-dark
                    @else bg-success
                    @endif
                ">
                    @if($task->status == 'pending') 未着手
                    @elseif($task->status == 'in_progress') 進行中
                    @else 完了
                    @endif
                </span>
            </p>

            <p class="card-text"><small class="text-muted">作成日: {{ $task->created_at }}</small></p>
        </div>
    </div>

    <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning">編集</a>
    <a href="{{ route('tasks.index') }}" class="btn btn-secondary">一覧に戻る</a>
</div>
@endsection
