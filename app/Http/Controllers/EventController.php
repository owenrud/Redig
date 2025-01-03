<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\event;
use App\Models\kategori_event;
use Illuminate\Support\Carbon;
use App\Models\peserta_event;
use App\Models\provinsi;
use App\Models\kabupaten;
use App\Models\paket;
use App\Models\profile;

class EventController extends Controller
{


    public function all() {
         // Default to 10 items per page
        $events = Event::join('paket','event.ID_paket','paket.ID_paket')
        ->join('kategori_event','ID_kategori','kategori_event.id')
        ->select('ID_event','ID_EO as idEO','nama_event','start','end','public','event.status',
        'nama_paket','kategori_event.nama as nama_kategori')
        ->orderby('status','desc')
        ->paginate(5);
    
        return response()->json([
            'is_success' => true,
            'data' => $events,
            'message' => 'Semua data Event',
        ], 200);
    }

    public function all_mobile() {
        // Check if data is cached
        if (Cache::has('all_mobile_events')) {
            \Log::info('Data is retrieved from cache.');
            $events = Cache::get('all_mobile_events');
        } else {
            \Log::info('Data is retrieved from database.');
            // Retrieve data from database
            $events = Event::join('paket','event.ID_paket','=','paket.ID_paket')
                ->join('profile','event.ID_EO','=','profile.ID_User')
                ->join('kategori_event','ID_kategori','=','kategori_event.id')
                ->join('provinsi','event.ID_provinsi','=','provinsi.ID_provinsi')
                ->join('kabupaten','ID_kabupaten','=','kabupaten.id')
                ->select([
                    'event.ID_event as id',
                    'event.ID_EO',
                    'event.ID_kategori',
                    'event.nama_event',
                    'event.desc_event as deskripsi',
                    'event.start',
                    'event.end',
                    'event.public',
                    'event.status',
                    'paket.nama_paket',
                    'profile.nama_lengkap',
                    'kategori_event.nama as kategori',
                    'provinsi.nama as provinsi',
                    'kabupaten.nama as kabupaten'
                ])
                ->where('event.status', '!=', 0)
                ->where('event.public','!=',0)
                ->paginate(3);
    
            // Cache the data for future use with a 60-minute expiration time (adjust as needed)
            Cache::put('all_mobile_events', $events, 60);
        }
    
        return response()->json([
            'is_success' => true,
            'data' => $events,
            'message' => 'Semua data Event',
        ], 200);
    }
    
    public function all_mobile_test() {
        $events =  Event::with([
                    'paket',
                    'profile',
                    'kategoriEvent',
                    'provinsi',
                    'kabupaten'
                ])
                ->select([
                    'event.ID_event as id',
                    'event.nama_event',
                    'event.desc_event as deskripsi',
                    'event.start',
                    'event.end',
                    'event.public',
                    'event.status'
                ])
                ->get();

    
        return response()->json([
            'is_success' => true,
            'data' => $events,
            'message' => 'Semua data Event',
        ], 200);
   }

 
   public function search(Request $request){
    $searchTerm = $request->input('search');

    $events = Event::join('paket', 'event.ID_paket', '=', 'paket.ID_paket')
        ->join('profile', 'event.ID_EO', '=', 'profile.ID_User')
        ->join('kategori_event', 'event.ID_kategori', '=', 'kategori_event.id')
        ->join('provinsi', 'event.ID_provinsi', '=', 'provinsi.ID_provinsi')
        ->join('kabupaten', 'event.ID_kabupaten', '=', 'kabupaten.id')
        ->select([
            'event.ID_event as id',
            'event.nama_event',
            'event.desc_event as deskripsi',
            'event.start',
            'event.end',
            'event.public',
            'event.status',
            'paket.nama_paket',
            'profile.nama_lengkap',
            'kategori_event.nama as kategori',
            'provinsi.nama as provinsi',
            'kabupaten.nama as kabupaten'
        ])
        ->where('event.status', '!=', 0)
        ->where(function($query) use ($searchTerm) {
            $query->where('event.nama_event', 'LIKE', '%' . $searchTerm . '%')
                  ->orWhere('event.start', 'LIKE', '%' . $searchTerm . '%');
        })
        ->get();
    
    return response()->json([
        'is_success' => true,
        'data' => $events,
        'message' => 'Semua data Event',
    ], 200);  
}

    
   
        
   public function show(Request $request){
    $event = Event::join('paket', 'event.ID_paket', '=', 'paket.ID_paket')
        ->join('kategori_event', 'event.ID_kategori', '=', 'kategori_event.id')
        ->select(
            'event.*', // Select all columns from the event table
            'paket.status as paket_status',
            'paket.nama_paket',
            'paket.sertifCount',
            'paket.GuestCount',
            'paket.ScanCount',
            'paket.OperatorCount',
            'kategori_event.*' // Alias the status column from the paket table
        )
        ->where('ID_Event', $request->ID_event)
        ->get(); // Use first() instead of get() to retrieve a single record

    if($event){
        return response()->json([
            'is_success' => true,
            'data' => $event,
            'message' => 'Data Event ditemukan'
        ], 200);
    }
    
    return response()->json([
        'is_success' => false,
        'data' => null,
        'message' => 'Data Event Tidak ditemukan'
    ], 404);
}

