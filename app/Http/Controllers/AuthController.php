<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function generateRandomString($length = 80)
    {
        $karakkter = '012345678dssd9abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $panjang_karakter = strlen($karakkter);
        $str = '';
        for ($i = 0; $i < $length; $i++) {
            $str .= $karakkter[rand(0, $panjang_karakter - 1)];
        }
        return $str;
    }

    public function login(Request $request)
    {
        $request->merge(array('email' => trim($request->email)));
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:6',
            'email' => 'required|email|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()]);
        }

        $email = $request->input("email");
        $password = $request->input("password");

        $user = User::where("email", $email)->first();

        if (!$user) {
            $out = ['success' => true, 'message' => 'user tidak ditemukan', 'code' => 400];
            return response()->json($out);
        }

        if (Hash::check($password, $user->password)) {
            $newtoken = $this->generateRandomString();

            $user->update([
                'token' => $newtoken,
            ]);

            $out = ['success' => true, 'message' => 'login success', 'email' => $user->email,
                'role' => $user->role, 'id' => $user->id, 'token' => $newtoken, 'name' => $user->name, 'code' => 200];

        } else {
            $out = ['success' => false, 'message' => 'password salah', 'code' => 200];
        }

        return response()->json($out, $out['code']);
    }
}
