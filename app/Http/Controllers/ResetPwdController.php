<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\resetpwd;

class ResetPwdController extends Controller
{
    public function all()
    {
        $resetpwd =resetpwd::all();
        return response()->json(['is_success'=>true,
        'data'=>$resetpwd,
        'message'=>"Semua data resetpwd"
    ],'200');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function show(Request $request)
    {
        $resetpwd = resetpwd::find($request->id);
        if($resetpwd){
            return response()->json(['is_success'=>true,
            'data'=>$resetpwd,
            'message'=>'Data resetpwd ditemukan'
        ],'200');
        }
        return response()->json(['is_success'=>false,
        'data'=>$resetpwd,
        'message'=>'Data resetpwd Tidak ditemukan'
    ],'404');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $resetpwd =resetpwd::Create([
            'email' => $request->email,
            'token'=>$request->token,
        ]);
        if($resetpwd){
            return response()->json(['is_success'=>true,
            'data'=>$resetpwd,
            'message'=>"resetpwd Berhasil Di tambahkan"],'200');
        }
        return response()->json(['is_success'=>false,
        'data'=>$resetpwd,
        'message'=>"resetpwd Gagal Di tambahkan"],'404');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $resetpwd = resetpwd::find($request->id);
            
        if ($resetpwd) {
            // Daftar atribut yang ingin diperbarui
            $atributToUpdate = [
                'email','token'];
            
            // Loop melalui atribut dan periksa apakah ada dalam permintaan
            foreach ($atributToUpdate as $atribut) {
                if ($request->has($atribut)) {
                    $resetpwd->$atribut = $request->input($atribut);
                }
            }
        $resetpwd->save();

        return response()->json(['is_success'=>true,'data'=>$resetpwd,'message'=>'resetpwd berhasil di update'],'200');
        }
        return response()->json(['is_success'=>false,'message'=>"resetpwd Tidak ada"],'404');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Request $request)
    {
        $resetpwd =resetpwd::find($request->email);
        if($resetpwd){
            $resetpwd->delete();
        return response()->json(['is_success'=>true,'data'=>$resetpwd,'message'=>'resetpwd berhasil di delete'],'200');
        }
        return response()->json(['is_success'=>false,'message'=>"resetpwd Tidak ada"],'404');
    
    }
}
