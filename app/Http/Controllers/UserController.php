<?php

namespace App\Http\Controllers;

use App\UsersModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function loginController(Request $request)
    {
        $username = $request->username;
        $password = $request->password;
        try {
            $cek = UsersModel::where([
                "username" => $username
            ]);
            if ($cek->count() > 0) {
                $dataLogin = $cek->first();
                if (Hash::check($password, $dataLogin->password)) {
                    return $this->handleSukses();
                } else {
                    return $this->handleGagalJson();
                }
            } else {
                return $this->handleGagalJson();
            }
        } catch (\Throwable $th) {
            dd($th);
            return $this->handleGagalJson();
        }
    }

    public function handleGagalJson()
    {
        $data   = [
            'status' => 'gagal',
        ];
        return response()->json($data, 200);
    }

    public function handleSukses($responseData = '')
    {
        $data   = [
            'status' => 'sukses',
            'data' => $responseData
        ];
        return response()->json($data, 200);
    }

}
