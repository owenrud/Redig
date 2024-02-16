<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\peserta_event;
use Maatwebsite\Excel\Facades\Excel;

use Maatwebsite\Excel\Exceptions\LaravelExcelException;
use App\Models\detail_peserta;
use App\Exports\PesertaExport;

class PesertaController extends Controller
{
    public function all(){
        $peserta_event =peserta_event::all();
        return response()->json(['is_success'=>true,
        'data'=>$peserta_event,
        'message'=>'Data peserta'],'200');
    
        }
        
        public function show(Request $request){
            $peserta_event = peserta_event::where('ID_event',$request->ID_event)->get();
            if($peserta_event){
                return response()->json(['is_success'=>true,
            'data'=>$peserta_event,
            'message'=>'Data peserta event ditemukan'],'200');
            }
            return response()->json(['is_success'=>false,
            'data'=>$peserta_event,
            'message'=>'Data peserta tidak ditemukan'],'404');
        }
          
        public function user(Request $request){
            $user_event = peserta_event::where('ID_User',$request->ID_user)->get();
            if($user_event){
                return response()->json(['is_success'=>true,
            'data'=>$user_event,
            'message'=>'Data peserta event ditemukan'],'200');
            }
            return response()->json(['is_success'=>false,
            'data'=>$user_event,
            'message'=>'Data peserta tidak ditemukan'],'404');
        }

        public function export_excel(Request $request)
{
  
        $peserta_event = peserta_event::where('ID_event', $request->ID_event)->get();
       // return $peserta_event;
        if ($peserta_event->count() > 0) {
            return Excel::download(new PesertaExport($request->ID_event), 'peserta_event.xlsx');
        }

        return response()->json([
            'is_success' => false,
            'data' => $peserta_event,
            'message' => 'Data peserta tidak ditemukan'
        ], 404);
    
    
}


        public function show_guest(Request $request){
            $peserta_event = peserta_event::find($request->id);
            if($peserta_event){
                return response()->json(['is_success'=>true,
            'data'=>$peserta_event,
            'message'=>'Data peserta event ditemukan'],'200');
            }
            return response()->json(['is_success'=>false,
            'data'=>$peserta_event,
            'message'=>'Data peserta tidak ditemukan'],'404');
        }
    
    
        public function store(Request $request){
         
            $kode_doorprize = rand(10000000, 99999999);
            $check_user = peserta_event::where('ID_event',$request->ID_event)
            ->where('ID_User',$request->ID_user)->first();
           //return $check_user;
            //dd($check_user);
                if(!$check_user){
                    $peserta_event =peserta_event::Create([
                        'ID_event' => $request->ID_event,
                        'ID_User' => $request->ID_user,
                        'nama' => $request->nama,
                        'email' => $request->email,
                        'gender' => $request->gender,
                        'type' => $request->type,
                        'instansi' => $request->instansi,
                        'nama_ruang' => $request->nama_ruang,
                        'no_meja' => $request->no_meja,
                        'kode_doorprize' => $kode_doorprize,
                        'status_absen' =>$request->status_absen,
                        'absen_oleh'=>$request->absen_oleh
                        
                    ]);
                    if($peserta_event){
                        return response()->json(['is_success'=>true,
            'data'=>$peserta_event,
            'message'=>'Data peserta Berhasil Ditambahkan'],'200');
                    }
                    return response()->json(['is_success'=>false,
                    'message'=>'Data peserta Gagal ditambahkann'],'404');
                }else{
                    return response()->json(['is_success'=>false,
                    'message'=>'Data peserta Sudah ada'],'500');
                }
                
        }
    
        public function update(Request $request){
                $peserta_event = peserta_event::find($request->id);
            
                if ($peserta_event) {
                    // Daftar atribut yang ingin diperbarui
                    $atributToUpdate = [
                        'ID_event','nama','email','gender',
                    'type','instansi','nama_ruang','no_meja','status_absen',
                'absen_oleh'];
                
                    // Loop melalui atribut dan periksa apakah ada dalam permintaan
                    foreach ($atributToUpdate as $atribut) {
                        if ($request->has($atribut)) {
                            $peserta_event->$atribut = $request->input($atribut);
                        }
                    }
                $peserta_event->save();
        
                return response()->json(['is_success'=>true,
                'data'=>$peserta_event,
                'message'=>'Data peserta Berhasil di Update'],'200');
                }
                return response()->json(['is_success'=>false,
                'data'=>$peserta_event,
                'message'=>'Data peserta Gagal Di Update'],'404');
        
        }
    
        public function delete($id){
            $peserta_event =peserta_event::where('ID_Peserta',$id);
            $peserta_event->delete();
            if($peserta_event){
                return response()->json(['is_success'=>true,
        'data'=>$peserta_event,
        'message'=>'Data peserta berhasil dihapus'],'200');
            }
            return response()->json(['is_success'=>false,
        'data'=>$peserta_event,
        'message'=>'Data peserta gagal dihapus'],'404');
        }

}
