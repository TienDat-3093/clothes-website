<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Comments;
use App\Models\Users;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function List()
    {
        $listComment=Comments::all();
        return view('comment/index',compact('listComment'));
    }
    public function Search(Request $request)
    {
        $keyword = $request->input('data');
        if($keyword!=null){
            $user_id = Users::where('username', 'like', "%$keyword%")->pluck('id');
            if($user_id->isEmpty())
                $listComment = Comments::where('users_id', -1)->get();
            else
                $listComment = Comments::where('users_id', "$user_id[0]")->get();
            }
        else{
            $listComment = Comments::all();
        }
        return view('comment/results', compact('listComment'));
    }
    public function Delete($id)
    {
        $comment = Comments::find($id);
        $comment->status_id = 2;
        $comment->save();
        return redirect()->route('comment.index')->with('alert', 'Xóa comment thành công');
    }
}
