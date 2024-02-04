<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Sizes;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Imports\SizesImport;
use App\EXports\SizesExport;
use Maatwebsite\Excel\Facades\Excel;

class SizesController extends Controller
{
    public function index()
    {
        $listSizes = Sizes::all();
        return view('size/index', compact('listSizes'));
    }
    public function create(Request $request)
    {
        $size = new Sizes();
        $size->name = $request->name;
        $size->save();
        $listSizes = Sizes::all();
        return view('size/results', compact('listSizes'));
    }
    public function update($id)
    {
        $size = Sizes::find($id);
        return response()->json(['data' => $size]);
    }
    public function updateHandle(Request $request, $id)
    {
        $size = Sizes::find($id);
        if (!empty($size)) {
            $size->name = $request->name;
            $size->save();
        }
        $listSizes = Sizes::all();
        return view('size/results', compact('listSizes'));
    }
    public function ViewPDF()
    {
        $data = Sizes::all();
        $pdf = PDF::loadView('size.pdf',  compact('data'));
        return $pdf->stream('Sizes.pdf');
    }
    public function ImportExcel(Request $re)
    {
        // $re->validate([
        //     'import_file' => ['require', 'file'],
        // ]);

        Excel::import(new SizesImport, $re->file('import_file'));

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

        $filename = "Sizes-" . date('d-m-Y') . "." . $files;
        return Excel::download(new SizesExport, $filename, $format);
    }
}
