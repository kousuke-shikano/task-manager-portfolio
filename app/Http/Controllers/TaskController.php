<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
class TaskController extends Controller
{
    // ログイン必須にする
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * タスク一覧
     */
    public function index(Request $request)
    {
        $query = Task::where('user_id', Auth::id());

        if ($request->filled('priority')) {
            $query->where('priority', $request->priority);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $tasks = $query->get();

        return view('tasks.index', compact('tasks'));
    }

    /**
     * 新規作成フォーム
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * タスク保存
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'priority' => 'nullable|in:low,medium,high',
            'status' => 'nullable|in:pending,in_progress,done',
        ]);

        $validated['user_id'] = Auth::id();
        $validated['priority'] = $validated['priority'] ?? 'medium';
        $validated['status'] = $validated['status'] ?? 'pending';

        Task::create($validated);

        return redirect()->route('tasks.index')->with('success', 'タスクを作成しました');
    }

    /**
     * タスク詳細
     */
    public function show(Task $task)
    {
        $this->authorizeTask($task);
        return view('tasks.show', compact('task'));
    }

    /**
     * 編集フォーム
     */
    public function edit(Task $task)
    {
        $this->authorizeTask($task);
        return view('tasks.edit', compact('task'));
    }

    /**
     * タスク更新
     */
    public function update(Request $request, Task $task)
    {
        $this->authorizeTask($task);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'priority' => 'required|in:low,medium,high',
            'status' => 'required|in:pending,in_progress,done',
        ]);

        $task->update($validated);

        return redirect()->route('tasks.show', $task)->with('success', 'タスクを更新しました');
    }

    /**
     * タスク削除
     */
    public function destroy(Task $task)
    {
        $this->authorizeTask($task);
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'タスクを削除しました');
    }

    /**
     * ステータス更新
     */
    public function updateStatus(Request $request, Task $task)
    {
        $this->authorizeTask($task);

        $validated = $request->validate([
            'status' => 'required|in:pending,in_progress,done',
        ]);

        $task->update(['status' => $validated['status']]);

        return redirect()->route('tasks.index')->with('success', 'ステータスを更新しました');
    }

    /**
     * 自分のタスクかどうか確認
     */
    private function authorizeTask(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            abort(403, 'このタスクを操作する権限がありません');
        }
    }
}
