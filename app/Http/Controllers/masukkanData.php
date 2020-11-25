<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class masukkanData extends Controller
{
    public function getPostingan()
    {
        $data = DB::table('Postingan')->select(['id','judul','image'])->get();
        return $this->handleSukses($data);
    }


    public function getDetailPostingan($id)
    {
        try {
            $data = DB::table('Postingan')->where([
                'id'=>$id
            ])->first();
            $dataKomen = DB::table('Komentar')->where([
                'id_post' => $id
            ])->get();
            $dataRespon =[
                'postingan' => $data,
                'komentar'  => $dataKomen
            ];
            return $this->handleSukses($dataRespon);
        } catch (\Throwable $th) {
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
