<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    /**
     * タスク一覧を表示
     */
    public function index()
    {
        $tasks = Task::all(); // DBから全タスク取得
        return view('tasks.index', compact('tasks')); // ビューに渡す
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
            'user_id' => 1, // 認証導入前の暫定値
        ]);

        return redirect()->route('tasks.index')->with('success', 'タスクを作成しました');
    }

    /**
     * タスク詳細表示
     */
    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    /**
     * 編集フォーム表示
     */
    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    /**
     * 編集内容をDBに保存
     */
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
        ]);

        $task->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('tasks.index')->with('success', 'タスクを更新しました');
    }

    /**
     * タスク削除
     */
    public function destroy(Task $task)
    {
        $task->delete(); // 論理削除にする場合は softDelete
        return redirect()->route('tasks.index')->with('success', 'タスクを削除しました');
    }
}