        public function showEO(Request $request){
            $event = event::where('ID_EO',$request->ID_EO)
            ->join('paket','event.ID_paket','=','paket.ID_paket')
            ->join('kategori_event','ID_kategori','=','kategori_event.id')
            ->select([
                'event.ID_event',
                'event.nama_event',
                'event.start',
                'event.end',
                'event.public',
                'paket.nama_paket',
                'kategori_event.nama',
                'event.status',
                
            ])
            ->orderBy('status','desc')->paginate(5);
            if($event){
                return response()->json(['is_success'=>true,
                'data'=>$event,
                'message'=>'Data Event ditemukan'
            ],'200');
            }
            return response()->json(['is_success'=>false,
            'data'=>$event,
            'message'=>'Data Event Tidak ditemukan'
        ],'404');
        }
    
        public function store(Request $request){
                $event =event::Create([
                    'ID_paket' => $request->ID_paket,
                    'ID_EO' => $request->ID_EO,
                    'ID_kategori'=> $request->ID_kategori,
                    'ID_provinsi' => $request->ID_provinsi,
                    'ID_kabupaten'=>$request->ID_kabupaten,
                    'nama_event' => $request->nama_event,
                    'desc_event' => $request->desc_event,
                    'lokasi'=>$request->lokasi,
                    'alamat'=>$request->alamat,
                    'latitude'=>$request->latitude,
                    'longitude'=>$request->longitude,
                    'start' => $request->start,
                    'end' => $request->end,
                    'public' => $request->public,
                    'status' => $request->status,  
                ]);
                if($event){
                    return response()->json(['is_success'=>true,
                    'data'=>$event,
                    'message'=>"Event Berhasil Di tambahkan"],'200');
                }
                return response()->json(['is_success'=>false,
                'data'=>$event,
                'message'=>"Event Gagal Di tambahkan"],'404');
        }
    
