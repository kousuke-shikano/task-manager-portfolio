<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    /**
     * タスク一覧を表示,フィルタリングとソート機能追加
     */
    public function index(Request $request)
    {
        $query = Task::where('user_id', 1); // 仮で user_id=1

        // フィルタリング
        if ($request->has('priority') && in_array($request->priority, ['low','medium','high'])) {
            $query->where('priority', $request->priority);
        }

        $tasks = $query->get();

        return view('tasks.index', compact('tasks'));
    }


    /**
     * 新規タスク作成フォーム表示
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * 新しいタスクをDBに保存
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
        ]);

        // 仮に user_id を 1 として挿入
        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'status' => $request->status ?? 'pending',   // 既存
            'priority' => $request->priority ?? 'medium', // ← 追加
            'user_id' => 1,// 認証導入前の暫定値
        ]);

        return redirect()->route('tasks.index')->with('success', 'タスクを作成しました');
    }

    /**
     * タスク詳細表示
     */
    public function show($id)
    {
        // 仮で user_id = 1 の制約を入れる
        $task = \App\Models\Task::where('user_id', 1)->findOrFail($id);

        return view('tasks.show', compact('task'));
    }
    /**
     * 編集フォーム表示
     */
    public function edit(Task $task)
    {
        // user_id のチェックを入れる場合
        if ($task->user_id !== 1) {
            abort(403, 'このタスクを編集する権限がありません');
        }

        return view('tasks.edit', compact('task'));
    }
    /**
     * 編集内容をDBに保存
     */
    public function update(Request $request, Task $task)
    {
        // ユーザー確認（必要なら）
        if ($task->user_id !== 1) {
            abort(403, 'このタスクを編集する権限がありません');
        }

        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'due_date' => 'nullable|date',
            'priority' => 'required|in:low,medium,high',
            'status' => 'required|in:pending,in_progress,done', // ← 追加
        ]);

        $task->update($validated);

        return redirect()->route('tasks.show', $task->id)
                        ->with('success', 'タスクを更新しました。');
    }


    /**
     * タスク削除
     */
    public function destroy(Task $task)
    {
        $task->delete(); // 論理削除にする場合は softDelete
        return redirect()->route('tasks.index')->with('success', 'タスクを削除しました');
    }
    /**
     * タスクのステータス更新
     */
    public function updateStatus(Request $request, Task $task)
    {
        $request->validate([
            'status' => 'required|in:pending,in_progress,done',
        ]);

        $task->update([
            'status' => $request->status,
        ]);

        return redirect()->route('tasks.index')->with('success', 'ステータスを更新しました');
    }
}
