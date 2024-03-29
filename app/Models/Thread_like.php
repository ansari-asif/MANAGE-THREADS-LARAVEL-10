<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thread_like extends Model
{
    use HasFactory;
    protected $table="thread_likes";
    protected $fillable=['thread_id','user_id'];
}
