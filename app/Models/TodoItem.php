<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TodoItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_name',
        'user_id',
        'created_at',
        'item_description',
        'done'
    ];

    protected $table = 'todo_items';
}
