<?php

namespace App\Http\Controllers;

use App\Models\Masyarakat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class MasyarakatController extends Controller
{

    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Check if the validation fails
        if ($validator->fails()) {
            $data=[
                "status"=>422,
                "message"=>$validator->messages()
            ];
            return response()->json($data, 422);

        }
        else{
            $masyarakat = Masyarakat::find($id);

            $masyarakat->name=$request->name;
            $masyarakat->email=$request->email;
            $masyarakat->password=$request->password;


            $masyarakat->save();

            $data =[
                'status'=>200,
                'message'=>'Data updated succesfully'
            ];
            return response()->json($data, 200);
        }
    }


    public function index()
    {
        $masyarakat = Masyarakat::all();
        $data = [
            'status' =>200,
            'masyarakat' => $masyarakat
        ];
        return response()->json($data, 200);
    }

    public function register(Request $request)
{
    $validation = Validator::make($request->all(), [
        'nik' => 'required|numeric|unique:masyarakats',
        'name' => 'required',
        'email' => 'required|email|unique:masyarakats',
        'password' => 'required',
        'confirm_password' => 'required|same:password',
    ],[
        'nik.unique' => 'NIK Sudah terdaftar di database',
        'email.unique' => 'Email Sudah terdaftar di database',

    ]);

    if ($validation->fails()) {
        return response()->json([
            'success' => false,
            'message' => 'Ada kesalahan',
            'data' => $validation->errors(),
        ], 422);
    }

    $input = $request->all();
    unset($input['confirm_password']);

    $input['password'] = bcrypt($input['password']);
    $masyarakat = Masyarakat::create($input);

    $success['token'] = $masyarakat->createToken('auth_token')->plainTextToken;
    $success['name'] = $masyarakat->name;

    return response()->json([
        'success' => true,
        'message' => 'Sukses register',
        'data' => $success,
    ], 200);
}



    public function login(Request $request)
    {

        $rules = [
            'email' => 'required',
            'password' => 'required|string',
        ];
        $request->validate($rules);

        $masyarakat = Masyarakat::where('email', $request->email)->first();

        if (!$masyarakat || !Hash::check($request->password, $masyarakat->password)) {
            return response()->json([
                'status' => 401,
                'success' => false,
                'message' => 'Gagal login. Email atau password salah.',
            ],401);
        }

        $token = $masyarakat->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => 200,
            'success' => true,
            'message' => 'Sukses login',
            'data' => [
                'token' => $token,
                'name' => $masyarakat->name,
                'email' => $masyarakat->email,
                'nik' => $masyarakat->nik,
            ],
        ],200);
    }

    public function getById($id)
    {
        $masyarakat = Masyarakat::find($id);

        if (!$masyarakat) {
            return response()->json([
                'status' => 404,
                'message' => 'Data not found',
            ], 404);
        }

        $data = [
            'status' => 200,
            'masyarakat' => $masyarakat,
        ];

        return response()->json($data, 200);
    }

    public function destroy($id)
    {
        $masyarakat = Masyarakat::find($id);
        $masyarakat->delete();
        $data = [
            'status'=>200,
            'message'=>'Data deleted successfully'
        ];
        return response()->json($data, 200);
    }

    public function logout(Request $request)
{
    $request->user()->currentAccessToken()->delete();
    return response()->json([
        'success' => true,
        'message' => 'Sukses logout'
    ]);
}
}
