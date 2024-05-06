<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\paket;
use App\Models\fitur_paket;

class PaketController extends Controller
{
    public function all(){
    $paket =paket::paginate(5);
    return response()->json(['is_success'=>true,
                    'data'=>$paket,
                    'message'=>"Semua Data Paket"],'200');

    }
    public function allForEO(){
        $paket =paket::all();
        return response()->json(['is_success'=>true,
                        'data'=>$paket,
                        'message'=>"Semua Data Paket"],'200');
    
        }

    public function all_active(){
        $paket =paket::all()->where('status','1');
        return response()->json(['is_success'=>true,
                        'data'=>$paket,
                        'message'=>"Semua Data Paket"],'200');
    
        }
    

    public function store(Request $request){
        
        $count_paket = paket::where('status', '1')
             ->whereRaw('LOWER(nama_paket) != ?', ['gratis'])
             ->count();
             //return $count_paket;
             if ($count_paket >= 3) {
                $status = 0; // Set status to 0 if count_paket is 3 or more
            } else {
                $status = $request->status; // Otherwise, use the provided status
            }
            $paket =paket::Create([
                'nama_paket' => $request->input('nama_paket') ,
                'harga' => $request->harga,
                'ScanCount' => $request->ScanCount,
                'FileUpCount'=> $request->FileUpCount,
                'GuestCount' => $request->GuestCount,
                'OperatorCount'=>$request->OperatorCount,
                'SertifCount'=>$request->SertifCount,
                'status'=>$status,
                
            ]);
            if($paket){
                return response()->json(['is_success'=>true,
                    'data'=>$paket,
                    'message'=>"Paket Berhasil Di tambahkan"],'200');
            }
            return response()->json(['is_success'=>false,
            'data'=>$paket,
            'message'=>"Paket Gagal Di tambahkan"],'500');


    }
    public function show(Request $request){
        $paket = paket::find($request->ID_paket);
        if($paket){
            return response()->json(['is_success'=>true,
                    'data'=>$paket,
                    'message'=>"Paket Ditemukan"],'200');
        }
        return response()->json(['is_success'=>false,
                    'data'=>$event,
                    'message'=>"Paket Tidak Ditemukan"],'404');
    }

    public function update(Request $request){
            $paket = paket::find($request->ID_paket);
            if ($paket) {
                // Daftar atribut yang ingin diperbarui
                $atributToUpdate = ['nama_paket','ID_fitur','harga','ScanCount',
                'FileUpCount',
                'GuestCount',
                'OperatorCount',
                'SertifCount',
                'status'];
                
                // Loop melalui atribut dan periksa apakah ada dalam permintaan
                foreach ($atributToUpdate as $atribut) {
                    if ($request->has($atribut)) {
                        $paket->$atribut = $request->input($atribut);
                    }
                }
                $count_paket = paket::where('status', '1')->where('nama_paket', '!=', 'gratis')->count();
        if ($count_paket == 3) {
            $paket->status = 0; // Force status to 0 if count equals 3
        }
            $paket->save();
            return response()->json(['is_success'=>true,
                    'data'=>$paket,
                    'message'=>"Paket Berhasil Di update"],'200');
            }
            return response()->json(['is_success'=>false,
                    'data'=>$paket,
                    'message'=>"Paket Gagal Di Update"],'404'); 
    }

    public function delete($id){
        $paket =paket::find($id);
        $paket->delete();
        if($paket){
            return response()->json(['is_success'=>true,
                    'data'=>$paket,
                    'message'=>"Paket Berhasil Dihapus"],'200');
        }
        return response()->json(['is_success'=>false,
                    'data'=>$paket,
                    'message'=>"Paket Gagal dihapus"],'404');
    }



}
