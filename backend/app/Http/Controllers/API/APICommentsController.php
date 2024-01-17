<?php

namespace App\Http\Controllers\Api;

use App\Models\Comments;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class APICommentsController extends Controller
{
    public function getComment($id){
        $comments = Comments::join('users', 'comments.users_id', '=', 'users.id')
    ->select('comments.*', 'users.username')
    ->where('comments.products_id', $id)
    ->get();
        return response()->json([
            'success' => true,
            'data' => $comments,
        ]);
    }
    public function Comment(){
        $request = request(['content','users_id','products_id','ratings']);
        $comment = new Comments();
        $comment->content = $request['content'];
        $comment->users_id = $request['users_id'];
        $comment->products_id = $request['products_id'];
        $comment->ratings = $request['ratings'];
        $comment->save();
        return response()->json(['message' => 'Comment added']);
    }
}
