<?php

namespace App\Models;

use App\Contracts\Likeable;
use App\Concerns\Likes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model implements Likeable
{
    use HasFactory;
    use Likes;

    protected $fillable = ['user_id','cat_id',"title",'subtitle','banner_image','content'];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function categories(){
        return $this->belongsTo(Category::class,'cat_id');
    }

    public function tags(){
        return $this->morphToMany(Tag::class,'taggable');
    }
    public function comments(){
        return $this->hasMany(Comment::class)->latest();
    }

}