        public function update(Request $request){
                $event = event::find($request->ID_event);
            
                if ($event) {
                    // Daftar atribut yang ingin diperbarui
                    $atributToUpdate = [
                        'ID_paket','nama_event','desc_event',
                    'start','end','public','status', 'ID_kategori','lokasi', 'alamat',
                    'ID_provinsi', 'ID_kabupaten', 'latitude', 'longitude', 'banner', 'logo'
                    ,'materi'];
                    
                    // Loop melalui atribut dan periksa apakah ada dalam permintaan
                    foreach ($atributToUpdate as $atribut) {
                        if ($request->has($atribut)) {
                            if ($atribut == 'banner' || $atribut == 'logo' || $atribut =='materi') {
                                $file = $request->file($atribut);
                                //dd($request->file('banner'));
                                // Modify the filename
                                $modifiedFilename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
        
                                // Store the file with the modified filename
                                $path = $file->storeAs('uploads', $modifiedFilename, 'public');
        
        
                                // Save the modified filename to the model
                                $event->$atribut = $modifiedFilename;
                            } else {
                                // If it's not a file, update the attribute directly
                                $event->$atribut = $request->input($atribut);
                            }
                        }
                    }
                $event->save();
        
                return response()->json(['is_success'=>true,'data'=>$event,'message'=>'event berhasil di update'],'200');
                }
                return response()->json(['is_success'=>false,'message'=>"event Tidak ada"],'404');
        
        }
    
        public function delete($id){
            $event =event::find($id);
            if($event){
                $event->delete();
            return response()->json(['is_success'=>true,'data'=>$event,'message'=>'event berhasil di delete'],'200');
            }
            return response()->json(['is_success'=>false,'message'=>"event Tidak ada"],'404');
        }

        public function statsAbsen(Request $request){
            $stats = peserta_event::where('ID_event',$request->ID_event)
            ->whereDate('updated_at', $request->date)
            ->whereTime('updated_at', '>=', $request->time_start)
            ->whereTime('updated_at', '<=', $request->time_end)
            ->get();
            return response()->json(['is_success'=>true,
            'data'=>$stats,
        'message'=>"Data Statistik Peserta berdasarkan Tanggal dan Waktu Absen"],200);
        }


//==================KATEGORIII====================================
public function all_kategori(){
    $event =kategori_event::paginate(3);
    return response()->json(
        ['is_success'=>true,
       'data'=>$event,
       'message'=>'data kategori'],'200');
    }
public function populate_kategori(){
    $event =kategori_event::all();
    return response()->json(
        ['is_success'=>true,
       'data'=>$event,
       'message'=>'data kategori'],'200');
}
    public function show_kategori(Request $request){
        $event = kategori_event::find($request->id);
    if($event){
        return response()->json(
            ['is_success'=>true,
           'data'=>$event,
           'message'=>'data ditemukan'],'200');
    }
    return response()->json(
        ['is_success'=>false,
       'data'=>$event,
       'message'=>'data tidak ditemukan'],'404');
    }

    public function store_kategori(Request $request){
            $event =kategori_event::Create([
                'nama' => $request->nama,
            ]);
        if($event){
            return response()->json(
                ['is_success'=>true,
               'data'=>$event,
               'message'=>'data berhasil ditambahkan'],'200');       
        }
        return response()->json(
            ['is_success'=>false,
           'data'=>$event,
           'message'=>'data gagal ditambahkan'],'500');
           
    }

    public function update_kategori(Request $request){
            $event = kategori_event::find($request->id);
        
            if ($event) {
                // Daftar atribut yang ingin diperbarui
                $atributToUpdate = [
                    'nama'];
                
                // Loop melalui atribut dan periksa apakah ada dalam permintaan
                foreach ($atributToUpdate as $atribut) {
                    if ($request->has($atribut)) {
                        $event->$atribut = $request->input($atribut);
                    }
                }
            $event->save();
    
            return response()->json(
                ['is_success'=>true,
                'data'=>$event,
                'message'=>'data berhasil diupdate'],'200');
            
            }
            return response()->json(
                ['is_success'=>false,
                'data'=>$event,
                'message'=>'data gagal diupdate'],'404');
            
    }

    public function delete_kategori($id){
        $event =kategori_event::find($id);
        $event->delete();
        if($event){
            return response()->json(
                ['is_success'=>true,
               'data'=>$event,
               'message'=>'data detail event berhasil dihapus'],'200');
               
        }
        return response()->json(
            ['is_success'=>false,
           'data'=>$event,
           'message'=>'data tidak bisa dihapus'],'500');
         }

}

