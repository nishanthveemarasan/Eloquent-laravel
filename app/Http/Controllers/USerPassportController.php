<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class USerPassportController extends Controller
{
    //
    public function register(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'email|required',
            'password' => 'required',
        ]);
        if ($validation->fails()) {
            return response()->json($validation->errors(), 202);
        }
        $allData = $request->all();
        $allData['password'] = bcrypt($allData['password']);

        $user = USer::create($allData);
        $resArr = [];
        $resArr['token'] = $user->createToken('api-application')->accessToken;
        $resArr['name'] = $user->name;
        return response()->json($resArr, 200);
    }

    public function login(Request $request)
    {
        $email = $request['email'];
        $password = $request['password'];
        if (Auth::attempt([
            'email' => $email,
            'password' => $password
        ])) {
            $user = Auth::user();
            $resArr['token'] = $user->createToken('api-application')->accessToken;
            $resArr['name'] = $user->name;
            return response()->json($resArr, 200);
        } else {
            return response()->json(['error' => "unAuthorised Access"], 203);
        }
    }
}
