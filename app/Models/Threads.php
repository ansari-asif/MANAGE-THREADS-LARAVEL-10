<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Threads extends Model
{
    use HasFactory;
    protected $fillable=['title','description','user_id'];

    function user(){
        return $this->belongsTo(User::class);
    }

    function tags(){
        return $this->belongsToMany(ThreadsTags::class,'thread_tags_map','thread_id','tag_id')->withTimestamps();
    }

    public function likes()
    {
        return $this->belongsToMany(User::class, 'thread_likes','thread_id')->withTimestamps();
    }

    function comments(){
        return $this->belongsToMany(User::class,'thread_comments','thread_id')
                ->using(Thread_comment::class)
                ->withPivot('comment')
                ->withTimestamps()
                ->orderBy('thread_comments.created_at','desc');
    }

}
