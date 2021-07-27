<?php

namespace App\Http\Controllers;

use App\Http\Supports\Helper;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    use Helper;

    public function products()
    {
        try {
            $products = Product::orderBy('id', 'DESC')->paginate(20);
            return response()->json($this->returnData(2000, $products));
        } catch (\Exception $exception) {
            return response()->json($this->returnData(2000, $exception->getMessage(), 'Something Wrong'));
        }
    }

    public function categories()
    {
        try {
            $categories = Category::orderBy('id', 'DESC')->paginate(20);
            return response()->json($this->returnData(2000, $categories));
        } catch (\Exception $exception) {
            return response()->json($this->returnData(2000, $exception->getMessage(), 'Something Wrong'));
        }
    }
}
