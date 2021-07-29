<?php

namespace App\Http\Controllers;

use App\Http\Supports\Helper;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    use Helper;

    public function products(Request $request)
    {
        try {
            $products = Product::where(function ($query) use ($request){
                if ($request->category_id){
                    $query->where('category_id', $request->category_id);
                }
            })->orderBy('id', 'DESC')->paginate(20);
            return response()->json($this->returnData(2000, $products));
        } catch (\Exception $exception) {
            return response()->json($this->returnData(2000, $exception->getMessage(), 'Something Wrong'));
        }
    }
    public function productDetails($id)
    {
        try {
            $data = Product::where('id', $id)->first()->toArray();
            $data['latest']  = Product::orderBy('id', 'DESC')->take(4)->get();
            return response()->json($this->returnData(2000, $data));
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

    public function imagePreview(Request $request){
        $input = $request->input();
        $filename = isset($input['img']) && $input['img'] != '' ? storage_path('app/public/images/' . $input['img']) : 'http://www.wellesleysocietyofartists.org/wp-content/uploads/2015/11/image-not-found.jpg';

        if (isset($input['img']) && $input['img'] != '') {
            $extArr = explode('.', $input['img']);
            $ext = $extArr[count($extArr) - 1];
        } else {
            $ext = 'jpeg';
        }
        header('Content-Type: image/' . $ext);
        list($width, $height) = getimagesize($filename);
        $newwidth = isset($input['w']) && $input['w'] > 0 ? $input['w'] : 200;
        $newheight = $newwidth;

        $thumb = imagecreatetruecolor($newwidth, $newheight);
        if ($ext == 'jpeg' || $ext == 'jpg' || $ext == 'JPEG' || $ext == 'JPG') {
            $source = imagecreatefromjpeg($filename);
        } else if ($ext == 'png' || $ext == 'PNG') {
            $source = imagecreatefrompng($filename);
        } else if ($ext == 'gif' || $ext == 'GIF') {
            $source = imagecreatefromgif($filename);
        }
        imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
        imagejpeg($thumb);
    }
}
