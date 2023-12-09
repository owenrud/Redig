<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\sertifikat;

class SertifikatController extends Controller
{
    public function all(){
        $sertifikat =sertifikat::all();
        return response()->json(['is_success'=>true,
        'data'=>$sertifikat,
        'message'=>"Semua data sertifikat"
    ],'200');
    
        }
        
        public function show(Request $request){
            $sertifikat = sertifikat::find($request->id);
            if($sertifikat){
                return response()->json(['is_success'=>true,
                'data'=>$sertifikat,
                'message'=>'Data sertifikat ditemukan'
            ],'200');
            }
            return response()->json(['is_success'=>false,
            'data'=>$sertifikat,
            'message'=>'Data sertifikat Tidak ditemukan'
        ],'404');
        }
    
        public function store(Request $request){
                $sertifikat =sertifikat::Create([
                    'ID_event' => $request->ID_event,
                    'background' => $request->background,
                    'logo' => $request->logo,
                    'ttd' => $request->ttd,
                    'nama_ketu_panitia' => $request->nama_ketu_panitia,
                    'kota_diterbitkan' => $request->kota_diterbitkan,
                    'tanggal_diterbitkan' => $request->tanggal_diterbitkan
                ]);
                if($sertifikat){
                    return response()->json(['is_success'=>true,
                    'data'=>$sertifikat,
                    'message'=>"sertifikat Berhasil Di tambahkan"],'200');
                }
                return response()->json(['is_success'=>false,
                'data'=>$sertifikat,
                'message'=>"sertifikat Gagal Di tambahkan"],'404');
        }
    
        public function update(Request $request){
                $sertifikat = sertifikat::find($request->id);
            
                if ($sertifikat) {
                    // Daftar atribut yang ingin diperbarui
                    $atributToUpdate = [
                        'ID_event','background','logo',
                    'ttd','nama_ketu_panitia','kota_diterbitkan','tanggal_diterbitkan'];
                    
                    // Loop melalui atribut dan periksa apakah ada dalam permintaan
                    foreach ($atributToUpdate as $atribut) {
                        if ($request->has($atribut)) {
                            $sertifikat->$atribut = $request->input($atribut);
                        }
                    }
                $sertifikat->save();
        
                return response()->json(['is_success'=>true,'data'=>$sertifikat,'message'=>'sertifikat berhasil di update'],'200');
                }
                return response()->json(['is_success'=>false,'message'=>"sertifikat Tidak ada"],'404');
        
        }
    
        public function delete($id){
            $sertifikat =sertifikat::find($id);
            if($sertifikat){
                $sertifikat->delete();
            return response()->json(['is_success'=>true,'data'=>$sertifikat,'message'=>'sertifikat berhasil di delete'],'200');
            }
            return response()->json(['is_success'=>false,'message'=>"sertifikat Tidak ada"],'404');
        }

}
