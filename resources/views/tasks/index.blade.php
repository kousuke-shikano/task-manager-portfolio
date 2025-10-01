<x-app-layout>
    <div class="container mx-auto py-8 px-4">
        <h1 class="text-2xl font-bold mb-4">タスク一覧</h1>

        {{-- 新規作成・一覧ボタン --}}
        <div class="mb-4 flex flex-wrap gap-2">
            <a href="{{ route('tasks.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">新規タスク作成</a>
            <a href="{{ route('tasks.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">一覧に戻る</a>
        </div>

        {{-- タスクが無い場合 --}}
        @if($tasks->isEmpty())
            <p class="text-gray-500">まだタスクがありません。</p>
        @else
            {{-- フィルタ --}}
            <form method="GET" action="{{ route('tasks.index') }}" class="mb-4 flex flex-wrap gap-2 items-center">
                <select name="priority" class="border rounded px-2 py-1">
                    <option value="">優先度すべて</option>
                    <option value="low" {{ request('priority') == 'low' ? 'selected' : '' }}>低</option>
                    <option value="medium" {{ request('priority') == 'medium' ? 'selected' : '' }}>中</option>
                    <option value="high" {{ request('priority') == 'high' ? 'selected' : '' }}>高</option>
                </select>

                <select name="status" class="border rounded px-2 py-1">
                    <option value="">ステータスすべて</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>未着手</option>
                    <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>進行中</option>
                    <option value="done" {{ request('status') == 'done' ? 'selected' : '' }}>完了</option>
                </select>

                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded">絞り込み</button>
                <a href="{{ route('tasks.index') }}" class="bg-gray-300 hover:bg-gray-400 text-black px-3 py-1 rounded">リセット</a>
            </form>

            {{-- タスクテーブル --}}
            <table class="table-auto border-collapse border border-gray-300 w-full">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border px-2 py-1">ID</th>
                        <th class="border px-2 py-1">タイトル</th>
                        <th class="border px-2 py-1">優先度</th>
                        <th class="border px-2 py-1">期限</th>
                        <th class="border px-2 py-1">ステータス</th>
                        <th class="border px-2 py-1">操作</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tasks as $task)
                    <tr class="text-center">
                        <td class="border px-2 py-1">{{ $task->id }}</td>
                        <td class="border px-2 py-1">{{ $task->title }}</td>
                        <td class="border px-2 py-1">
                            <span class="px-2 py-1 rounded 
                                {{ $task->priority == 'high' ? 'bg-red-500 text-white' : '' }}
                                {{ $task->priority == 'medium' ? 'bg-yellow-300 text-black' : '' }}
                                {{ $task->priority == 'low' ? 'bg-green-500 text-white' : '' }}">
                                {{ $task->priority == 'high' ? '高' : ($task->priority == 'medium' ? '中' : '低') }}
                            </span>
                        </td>
                        <td class="border px-2 py-1">{{ $task->due_date }}</td>
                        <td class="border px-2 py-1">
                            <span class="px-2 py-1 rounded
                                {{ $task->status == 'pending' ? 'bg-gray-400 text-white' : '' }}
                                {{ $task->status == 'in_progress' ? 'bg-blue-300 text-black' : '' }}
                                {{ $task->status == 'done' ? 'bg-green-500 text-white' : '' }}">
                                {{ $task->status == 'pending' ? '未着手' : ($task->status == 'in_progress' ? '進行中' : '完了') }}
                            </span>

                            {{-- ステータス切替 --}}
                            <form action="{{ route('tasks.updateStatus', $task->id) }}" method="POST" class="inline-block ml-2">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="{{ $task->status == 'done' ? 'pending' : 'done' }}">
                                <button type="submit" class="px-2 py-1 text-sm rounded
                                    {{ $task->status == 'done' ? 'bg-gray-500 text-white' : 'bg-green-500 text-white' }}">
                                    {{ $task->status == 'done' ? '未完了に戻す' : '完了にする' }}
                                </button>
                            </form>
                        </td>
                        <td class="border px-2 py-1">
                            <a href="{{ route('tasks.show', $task->id) }}" class="bg-blue-300 hover:bg-blue-400 px-2 py-1 rounded text-white text-sm">詳細</a>
                            <a href="{{ route('tasks.edit', $task->id) }}" class="bg-yellow-300 hover:bg-yellow-400 px-2 py-1 rounded text-black text-sm">編集</a>
                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-600 px-2 py-1 rounded text-white text-sm"
                                    onclick="return confirm('削除してよろしいですか？')">削除</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</x-app-layout>
