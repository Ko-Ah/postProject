<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','post_id','parent_id','title','body'];

    public function posts(){
        return $this->belongsTo(Post::class);
    }
    public function subComments(){
        return $this->hasMany(Comment::class,'parent_id');
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
