<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\profile;
use App\Models\user;
use App\Models\provinsi;
use App\Models\kabupaten;
use App\Models\paket;

class ProfileController extends Controller
{
    public function all(){
        $profile =user::all();
        return response()->json(['is_success'=>true,
                    'data'=>$profile,
                    'message'=>"Data profile"],'200');
    
        }
        
        public function show(Request $request){
            $profile = user::find($request->id);
            if($profile){
                return response()->json(['is_success'=>true,
                    'data'=>$profile,
                    'message'=>"Profile Ditemukan"],'200');
            }
            return response()->json(['is_success'=>false,
            'data'=>$profile,
            'message'=>"Profile Tidak Ditemukan"],'404');
        }

        public function user(Request $request){
            $profile = user::find($request->id);
            if($profile){
                return response()->json(['is_success'=>true,
                    'data'=>$profile,
                    'message'=>"User Ditemukan"],'200');
            }
            return response()->json(['is_success'=>false,
            'data'=>$profile,
            'message'=>"Profile Tidak Ditemukan"],'404');
        }
    
        public function store(Request $request){
                $profile =profile::Create([
                    'ID_User' => $request->ID_User,
                    'Kategori_paket' => $request->Kategori_paket,
                    'nama_lengkap' => $request->nama_lengkap,
                    'no_telp' => $request->no_telp,
                    'alamat' => $request->alamat,
                    'provinsi' => $request->provinsi,
                    'kota' => $request->kota,
                    'foto' => $request->foto
                    
                ]);
           if($profile){
            return response()->json(['is_success'=>true,
                    'data'=>$profile,
                    'message'=>"Profile Berhasil Di tambahkan"],'200');
           }
           return response()->json(['is_success'=>false,
                    'data'=>$event,
                    'message'=>"Profile Gagal Di tambahkan"],'404');
        }
    
        public function update(Request $request){
                $profile = profile::where('ID_User',$request->id)->first();
            
                if ($profile) {
                    // Daftar atribut yang ingin diperbarui
                    $atributToUpdate = [
                        'ID_User','Kategori_paket','nama_lengkap',
                    'no_telp','alamat','provinsi','kota','foto'];
                
                    // Loop melalui atribut dan periksa apakah ada dalam permintaan
                    foreach ($atributToUpdate as $atribut) {
                        if ($request->has($atribut)) {
                            $profile->$atribut = $request->input($atribut);
                        }
                    }
                $profile->save();
        
                return response()->json(['is_success'=>true,
                    'data'=>$profile,
                    'message'=>"Profile Berhasil Di Update"],'200');
                }
                return response()->json(['is_success'=>false,
                    'data'=>$profile,
                    'message'=>"Profile Gagal Di Update"],'404');
        
        }
    
        public function delete($id){
            $profile =profile::where('ID_User',$id);
            $profile->delete();
            if($profile){
                return response()->json(['is_success'=>true,
                    'data'=>$profile,
                    'message'=>"Profile Berhasil Dihapus"],'200');
            }
            return response()->json(['is_success'=>false,
                    'data'=>$profile,
                    'message'=>"Profile Berhasil Di tambahkan"],'404');
        }
        public function delete_user($id){
            $profile =user::where('ID_User',$id);
            $profile->delete();
            if($profile){
                return response()->json(['is_success'=>true,
                    'data'=>$profile,
                    'message'=>"Profile Berhasil Dihapus"],'200');
            }
            return response()->json(['is_success'=>false,
                    'data'=>$profile,
                    'message'=>"Profile Berhasil Di tambahkan"],'404');
        }

        public function profile_EO(){
            $EO_prof = user::join('paket','users.ID_paket','=','paket.ID_paket')
            ->where('Role','EO')
            ->select([
                    'ID_User',
                    'nama_lengkap',
                    'email',
                    'provinsi',
                    'kabupaten',
                    'paket.nama_paket'
                ])
                ->orderBy('ID_User', 'asc')
             ->paginate(3);
            return response()->json([
                'is_success'=>true,
                'data'=>$EO_prof,
            'message'=>'Data berhasil ditemukan'],'200');
        }
}
