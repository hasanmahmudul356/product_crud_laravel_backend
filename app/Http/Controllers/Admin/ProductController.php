<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Supports\Helper;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    use Helper;

    public function __construct()
    {
        $this->model = new Product();
    }

    public function index()
    {
        try {
            $data = $this->model->orderBy('id', 'DESC')->paginate(20);
            return response()->json($this->returnData(2000, $data));
        } catch (\Exception $exception) {
            return response()->json($this->returnData(2000, $exception->getMessage(), 'Something Wrong'));
        }
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        try {
            $input = $request->all();

            $validate = Validator::make($input, $this->model->validationRules());
            if ($validate->fails()) {
                return response()->json($this->returnData(3000, $validate->errors(), 'Validation Failed'));
            }

            $this->model->fill($input)->save();

            return response()->json($this->returnData(2000, $this->model, 'Successfully Inserted'));
        } catch (\Exception $exception) {
            return response()->json($this->returnData(2000, $exception->getMessage(), 'Something Wrong'));
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        try {
            $input = $request->all();

            $validate = Validator::make($input, $this->model->validationRules($request->id));
            if ($validate->fails()) {
                return response()->json($this->returnData(3000, $validate->errors(), 'Validation Failed'));
            }

            $exist = $this->model->where('id', $request->id)->first();
            if ($exist) {
                $exist->fill($input)->save();

                return response()->json($this->returnData(2000, $exist, 'Successfully Updated'));
            }

            return response()->json($this->returnData(5000, null, 'Not updated'));
        } catch (\Exception $exception) {
            return response()->json($this->returnData(2000, $exception->getMessage(), 'Something Wrong'));
        }
    }

    public function destroy($id)
    {
        try {
            $exist = $this->model->where('id', $id)->first();
            if ($exist) {
                $exist->delete();

                return response()->json($this->returnData(2000, $exist, 'Successfully Deleted'));
            }

            return response()->json($this->returnData(5000, null, 'Not Deleted'));
        } catch (\Exception $exception) {
            return response()->json($this->returnData(2000, $exception->getMessage(), 'Something Wrong'));
        }
    }
}
