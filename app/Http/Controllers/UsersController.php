<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    public function adduser(Request $request)
    {
        $request->merge(array('email' => trim($request->email)));
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'password' => 'min:6|required_with:passwordMatch|same:passwordMatch',
            'passwordMatch' => 'min:6',
            'email' => 'required|email|unique:users|max:255',
            'role' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first(), 'code' => 400]);
        }

        $email = $request->input("email");
        $password = $request->input("password");
        $name = $request->input("name");
        $role = $request->input("role");

        $hashPwd = Hash::make($password);

        $data = [
            "email" => $email,
            "role" => $role,
            "name" => $name,
            "password" => $hashPwd,
        ];

        if (User::create($data)) {
            $out = ['success' => true, 'message' => 'sucess', 'code' => 200];
        } else {
            $out = ['success' => false, 'message' => 'error', 'code' => 200];
        }

        return response()->json($out, $out['code']);
    }

    public function getallusers()
    {
        $data = User::all();
        $out = ['success' => true, 'message' => $data, 'code' => 200];
        return response()->json($out, $out['code']);
    }

    public function getuser($id)
    {
        $data = User::find($id);
        $out = ['success' => true, 'message' => $data, 'code' => 200];
        return response()->json($out, $out['code']);
    }

    public function changepassword(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'min:6|required_with:passwordMatch|same:passwordMatch',
            'passwordMatch' => 'min:6',
        ]);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first(), 'code' => 400]);
        }
        $data = User::find($id);
        $data->password = Hash::make($request->password);
        $data->save();
        $out = ['success' => true, 'message' => $data, 'code' => 200];
        return response()->json($out, $out['code']);
    }

    public function deleteuser($id)
    {
        $data = User::find($id);
        $data->delete();
        $out = ['success' => true, 'message' => $data, 'code' => 200];
        return response()->json($out, $out['code']);
    }
}
