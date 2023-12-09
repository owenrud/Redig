<?php

namespace App\Http\Controllers;

use App\Models\invoice;
use App\Models\Profile;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function all()
    {
        $invoice =invoice::all();
        return response()->json(['is_success'=>true,
        'data'=>$invoice,
        'message'=>"Semua data invoice"
    ],'200');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function show(Request $request)
    {
        $invoice = invoice::find($request->id);
        if($invoice){
            return response()->json(['is_success'=>true,
            'data'=>$invoice,
            'message'=>'Data invoice ditemukan'
        ],'200');
        }
        return response()->json(['is_success'=>false,
        'data'=>$invoice,
        'message'=>'Data invoice Tidak ditemukan'
    ],'404');
    }

    public function show_user(Request $request)
    {
        $id = $request->input('id');
        $invoice = invoice::where('ID_User',$id)->get();
        if($invoice){
            return response()->json(['is_success'=>true,
            'data'=>$invoice,
            'message'=>'Data invoice ditemukan'
        ],'200');
        }
        return response()->json(['is_success'=>false,
        'data'=>$invoice,
        'message'=>'Data invoice Tidak ditemukan'
    ],'404');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $invoice =invoice::Create([
            'ID_paket' => $request->ID_paket,
            'ID_user' => $request->ID_user,
            'Payment_id' => $request->Payment_id,
            'Type'=> $request->Type,
            'bill_key'=> $request->bill_key,
            'biller_code'=> $request->bill_code,
            'status'=>$request->status,
            'total'=>$request->total
        ]);
       
        if($invoice){
            if($invoice->status == 200){
                $profile = Profile::find($request->ID_user);
                if($profile){
                    $profile->Kategori_paket = $invoice->ID_paket;
                    $profile->save();
                }
            }
            return response()->json(['is_success'=>true,
            'data'=>$invoice,
            'message'=>"invoice Berhasil Di tambahkan"],'200');
        }
        
        return response()->json(['is_success'=>false,
        'data'=>$invoice,
        'message'=>"invoice Gagal Di tambahkan"],'404');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $invoice = invoice::find($request->id);
            
        if ($invoice) {
            // Daftar atribut yang ingin diperbarui
            $atributToUpdate = [
                'ID_paket','ID_user','Payment_id','status'];
            
            // Loop melalui atribut dan periksa apakah ada dalam permintaan
            foreach ($atributToUpdate as $atribut) {
                if ($request->has($atribut)) {
                    $invoice->$atribut = $request->input($atribut);
                }
            }
        $invoice->save();

        return response()->json(['is_success'=>true,'data'=>$invoice,'message'=>'invoice berhasil di update'],'200');
        }
        return response()->json(['is_success'=>false,'message'=>"invoice Tidak ada"],'404');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        $invoice =invoice::find($id);
        if($invoice){
            $invoice->delete();
        return response()->json(['is_success'=>true,'data'=>$invoice,'message'=>'invoice berhasil di delete'],'200');
        }
        return response()->json(['is_success'=>false,'message'=>"invoice Tidak ada"],'404');
    
    }
}
