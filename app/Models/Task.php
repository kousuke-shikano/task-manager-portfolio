<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    // 登録可能なカラム
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'due_date',
        'status',
        'priority',
    ];

    // 全てのカラムを一括代入可能にする（必要ない場合は削除可能）
    protected $guarded = [];
}
