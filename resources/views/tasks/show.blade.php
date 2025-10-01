<x-app-layout>
    <div class="container mx-auto py-8 px-4">
        <h1 class="text-2xl font-bold mb-4">タスク詳細</h1>

        <div class="bg-white shadow rounded p-4 mb-4">
            <h2 class="text-xl font-semibold mb-2">{{ $task->title }}</h2>
            <p class="mb-2">{{ $task->description }}</p>
            <p class="mb-2"><strong>期限:</strong> {{ $task->due_date }}</p>

            <p class="mb-2"><strong>優先度:</strong>
                <span class="px-2 py-1 rounded
                    {{ $task->priority == 'high' ? 'bg-red-500 text-white' : '' }}
                    {{ $task->priority == 'medium' ? 'bg-yellow-300 text-black' : '' }}
                    {{ $task->priority == 'low' ? 'bg-green-500 text-white' : '' }}">
                    {{ $task->priority == 'high' ? '高' : ($task->priority == 'medium' ? '中' : '低') }}
                </span>
            </p>

            <p class="mb-2"><strong>ステータス:</strong>
                <span class="px-2 py-1 rounded
                    {{ $task->status == 'pending' ? 'bg-gray-400 text-white' : '' }}
                    {{ $task->status == 'in_progress' ? 'bg-blue-300 text-black' : '' }}
                    {{ $task->status == 'done' ? 'bg-green-500 text-white' : '' }}">
                    {{ $task->status == 'pending' ? '未着手' : ($task->status == 'in_progress' ? '進行中' : '完了') }}
                </span>
            </p>

            <p class="text-gray-500 text-sm">作成日: {{ $task->created_at }}</p>
        </div>

        <a href="{{ route('tasks.edit', $task->id) }}" class="bg-yellow-300 hover:bg-yellow-400 text-black px-4 py-2 rounded">編集</a>
        <a href="{{ route('tasks.index') }}" class="bg-gray-300 hover:bg-gray-400 text-black px-4 py-2 rounded">一覧に戻る</a>
    </div>
</x-app-layout>
