<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function Register(Request $request) {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'confir_password' => 'required|same:password'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'suscces' => false,
                'message' => 'Terjadi Kesalahan',
                'data' => $validator->errors()
            ]);
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);

        return response()->json([
            'success' => true,
            'message' => 'Register Berhasil',
            'data' => 'success'
        ]);
    }
    //
}

