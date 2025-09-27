<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // タスク一覧表示
    public function index()
    {
        // DBから全タスク取得（取得してビューに渡す）
        $tasks = Task::orderBy('created_at', 'desc')->get();
        return view('tasks.index', compact('tasks'));
    }

    // 新規作成フォーム表示
    public function create()
    {
        return view('tasks.create');
    }

    // 新規タスク保存
    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
        ]);

        // タスク作成
        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
        ]);
        //保存後は一覧にリダイレクト
        return redirect()->route('tasks.index')->with('success', 'タスクを作成しました');
    }

    // タスク詳細表示
    public function show(Task $task)
    {
        return view('tasks.show', compact('task')); 
    }

    // 編集フォーム表示
    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    // タスク更新
    public function update(Request $request, Task $task)
    {
        // バリデーション
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
        ]);

        // 更新
        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
        ]);

        return redirect()->route('tasks.index')->with('success', 'タスクを更新しました');
    }

    // タスク削除
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'タスクを削除しました');
    }
}
