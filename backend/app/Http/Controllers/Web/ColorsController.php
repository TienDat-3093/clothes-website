<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Colors;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Imports\ColorsImport;
use App\EXports\ColorsExport;
use Maatwebsite\Excel\Facades\Excel;

class ColorsController extends Controller
{
    public function index()
    {
        $listColors = Colors::all();
        return view('color/index', compact('listColors'));
    }
    public function create(Request $request)
    {
        $color = new Colors();
        $color->name = $request->name;
        $color->save();
        $listColors = Colors::all();
        return view('color/results', compact('listColors'));
    }
    public function update($id)
    {
        $color = Colors::find($id);
        return response()->json(['data' => $color]);
    }
    public function updateHandle(Request $request, $id)
    {
        $color = Colors::find($id);
        if (!empty($color)) {
            $color->name = $request->name;
            $color->save();
        }
        $listColors = Colors::all();
        return view('color/results', compact('listColors'));
    }
    public function ViewPDF()
    {
        $data = Colors::all();
        $pdf = PDF::loadView('color.pdf',  compact('data'));
        return $pdf->stream('Colors.pdf');
    }
    public function ImportExcel(Request $re)
    {
        // $re->validate([
        //     'import_file' => ['require', 'file'],
        // ]);

        Excel::import(new ColorsImport, $re->file('import_file'));

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

        $filename = "Colorss-" . date('d-m-Y') . "." . $files;
        return Excel::download(new ColorsExport, $filename, $format);
    }
}
