<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateAdminRequest;
use App\Models\Admins;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Imports\AdminsImport;
use App\EXports\AdminsExport;
use Maatwebsite\Excel\Facades\Excel;

class AdminsController extends Controller
{
    public function dashboard()
    {
        return view('dashboard');
    }
    public function login()
    {
        return view('login');
    }
    public function loginHandle(LoginRequest $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            if ($user) {
                if ($user['status_id'] == 2) {
                    return redirect()->route('admin.login')->with('alert', 'Tài khoản đã bị khóa');
                } else {
                    return redirect()->route('dashboard.index');
                }
            }
        }
        return redirect()->route('admin.login')->with('alert', 'Access denied!');
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }
    public function getLoginUser()
    {
        if (Auth::check()) {
            $username = Auth::user()->username;
            return $username;
        }
    }
    public function index()
    {
        $listAdmin = Admins::all();
        return view('admin/index', compact('listAdmin'));
    }
    public function search(Request $request)
    {
        $keyword = $request->input('data');
        $listAdmin = Admins::where('username', 'like', "%$keyword%")->get();
        return view('admin/results', compact('listAdmin'));
    }
    public function create()
    {
        return view('admin/create');
    }
    public function createHandle(CreateAdminRequest $request)
    {
        $admin = new Admins();
        $admin->username = $request->username;
        $admin->fullname = $request->fullname;
        $admin->email = $request->email;
        $admin->password = Hash::make($request->password);
        $admin->phone_number = $request->phone_number;
        $admin->save();
        return redirect()->route('admin.index')->with('alert', 'Thêm tài khoản admin thành công');
    }
    public function update($id)
    {
        $admin = Admins::find($id);
        return view('admin/update', compact('admin'));
    }
    public function updateHandle(CreateAdminRequest $request, $id)
    {
        $admin = Admins::find($id);
        if (empty($admin)) {
            return redirect()->route('admin.index')->with('alert', 'Tài khoản admin không tồn tại');
        }
        $admin->username = $request->username;
        $admin->fullname = $request->fullname;
        $admin->email = $request->email;
        $admin->password = Hash::make($request->password);
        $admin->phone_number = $request->phone_number;
        $admin->save();

        return redirect()->route('admin.index')->with('alert', 'Cập nhật tài khoản admin thành công');
    }
    public function delete($id)
    {
        $admin = Admins::find($id);
        if ($admin->status_id == 2) {
            return redirect()->route('admin.index')->with('alert', 'Tài khoản admin đã được khóa rồi');
        }
        $admin->status_id = 2;
        $admin->save();
        return redirect()->route('admin.index')->with('alert', 'Khóa tài khoản admin thành công');
    }

    public function ViewPDF()
    {
        $data = Admins::all();
        $pdf = PDF::loadView('admin.pdf',  compact('data'));
        return $pdf->stream('Admin.pdf');
    }
    public function ImportExcel(Request $re)
    {
        // $re->validate([
        //     'import_file' => ['require', 'file'],
        // ]);

        Excel::import(new AdminsImport, $re->file('import_file'));

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

        $filename = "Admins-" . date('d-m-Y') . "." . $files;
        return Excel::download(new AdminsExport, $filename, $format);
    }
}
