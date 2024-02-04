<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Products;
use App\Models\Carts;
use App\Models\CartDetails;
use App\Models\Categories;
use App\Models\Imports;
use App\Models\ImportDetails;
use Illuminate\Http\Request;

class DashBoardController extends Controller
{
    public function index()
    {
        $listSales = Carts::where('status_carts_id', '=', 5)->get();
        $sales = 0;
        $countSales = count($listSales);
        
        $listCategories = [];
        if (!empty($listSales)) {
            foreach ($listSales as $item) {
                $sales = $sales + $item->total_price;
                $listCartDetails = CartDetails::where('carts_id', '=', $item->id)->where('status_id', '=', 1)->get();
                foreach ($listCartDetails as $cartDetail) {
                    $product = Products::find($cartDetail->products_id);
                    
                    if ($product) {
                        $category = Categories::find($product->categories_id);
                       
                        if ($category) {
                            $categoryName = $category->name;
                            if(!isset($listCategories[$categoryName]))
                            {
                                $listCategories[$categoryName] = 0 ;
                            }
                            $listCategories[$categoryName] ++;
                                
                        }
                    }
                }
            }
        }

        $ListImports = Imports::where('status_id', '=', 2)->get();
        $import = 0;
        if (!empty($ListImports)) {
            foreach ($ListImports as $imports) {
                $import = $import + $imports->total_price;
            }
        }
        //profit tong
        $total_profit = $sales - $import;
        //tinh profit theo thang
        $salesByMonth = Carts::where('status_carts_id', '=', 5)
            ->selectRaw('SUM(total_price) as sales, DATE_FORMAT(created_at, "%Y-%m") as month')
            ->groupBy('month')
            ->get();

        $importByMonth = Imports::where('status_id', '=', 2)
            ->selectRaw('SUM(total_price) as import, DATE_FORMAT(created_at, "%Y-%m") as month')
            ->groupBy('month')
            ->get();

        $profitByMonth = [];
        foreach ($salesByMonth as $saleData) {
            $sales_month = $saleData->month;
            $sales = $saleData->sales;
            $imports = 0;
            foreach ($importByMonth as $importData) {
                if ($sales_month === $importData->month) {
                    $imports = $importData->import;
                    break;
                }
            }
            $profit = $sales - $imports;
            $profitByMonth[] = ['month' => $sales_month, 'profit' => $profit];
        }
        /* dd($salesByMonth,$importByMonth,$profitByMonth,$total_profit); */
        $data = [
            'sales' => $sales,
            'order' => $countSales,
            'import' => $import,
            'profit' => $total_profit,
            'category' => $listCategories,
            'salesByMonth' => $salesByMonth->toArray(),
            'importByMonth' => $importByMonth->toArray(),
            'profitByMonth'=>$profitByMonth,
        ];
       /*  dd($data); */

        return view('/dashboard', compact('data'));
    }

    
}
