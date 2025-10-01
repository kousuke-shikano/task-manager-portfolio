@extends('layouts.app')

@section('content')
<div class="container">
    <h1>タスク一覧</h1>

    <a href="{{ route('tasks.create') }}" class="btn btn-primary mb-3">新規タスク作成</a>

    @if($tasks->isEmpty())
        <p>まだタスクがありません。</p>
        
    {{-- フィルタ解除ボタン --}}
        <a href="{{ route('tasks.index') }}" class="btn btn-secondary">一覧に戻る</a>
    @else
        <form method="GET" action="{{ route('tasks.index') }}" class="mb-3">
            <label for="priorityFilter">優先度で絞り込み:</label>
            <select name="priority" id="priorityFilter" onchange="this.form.submit()">
                <option value="">全て</option>
                <option value="low" {{ request('priority') == 'low' ? 'selected' : '' }}>低</option>
                <option value="medium" {{ request('priority') == 'medium' ? 'selected' : '' }}>中</option>
                <option value="high" {{ request('priority') == 'high' ? 'selected' : '' }}>高</option>
            </select>
        </form>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>タイトル</th>
                    <th>優先度</th>
                    <th>期限</th>
                    <th>ステータス</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tasks as $task)
                    <tr>
                        <td>{{ $task->id }}</td>
                        <td>{{ $task->title }}</td>
                        <td>
                            {{-- 優先度に色付きバッジ --}}
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
                        </td>
                        <td>{{ $task->due_date }}</td>
                        <td>
                            {{-- ステータス日本語表示 --}}
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

                            {{-- ステータス切り替えボタン --}}
                            @if ($task->status !== 'done')
                                <form action="{{ route('tasks.updateStatus', $task->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="done">
                                    <button type="submit" class="btn btn-success btn-sm">完了にする</button>
                                </form>
                            @else
                                <form action="{{ route('tasks.updateStatus', $task->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="pending">
                                    <button type="submit" class="btn btn-secondary btn-sm">未完了に戻す</button>
                                </form>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('tasks.show', $task->id) }}" class="btn btn-info btn-sm">詳細</a>
                            <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning btn-sm">編集</a>
                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('削除してよろしいですか？')">削除</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
