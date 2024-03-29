<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
class Thread_comment extends Pivot
{
    use HasFactory;
    protected $table="thread_comments";
    protected $fillable=['thread_id','user_id','comment'];
}
