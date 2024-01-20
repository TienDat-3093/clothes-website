<?php

namespace App\Http\Controllers\Api;

use App\Models\Comments;
use App\Models\Products;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class APICommentsController extends Controller
{
    public function getUserComment($id){
        $usercomment = Comments::join('users', 'comments.users_id', '=', 'users.id')
        ->select('comments.*', 'users.username')
        ->where('comments.users_id', $id)
        ->get();
        return response()->json([
            'success'=>true,
            'data' => $usercomment,
        ]);
    }
    public function deleteUserComment($id){
        $comment = Comments::where('id',$id)->first();
        $id = $comment->products_id;
        $comment->delete();
        $ratings = Comments::where('products_id',$id)->get('ratings');
        $staravg = 0;
        $count = 0;
        foreach($ratings as $rating){
            $staravg += $rating->ratings;
            $count++;
        }
        $staravg = $staravg / $count;
        $product = Products::where('id',$id)->first();
        $product->star_avg = $staravg;
        $product->save();
        return response()->json([
            'success'=>true,
            'message' => 'Comment deleted',
        ]);
    }
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
        $ratings = Comments::where('products_id',$request['products_id'])->get('ratings');
        $staravg = 0;
        $count = 0;
        foreach($ratings as $rating){
            $staravg += $rating->ratings;
            $count++;
        }
        $staravg = $staravg / $count;
        $product = Products::where('id',$request['products_id'])->first();
        $product->star_avg = $staravg;
        $product->save();
        return response()->json(['message' => 'Comment added']);
    }
}
