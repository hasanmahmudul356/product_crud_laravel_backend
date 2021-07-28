<?php

namespace App\Http\Controllers;


use App\Http\Supports\Helper;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class GeneralController extends Controller
{
    use Helper;

    public function imageUpload(Request $request)
    {
        $input = $request->all();
        $validate = Validator::make($input, [
            'image' => 'required|file|mimes:jpg,jpeg,png,bmp,tiff',
        ]);

        if ($validate->fails()) {
            return response()->json($this->returnData(5000, $validate->errors(), 'Image Format Validation failed, accept type (jpg,jpeg,png,bmp,tiff)'));
        }

        try {
            $filePath = Storage::disk('public')->put('/images', $input['image']);
            $new_name = basename($filePath);

            $retData = [
                'path' => $new_name,
                'image_url' => route('image_view', ['w'=>200,'img'=>$new_name])
            ];

            return response($this->returnData(2000, $retData, 'Validation Failed'));

        } catch (\Exception $exception) {
            return response()->json($this->returnData(5000, $validate->errors(), 'Something went wrong, image not uploaded'));
        }
    }

    public function index(Request $request)
    {
        try {
            $data = [];
            $input = $request->all();
            if (in_array('category', $input)) {
                $data['category'] = Category::all();
            }

            return response()->json($this->returnData(2000, $data), 200);
        } catch (\Exception $exception) {
            return response()->json($this->returnData(2000, [], 'Something Wrong'));
        }
    }
}
