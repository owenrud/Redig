<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\provinsi;

class ProvinsiController extends Controller
{
    public function all(){
        $provinsi =provinsi::all();
        return response()->json(['is_success'=>true,
        'data'=>$provinsi,
        'message'=>"Data Provinsi"],'200');
    
        }
        
        public function show(Request $request){
            $provinsi = provinsi::find($request->id);
            if($provinsi){
                return response()->json(['is_success'=>true,
        'data'=>$provinsi,
        'message'=>"Data Provinsi Ditemukan"],'200');
            }
            return response()->json(['is_success'=>false,
        'data'=>$provinsi,
        'message'=>"Data Provinsi Tidak ditemukan"],'404');
        }
    
        public function store(Request $request){
                $provinsi =provinsi::Create([
                    'ID_provinsi' => $request->ID_provinsi,
                    'nama' => $request->nama,
                ]);
                if($provinsi){
                    return response()->json(['is_success'=>true,
        'data'=>$provinsi,
        'message'=>"Data Provinsi Berhasil Ditambah"],'200');
                }
                return response()->json(['is_success'=>false,
                'data'=>$provinsi,
                'message'=>"Data Provinsi Gagal ditambah"],'404');
        }
    
        public function update(Request $request){
                $provinsi = provinsi::find($request->id);
            
                if ($provinsi) {
                    // Daftar atribut yang ingin diperbarui
                    $atributToUpdate = [
                        'ID','nama'];
                
                    // Loop melalui atribut dan periksa apakah ada dalam permintaan
                    foreach ($atributToUpdate as $atribut) {
                        if ($request->has($atribut)) {
                            $provinsi->$atribut = $request->input($atribut);
                        }
                    }
                $provinsi->save();
        
                return response()->json(['is_success'=>true,
            'data'=>$provinsi,
            'message'=>"Data Provinsi berhasil di update"],'200');
                }
                return response()->json(['is_success'=>false,
        'data'=>$provinsi,
        'message'=>"Data Provinsi gagal di update"],'404');
        }
    
        public function delete($id){
            $provinsi =provinsi::find($id);
            $provinsi->delete();
            if($provinsi){
                return response()->json(['is_success'=>true,
        'data'=>$provinsi,
        'message'=>"Data Provinsi berhasil dihapus"],'200');
            }
            return response()->json(['is_success'=>false,
        'data'=>$provinsi,
        'message'=>"Data Provinsi gagal dihapus"],'404');
     }
}
