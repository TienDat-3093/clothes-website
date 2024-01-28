<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Users;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Imports\UsersImport;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;

class UsersController extends Controller
{
    public function List()
    {
        $listUser = Users::all();
        return view('user/index', compact('listUser'));
    }
    public function Search(Request $request)
    {
        $keyword = $request->input('data');
        $listUser = Users::where('username', 'like', "%$keyword%")->get();
        return view('user/results', compact('listUser'));
    }
    public function Delete($id)
    {
        $user = Users::find($id);
        if ($user->status_id == 2) {
            $user->status_id = 1;
            $user->save();
            return redirect()->route('user.index')->with('alert', 'Mở khóa tài khoản user thành công');
        }
        $user->status_id = 2;
        $user->save();
        return redirect()->route('user.index')->with('alert', 'Khóa tài khoản user thành công');
    }
    public function ViewPDF()
    {
        $data = Users::all();
        $pdf = PDF::loadView('user.pdf',  compact('data'));
        return $pdf->stream('User.pdf');
    }
    public function ImportExcel(Request $re)
    {
        // $re->validate([
        //     'import_file' => ['require', 'file'],
        // ]);

        Excel::import(new UsersImport, $re->file('import_file'));

        return redirect()->back()->with('alert', "Import successfully");
    }
    public function ExportExcel(Request $re)
    {
        if ($re->type == 'xlsx') {

            $files = 'xlsx';
            $format = \Maatwebsite\Excel\Excel::XLSX;
        } elseif ($re->type == 'csv') {

            $files = 'csv';
            $format = \Maatwebsite\Excel\Excel::CSV;
        } elseif ($re->type == 'xls') {

            $files = 'xls';
            $format = \Maatwebsite\Excel\Excel::XLS;
        } elseif ($re->type == 'html') {

            $files = 'html';
            $format = \Maatwebsite\Excel\Excel::HTML;
        } else {

            $files = 'xlsx';
            $format = \Maatwebsite\Excel\Excel::XLSX;
        }

        $filename = "Users-" . date('d-m-Y') . "." . $files;
        return Excel::download(new UsersExport, $filename, $format);
    }
}
