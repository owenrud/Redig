<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\absen;

class AbsenController extends Controller
{
    public function all(){
        $absen =absen::all();
        return response()->json(['is_success'=>true,
        'data'=>$absen,
        'message'=>"Semua data absen"
    ],'200');
    
        }
        
        public function show(Request $request){
            $absen = absen::where('ID_event',$request->ID_event)->get();
            if($absen){
                return response()->json(['is_success'=>true,
                'data'=>$absen,
                'message'=>'Data absen ditemukan'
            ],'200');
            }
            return response()->json(['is_success'=>false,
            'data'=>$absen,
            'message'=>'Data absen Tidak ditemukan'
        ],'404');
        }
    
        public function store(Request $request){
                $absen =absen::Create([
                    'ID_event' => $request->ID_event,
                    'nama' => $request->nama,
                    'mulai' => $request->mulai,
                    'berakhir'=>$request->akhir
                ]);
                if($absen){
                    return response()->json(['is_success'=>true,
                    'data'=>$absen,
                    'message'=>"absen Berhasil Di tambahkan"],'200');
                }
                return response()->json(['is_success'=>false,
                'data'=>$absen,
                'message'=>"absen Gagal Di tambahkan"],'404');
        }
    
        public function update(Request $request){
                $absen = absen::find($request->ID_absen);
            
                if ($absen) {
                    // Daftar atribut yang ingin diperbarui
                    $atributToUpdate = [
                        'ID_event','nama','mulai','akhir'];
                    
                    // Loop melalui atribut dan periksa apakah ada dalam permintaan
                    foreach ($atributToUpdate as $atribut) {
                        if ($request->has($atribut)) {
                            $absen->$atribut = $request->input($atribut);
                        }
                    }
                $absen->save();
        
                return response()->json(['is_success'=>true,'data'=>$absen,'message'=>'absen berhasil di update'],'200');
                }
                return response()->json(['is_success'=>false,'message'=>"absen Tidak ada"],'404');
        
        }
    
        public function delete($id){
            $absen =absen::find($id);
            if($absen){
                $absen->delete();
            return response()->json(['is_success'=>true,'data'=>$absen,'message'=>'absen berhasil di delete'],'200');
            }
            return response()->json(['is_success'=>false,'message'=>"absen Tidak ada"],'404');
        }

}
