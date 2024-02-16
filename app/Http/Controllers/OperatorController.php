<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\operator;
use App\Models\User;
use App\Models\profile;

class OperatorController extends Controller
{
    public function all(){
        $operator =operator::all();
        return response()->json(['is_success'=>true,
        'data'=>$operator,
        'message'=>"Semua data operator"
    ],'200');
    
        }

        public function show_event(Request $request){
            $operator = operator::where('ID_event',$request->ID_event)->get();
            if($operator){
                return response()->json(['is_success'=>true,
                'data'=>$operator,
                'message'=>'Data operator ditemukan'
            ],'200');
            }
            return response()->json(['is_success'=>false,
            'data'=>$operator,
            'message'=>'Data operator Tidak ditemukan'
        ],'404');
        }
        
        public function show_user(Request $request){
            $operator = operator::where('ID_User',$request->ID_user)->get();
            if($operator){
                return response()->json(['is_success'=>true,
                'data'=>$operator,
                'message'=>'Data operator ditemukan'
            ],'200');
            }
            return response()->json(['is_success'=>false,
            'data'=>$operator,
            'message'=>'Data operator Tidak ditemukan'
        ],'404');
        }
        public function show_operator(Request $request){
            $operator = operator::find($request->ID_operator);
            if($operator){
                return response()->json(['is_success'=>true,
                'data'=>$operator,
                'message'=>'Data operator ditemukan'
            ],'200');
            }
            return response()->json(['is_success'=>false,
            'data'=>$operator,
            'message'=>'Data operator Tidak ditemukan'
        ],'404');
        }
    
        public function store(Request $request){
            $check = User::where('email',$request->email)->get();
            //dd($check[0]['ID_User']);
            if($check->isEmpty()){
            $user = User::Create([
                'email' => $request->email,
                'password'=> bcrypt($request->password),
                'Role'=> $request->role,
                'email_valid' => 1,
            ]);
            $id = $user->ID_User;
                $operator =operator::Create([
                    'ID_event' => $request->ID_event,
                    'ID_User' => $id
                ]);
                $profile = Profile::Create([
                    'ID_User'=>$id,
                    'nama_lengkap' => $request->nama
                ]);
                if($operator){
                    return response()->json(['is_success'=>true,
                    'data'=>$operator,
                    'message'=>"operator Berhasil Di tambahkan"],'200');
                }
                return response()->json(['is_success'=>false,
                'data'=>$operator,
                'message'=>"operator Gagal Di tambahkan"],'404');
        }else{
            $valid_id = $check[0]['ID_User'];
            $operator =operator::Create([
                'ID_event' => $request->ID_event,
                'ID_User' => $valid_id
            ]);
            if($operator){
                return response()->json(['is_success'=>true,
                'data'=>$operator,
                'message'=>"operator Berhasil Di tambahkan"],'200');
            }
            return response()->json(['is_success'=>false,
            'data'=>$operator,
            'message'=>"operator Gagal Di tambahkan"],'404');
        }
    }
    
        public function update(Request $request){
                $operator = operator::find($request->ID_operator);
            
                if ($operator) {
                    // Daftar atribut yang ingin diperbarui
                    $atributToUpdate = [
                        'ID_event'];
                    
                    // Loop melalui atribut dan periksa apakah ada dalam permintaan
                    foreach ($atributToUpdate as $atribut) {
                        if ($request->has($atribut)) {
                            $operator->$atribut = $request->input($atribut);
                        }
                    }
                $operator->save();
        
                return response()->json(['is_success'=>true,'data'=>$operator,'message'=>'operator berhasil di update'],'200');
                }
                return response()->json(['is_success'=>false,'message'=>"operator Tidak ada"],'404');
        
        }
    
        public function delete($id){
            $operator =operator::find($id);
            if($operator){
                $operator->delete();
            return response()->json(['is_success'=>true,'data'=>$operator,'message'=>'operator berhasil di delete'],'200');
            }
            return response()->json(['is_success'=>false,'message'=>"operator Tidak ada"],'404');
        }

}
