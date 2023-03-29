<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{

    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'body'=>['required','unique:comments','string','regex:/^[^@]{5,}$/','min:5'],
            'commentTitle'=>['required','string','max:225'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }
        if($request->parentId == '0'){
            $comment =  Comment::create([
                "user_id"=> Auth::id(),
                'post_id' =>$request->postId,
                'parent_id' =>'0',
                'title' =>$request->commentTitle,
                'body' =>$request->body,
            ]);
            $data =$comment;
            $data['user'] =User::find($comment->user_id);
            return response()->json(['data'=>$data]);
        }else if($request->parentId > '0'){
            $reply =  Comment::create([
                "user_id"=> Auth::id(),
                'post_id' =>$request->postId,
                'parent_id' =>$request->parentId,
                'title' =>$request->commentTitle,
                'body' =>$request->body,
            ]);
            $data['reply'] =$reply;
            $data['user'] =User::find($reply->user_id);
            return response()->json(['data'=>$data]);
        }


    }
}
