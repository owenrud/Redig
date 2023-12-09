<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\email_verification;

class VerificationController extends Controller
{
    public function all()
    {
        $email_verification =email_verification::all();
        return response()->json(['is_success'=>true,
        'data'=>$email_verification,
        'message'=>"Semua data email_verification"
    ],'200');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function show(Request $request)
    {
        $email_verification = email_verification::find($request->id);
        if($email_verification){
            return response()->json(['is_success'=>true,
            'data'=>$email_verification,
            'message'=>'Data email_verification ditemukan'
        ],'200');
        }
        return response()->json(['is_success'=>false,
        'data'=>$email_verification,
        'message'=>'Data email_verification Tidak ditemukan'
    ],'404');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $email_verification =email_verification::Create([
            'ID_user' => $request->ID_user,
            'token'=>$request->token,
            'status'=>$request->status
        ]);
        if($email_verification){
            return response()->json(['is_success'=>true,
            'data'=>$email_verification,
            'message'=>"email_verification Berhasil Di tambahkan"],'200');
        }
        return response()->json(['is_success'=>false,
        'data'=>$email_verification,
        'message'=>"email_verification Gagal Di tambahkan"],'404');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $email_verification = email_verification::find($request->id);
            
        if ($email_verification) {
            // Daftar atribut yang ingin diperbarui
            $atributToUpdate = [
                'ID_paket','ID_user','Payment_id','status'];
            
            // Loop melalui atribut dan periksa apakah ada dalam permintaan
            foreach ($atributToUpdate as $atribut) {
                if ($request->has($atribut)) {
                    $email_verification->$atribut = $request->input($atribut);
                }
            }
        $email_verification->save();

        return response()->json(['is_success'=>true,'data'=>$email_verification,'message'=>'email_verification berhasil di update'],'200');
        }
        return response()->json(['is_success'=>false,'message'=>"email_verification Tidak ada"],'404');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        $email_verification =email_verification::find($id);
        if($email_verification){
            $email_verification->delete();
        return response()->json(['is_success'=>true,'data'=>$email_verification,'message'=>'email_verification berhasil di delete'],'200');
        }
        return response()->json(['is_success'=>false,'message'=>"email_verification Tidak ada"],'404');
    
    }
    
}
