<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    // ここに登録可能なカラムを列挙
    protected $fillable = ['user_id','title', 'description', 'due_date']; 
    protected $guarded = []; // 全てのカラムを一括代入可能にする

}
