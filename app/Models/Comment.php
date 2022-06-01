<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fallible = [
        'comment_text',
        'comment_by',
        'commentable_type',
        'commentable_id'
    ];
}
