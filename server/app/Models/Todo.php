<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    protected $attributes = [
        'completed' => false
    ];

    protected $fillable = [
        'user_id',
        'todo_list_id',
        'description',
        'completed'
    ];
}
