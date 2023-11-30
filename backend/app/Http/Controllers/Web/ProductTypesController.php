<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductTypes;
use App\Models\Status;
use NunoMaduro\Collision\Adapters\Phpunit\State;

class ProductTypesController extends Controller
{
    public function Create(){
        $PDT=ProductTypes::all();
        return view('product_types.create',compact('PDT'));
    }

    public function createHandler(Request $re){
        $PDT=new ProductTypes();

        $PDT->name=$re->name;
        $PDT->status_id=1;

        $PDT->save();

        return redirect()->route('product-types.index')->with('alert','Add Product Type successfully');
    }

    public function List(){
        $PDT=ProductTypes::all();
        $STT=Status::all();
        return view('product_types.index',compact('PDT','STT'));
    }

    public function Update($id){
        $PDT=ProductTypes::find($id);
        $STT=Status::all();

        if(empty($PDT)){
            return "Product Type doesn't exist!!!";
        }
        return view('product_types.update',compact('PDT','STT'));
    }

    public function updateHandler(Request $re,$id){
        $PDT=ProductTypes::find($id);

        if(empty($PDT)){
            return "Product Type doesn't exist!!!";
        }

        $PDT->name=$re->name;
        $PDT->status_id=$re->status_id;
        $PDT->save();

        return redirect()->route('product-types.index')->with('alert','Update Product Type successfully');
    }

    public function Delete($id)
    {
        $PDT=ProductTypes::find($id);

        if(empty($PDT)){
            return "Product Type doesn't exist!!!";
        }
        if($PDT->status_id==2){
            return redirect()->route('product-types.index')->with('alert','Product Type already deleted');
        }
        $PDT->status_id=2;
        $PDT->save();

        return redirect()->route('product-types.index')->with('alert','Delete Product Type successfully');
    }
}
