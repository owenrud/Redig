<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\peserta_event;
use Illuminate\Support\Facades\Http;
use App\Models\event;
use App\Models\User;
use App\Models\paket;
use Maatwebsite\Excel\Facades\Excel;
use Midtrans\Config;
use Midtrans;
use Midtrans\Snap;
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
public function createPaymentLink(Request $request,$peserta)
{
    try {
        $response = Http::withBasicAuth(env('MIDTRANS_SERVER_KEY'), '')
            ->post('https://api.sandbox.midtrans.com/v1/payment-links', [
                'transaction_details' => [
                    'order_id' => uniqid(), // Adjust order ID as needed
                    'gross_amount' => $request->input('price') + 500, // Adjust gross amount as needed// Adjust payment link ID as needed
              
                ],
                "customer_required"=> false,
                "expiry"=> [
                    "start_time" => now(),
                "duration"=> 7,
                "unit"=> "days"
                ],
                'item_details'=>[
                    [
                        "name" => "test Premium",
                        "price" => $request->input('price')+500,
                        "quantity" => 1,

                    ]
                    ],
                
                    "customer_details"=>[
                        "first_name"=> $peserta->nama,
                    "notes"=> "Thank you for register premium Event. Please follow the instructions to pay."
                    ],
        ]);

        if ($response->successful()) {
            $responseData = $response->json();
            return $responseData['payment_url'];
        } else {
            throw new \Exception('Failed to create payment link: ' . $response->body());
        }
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}


        public function show_guest(Request $request){
            $peserta_event = peserta_event::where('ID_user',$request->ID_user)
            ->where('ID_event',$request->ID_event)->first();
            //return $peserta_event;
            if($peserta_event){
                return response()->json(['is_success'=>true,
            'data'=>$peserta_event,
            'message'=>'Data peserta event ditemukan'],'200');
            }
            return response()->json(['is_success'=>false,
            'data'=>$peserta_event,
            'message'=>'Data peserta tidak ditemukan'],'404');
        }

        public function me(Request $request){
            $peserta_event = peserta_event::find($request->id);
            //return $peserta_event;
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
            ->where('ID_User',$request->ID_User)->first();
            $check_event = event::where('ID_event',$request->ID_event)
            ->join('paket','event.id_paket','=','paket.id_paket')
            ->select('event.*','paket.id_paket','nama_paket','GuestCount')
            ->get();
            $LimitGuest = $check_event[0]->GuestCount;
            $CountPesertaEvent = peserta_event::where('ID_event',$request->ID_event)->count();
            $isNotLimit = true;
            if($CountPesertaEvent >= $LimitGuest){
                $isNotLimit = false;
                $message = "Kuota Peserta sudah Terpenuhi";
            }
            //return $isNotLimit;
            
            //return $namaPaket ;
           //return $check_user;
            //dd($check_user);
                if(!$check_user && $isNotLimit){
                    $peserta_event =peserta_event::Create([
                        'ID_event' => $request->ID_event,
                        'ID_User' => $request->ID_User,
                        'nama' => $request->nama,
                        'email' => $request->email,
                        'gender' => $request->gender,
                        'type' => $request->type,
                        'instansi' => $request->instansi,
                        'nama_ruang' => $request->nama_ruang,
                        'no_meja' => $request->no_meja,
                        'kode_doorprize' => $kode_doorprize,
                        'status_absen' =>$request->status_absen,
                        'absen_oleh'=>$request->absen_oleh,
                        
                    ]);
                    if($peserta_event){
                        return response()->json(['is_success'=>true,
            'data'=>$peserta_event,
            'message'=>'Data peserta Berhasil Ditambahkan'],'200');
                    }
                    return response()->json(['is_success'=>false,
                    'message'=>'Data peserta Gagal ditambahkann'],500);
                }else{
                    return response()->json(['is_success'=>false,
                    'message'=>'Data peserta Sudah ada atau Kuota Peserta Penuh'],500);
                }
                
        }

        public function storeAsEO(Request $request){
         
            $kode_doorprize = rand(10000000, 99999999);
            $check_user = peserta_event::where('ID_event',$request->ID_event)
            ->where('email',$request->email)->first();
            $check_event = event::where('ID_event',$request->ID_event)
            ->join('paket','event.id_paket','=','paket.id_paket')
            ->select('event.*','paket.id_paket','nama_paket','GuestCount')
            ->get();
            $LimitGuest = $check_event[0]->GuestCount;
            $CountPesertaEvent = peserta_event::where('ID_event',$request->ID_event)->count();
            $isNotLimit = true;
            if($CountPesertaEvent >= $LimitGuest){
                $isNotLimit = false;
                $message = "Kuota Peserta sudah Terpenuhi";
            }
            //return $check_user;
            $paket = Paket::where('nama_paket','LIKE','%Gratis%')->first();
          $default_Paket = $paket->ID_paket;
            $user = User::Create([
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'Role'=> "user",
                'email_valid'=>1,
                'nama_lengkap' => $request->nama,
                    'ID_paket'=> $default_Paket,
            ]);
            //return $namaPaket ;
           //return $check_user;
            //dd($check_user);
                if(!$check_user && $isNotLimit){
                    $peserta_event =peserta_event::Create([
                        'ID_event' => $request->ID_event,
                        'ID_User' => $user->ID_User,
                        'nama' => $request->nama,
                        'email' => $request->email,
                        'gender' => $request->gender,
                        'type' => $request->type,
                        'instansi' => $request->instansi,
                        'nama_ruang' => $request->nama_ruang,
                        'no_meja' => $request->no_meja,
                        'kode_doorprize' => $kode_doorprize,
                        'status_absen' =>0,
                        'absen_oleh'=>$request->absen_oleh,
                        
                    ]);
                    if($peserta_event){
                        return response()->json(['is_success'=>true,
            'data'=>$peserta_event,
            'message'=>'Data peserta Berhasil Ditambahkan'],'200');
                    }
                    return response()->json(['is_success'=>false,
                    'message'=>'Data peserta Gagal ditambahkann'],500);
                }else{
                    return response()->json(['is_success'=>false,
                    'message'=>'Data peserta Sudah ada atau Kuota Peserta Penuh'],500);
                }
                
        }

        public function search(Request $request){
            $peserta_event = peserta_event::where('nama','LIKE','%'.$request->input('search').'%')
            ->get();
            return response()->json(['is_success'=>true,
            'data'=>$peserta_event,'message'=>'Data Pencarian Peserta'],200);
        }
    
        public function update(Request $request){
                $peserta_event = peserta_event::find($request->id);
                $check_event = event::where('ID_event',$peserta_event->ID_event)
            ->join('paket','event.id_paket','=','paket.id_paket')
            ->select('event.*','paket.id_paket','nama_paket','GuestCount')
            ->get();
            $namaPaket =strtolower ($check_event[0]->nama_paket);

            if($namaPaket != "gratis"){
                $payment_url = $this->createPaymentLink($request,$peserta_event);
                $payment_status =  0;
            }
            else {
                $payment_url = null;
                $payment_status = null;
            }
                if ($peserta_event) {
                    // Daftar atribut yang ingin diperbarui
                    $atributToUpdate = [
                        'ID_event','nama','email','gender',
                    'type','instansi','nama_ruang','no_meja','status_absen',
                'absen_oleh','payment_status'];
                
                    // Loop melalui atribut dan periksa apakah ada dalam permintaan
                    foreach ($atributToUpdate as $atribut) {
                        if ($request->has($atribut)) {
                            $peserta_event->$atribut = $request->input($atribut);
                        }
                    }
                $peserta_event->payment_url = $payment_url;
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

