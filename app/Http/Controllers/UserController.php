<?php

namespace App\Http\Controllers;

use App\Http\Supports\Helper;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    use Helper;

    public function login(Request $request)
    {
        try {
            $input = $request->all();

            $fieldType = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';
            $credentials = [
                $fieldType => $input['email'],
                'password' => $input['password']
            ];

            if (!$token = auth('api')->attempt($credentials)) {
                return response()->json($this->returnData(4001, null, 'Email or password incorrect'));
            }

            return response()->json($this->returnData(2000, $this->respondWithToken($token)));
        } catch (\Exception $exception) {
            return response()->json($this->returnData(2000, $exception->getMessage(), 'Something Wrong'));
        }
    }

    public function registration(Request $request)
    {
        try {
            $input = $request->all();
            $user = new User();

            $validate = Validator::make($input, $user->validationRules());
            if ($validate->fails()) {
                return response()->json($this->returnData(3000, $validate->errors(), 'Validation Failed'));
            }

            $user->fill($input)->save();

            return response()->json($this->returnData(2000, $user, 'Successfully Inserted'));
        } catch (\Exception $exception) {
            return response()->json($this->returnData(2000, $exception->getMessage(), 'Something Wrong'));
        }
    }

    public function details()
    {
        return response()->json($this->returnData(2000, auth()->user()));
    }

    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    protected function respondWithToken($token)
    {
        return [
            'access_token' => $token,
            'user' => auth('api')->user(),
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ];
    }

}
