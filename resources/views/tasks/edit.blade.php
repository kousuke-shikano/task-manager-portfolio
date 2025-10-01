<x-app-layout>
    <div class="container mx-auto py-8 px-4">
        <h1 class="text-2xl font-bold mb-4">タスク編集</h1>

        <form action="{{ route('tasks.update', $task->id) }}" method="POST" class="bg-white shadow rounded p-4">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="block font-medium mb-1">タイトル</label>
                <input type="text" name="title" id="title" value="{{ old('title', $task->title) }}"
                       class="border rounded px-3 py-2 w-full">
            </div>

            <div class="mb-3">
                <label for="description" class="block font-medium mb-1">説明</label>
                <textarea name="description" id="description" class="border rounded px-3 py-2 w-full">{{ old('description', $task->description) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="due_date" class="block font-medium mb-1">期限</label>
                <input type="date" name="due_date" id="due_date" value="{{ old('due_date', $task->due_date) }}"
                       class="border rounded px-3 py-2 w-full">
            </div>

            <div class="mb-3">
                <label for="priority" class="block font-medium mb-1">優先度</label>
                <select name="priority" id="priority" class="border rounded px-3 py-2 w-full">
                    <option value="low" {{ old('priority', $task->priority) == 'low' ? 'selected' : '' }}>低</option>
                    <option value="medium" {{ old('priority', $task->priority) == 'medium' ? 'selected' : '' }}>中</option>
                    <option value="high" {{ old('priority', $task->priority) == 'high' ? 'selected' : '' }}>高</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="status" class="block font-medium mb-1">ステータス</label>
                <select name="status" id="status" class="border rounded px-3 py-2 w-full">
                    <option value="pending" {{ old('status', $task->status) == 'pending' ? 'selected' : '' }}>未着手</option>
                    <option value="in_progress" {{ old('status', $task->status) == 'in_progress' ? 'selected' : '' }}>進行中</option>
                    <option value="done" {{ old('status', $task->status) == 'done' ? 'selected' : '' }}>完了</option>
                </select>
            </div>

            <div class="flex gap-2">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">更新</button>
                <a href="{{ route('tasks.index') }}" class="bg-gray-300 hover:bg-gray-400 text-black px-4 py-2 rounded">一覧に戻る</a>
            </div>
        </form>
    </div>
</x-app-layout>
