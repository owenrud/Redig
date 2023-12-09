<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\kabupaten;

class KabupatenController extends Controller
{
    public function all(){
        $kabupaten =kabupaten::all();
        return response()->json(['is_success'=>true,
        'data'=>$kabupaten,
        'message'=>"Data kabupaten"],'200');
    
        }
        
        public function show(Request $request){
            $kabupaten = kabupaten::where('ID_provinsi',$request->id_provinsi)->get();
            if($kabupaten){
                return response()->json(['is_success'=>true,
        'data'=>$kabupaten,
        'message'=>"Data kabupaten Ditemukan"],'200');
            }
            return response()->json(['is_success'=>false,
        'data'=>$kabupaten,
        'message'=>"Data kabupaten Tidak ditemukan"],'404');
        }

        public function show_id(Request $request){
            $kabupaten = kabupaten::find($request->id);
            if($kabupaten){
                return response()->json(['is_success'=>true,
        'data'=>$kabupaten,
        'message'=>"Data kabupaten Ditemukan"],'200');
            }
            return response()->json(['is_success'=>false,
        'data'=>$kabupaten,
        'message'=>"Data kabupaten Tidak ditemukan"],'404');
        }
    
        public function store(Request $request){
                $kabupaten =kabupaten::Create([
                    'ID_kabupaten' => $request->ID_kabupaten,
                    'nama' => $request->nama,
                ]);
                if($kabupaten){
                    return response()->json(['is_success'=>true,
        'data'=>$kabupaten,
        'message'=>"Data kabupaten Berhasil Ditambah"],'200');
                }
                return response()->json(['is_success'=>false,
                'data'=>$kabupaten,
                'message'=>"Data kabupaten Gagal ditambah"],'404');
        }
    
        public function update(Request $request){
                $kabupaten = kabupaten::find($request->id);
            
                if ($kabupaten) {
                    // Daftar atribut yang ingin diperbarui
                    $atributToUpdate = [
                        'ID','nama'];
                
                    // Loop melalui atribut dan periksa apakah ada dalam permintaan
                    foreach ($atributToUpdate as $atribut) {
                        if ($request->has($atribut)) {
                            $kabupaten->$atribut = $request->input($atribut);
                        }
                    }
                $kabupaten->save();
        
                return response()->json(['is_success'=>true,
            'data'=>$kabupaten,
            'message'=>"Data kabupaten berhasil di update"],'200');
                }
                return response()->json(['is_success'=>false,
        'data'=>$kabupaten,
        'message'=>"Data kabupaten gagal di update"],'404');
        }
    
        public function delete($id){
            $kabupaten =kabupaten::find($id);
            $kabupaten->delete();
            if($kabupaten){
                return response()->json(['is_success'=>true,
        'data'=>$kabupaten,
        'message'=>"Data kabupaten berhasil dihapus"],'200');
            }
            return response()->json(['is_success'=>false,
        'data'=>$kabupaten,
        'message'=>"Data kabupaten gagal dihapus"],'404');
     }
}
