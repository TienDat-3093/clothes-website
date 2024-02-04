<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slideshows;
use App\Models\Status;

class SlideShowController extends Controller
{
    public function index()
    {
        $listSlides = Slideshows::all();
        $status = Status::all();
        if ($listSlides) {
            return view('slideshow/index', compact('listSlides', 'status'));
        }
    }
    public function create(Request $request)
    {
        if ($request->hasFile('images')) {

            $images = $request->file('images');


            $file = new Slideshows();
            $imageName = $images->getClientOriginalName();
            $path = $images->storeAs('product_image', $imageName);
            $file->url = $path;
            $file->save();
        }

        $listSlides = Slideshows::all();
        return view('slideshow/results', compact('listSlides'));
    }
    public function delete($id)
    {


        $slide = Slideshows::find($id);
        if (!empty($slide)) {
            $slide->status_id = 2;
            $slide->save();
            return redirect()->route('slideshow.index')->with('alert', 'Xóa thành công slideshow');
        }
        else{
            return redirect()->route('product.index')->with('alert' ,'Không có slideshow có id {$id}');
        }
    }
}
