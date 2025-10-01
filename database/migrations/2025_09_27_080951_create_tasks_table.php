<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            // このタスクを所有するユーザーのID
            // 'constrained()' は users テーブルを参照する外部キーを作成
            // 'onDelete('cascade')' はユーザー削除時にそのユーザーのタスクも削除

            $table->string('title');
            // タスクのタイトル

            $table->text('description')->nullable();
            // タスクの詳細説明（任意）

            $table->enum('status', ['pending','in_progress','done'])->default('pending');
            // タスクの状態（未着手、進行中、完了）

            $table->enum('priority', ['low', 'medium', 'high'])->default('medium');
            // タスクの優先度（低、中、高）

            $table->date('due_date')->nullable();
            // タスクの期限日（任意）

            $table->timestamps();
            // created_at と updated_at のタイムスタンプ
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
