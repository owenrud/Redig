<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\paket;
use App\Models\fitur_paket;

class PaketController extends Controller
{
    public function all(){
    $paket =paket::all();
    return response()->json(['is_success'=>true,
                    'data'=>$paket,
                    'message'=>"Semua Data Paket"],'200');

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

    public function store(Request $request){
        $limit = paket::all()->count();
        if($limit <3){
            $paket =paket::Create([
                'nama_paket' => $request->input('nama_paket') ,
                'ID_fitur' => $request->ID_fitur,
                'harga' => $request->harga,
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
        return response()->json(['is_success'=>false,
        'data'=>null,
        'message'=>"Paket Sudah melebihi 3"],'500');
    }

    public function update(Request $request){
            $paket = paket::find($request->ID_paket);
        
            if ($paket) {
                // Daftar atribut yang ingin diperbarui
                $atributToUpdate = ['nama_paket','ID_fitur','harga'];
                
                // Loop melalui atribut dan periksa apakah ada dalam permintaan
                foreach ($atributToUpdate as $atribut) {
                    if ($request->has($atribut)) {
                        $paket->$atribut = $request->input($atribut);
                    }
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

//================FITUR PAKETTTTTTTTTTT==========================
//================FITUR PAKETTTTTTTTTTT==========================
//================FITUR PAKETTTTTTTTTTT==========================
//================FITUR PAKETTTTTTTTTTT==========================
//================FITUR PAKETTTTTTTTTTT==========================
 
    public function all_fitur(){
        $paket = fitur_paket::all();
        return response()->json(['is_success'=>true,
                'data'=>$paket,
                'message'=>"Paket Ditemukan"],'200');
    }
    public function show_fitur(Request $request){
        $paket = fitur_paket::find($request->ID_fitur);
        if($paket){
            return response()->json(['is_success'=>true,
                'data'=>$paket,
                'message'=>"Paket Ditemukan"],'200');
        }
        return response()->json(['is_success'=>false,
        'data'=>$paket,
        'message'=>"Paket Gagal Ditemukan"],'404');
    }

    public function store_fitur(Request $request){
        
        $paket = fitur_paket::Create([
            'scan_count' => $request->scan_count,
            'file_up_count' => $request->file_up_count,
            'guest_count' => $request->guest_count,
            'operator_count' => $request->operator_count,
            'sertif_count' => $request->sertif_count
        ]);
        if($paket){
            return response()->json(['is_success'=>true,
                'data'=>$paket,
                'message'=>"Paket Berhasil Di tambahkan"],'200');
        }
        return response()->json(['is_success'=>false,
        'data'=>$paket,
        'message'=>"Paket Gagal Di tambahkan"],'404');
    }

    public function update_fitur(Request $request){
        $paket = fitur_paket::find($request->ID_fitur);
        
            if ($paket) {
                // Daftar atribut yang ingin diperbarui
                $atributToUpdate = ['scan_count', 'file_up_count', 'guest_count', 'operator_count', 'sertif_count'];
                
                // Loop melalui atribut dan periksa apakah ada dalam permintaan
                foreach ($atributToUpdate as $atribut) {
                    if ($request->has($atribut)) {
                        $paket->$atribut = $request->input($atribut);
                    }
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
    public function delete_fitur($id){
        $paket =fitur_paket::find($id);
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
