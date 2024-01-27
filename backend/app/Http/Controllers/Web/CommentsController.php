<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Comments;
use App\Models\Users;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;


class CommentsController extends Controller
{
    public function List()
    {
        $listComment = Comments::all();
        return view('comment/index', compact('listComment'));
    }
    public function Search(Request $request)
    {
        $keyword = $request->input('data');

        if (empty($keyword)) {
            $listComment = Comments::all();
        } else {
            $user_id = Users::where('username', 'like', "%$keyword%")->pluck('id')->toArray();

            if (!empty($user_id)) {
                $listComment = Comments::whereIn('users_id', $user_id)->get();
            } else {
                $listComment = [];
            }
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
    public function ViewPDF()
    {
        $data = Comments::all();
        $pdf = PDF::loadView('comment.pdf',  compact('data'));
        return $pdf->stream('Comment.pdf');
    }
}
