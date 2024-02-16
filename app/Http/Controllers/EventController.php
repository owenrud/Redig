<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\event;
use App\Models\kategori_event;

use App\Models\detail_event;
use App\Models\provinsi;
use App\Models\kabupaten;
use App\Models\paket;
use App\Models\profile;

class EventController extends Controller
{
    public function all(Request $request) {
        $perPage = $request->input('perPage', 5); // Default to 10 items per page
        $events = Event::paginate($perPage);
    
        return response()->json([
            'is_success' => true,
            'data' => $events,
            'message' => 'Semua data Event',
        ], 200);
    }

    public function all_mobile() {
         // Default to 10 items per page
        $events = Event::all();
    
        return response()->json([
            'is_success' => true,
            'data' => $events,
            'message' => 'Semua data Event',
        ], 200);
    }
    public function all_mobile_test() {
        // Default to 10 items per page
       $events = Event::join('detail_event','event.ID_event','=','detail_event.ID_event')
       ->join('paket','event.ID_paket','=','paket.ID_paket')
       ->join('profile','event.ID_EO','=','profile.ID_User')
       ->join('kategori_event','detail_event.ID_kategori','=','kategori_event.id')
       ->join('provinsi','detail_event.ID_provinsi','=','provinsi.ID_provinsi')
       ->join('kabupaten','detail_event.ID_kabupaten','=','kabupaten.id')
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
       ->get();
        
       return response()->json([
           'is_success' => true,
           'data' => $events,
           'message' => 'Semua data Event',
       ], 200);
   }
   public function search(Request $request){
    $events = Event::where('nama_event','LIKE','%'.$request->input('search').'%')
    ->join('detail_event','event.ID_event','=','detail_event.ID_event')
       ->join('paket','event.ID_paket','=','paket.ID_paket')
       ->join('profile','event.ID_EO','=','profile.ID_User')
       ->join('kategori_event','detail_event.ID_kategori','=','kategori_event.id')
       ->join('provinsi','detail_event.ID_provinsi','=','provinsi.ID_provinsi')
       ->join('kabupaten','detail_event.ID_kabupaten','=','kabupaten.id')
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
       ->get();
       return response()->json([
        'is_success' => true,
        'data' => $events,
        'message' => 'Semua data Event',
    ], 200);
   }
    
   
        
        public function show(Request $request){
            $event = event::find($request->ID_event);
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
        public function showEO(Request $request){
            $event = event::where('ID_EO',$request->ID_EO)->join('detail_event','event.ID_event','=','detail_event.ID_event')
            ->join('paket','event.ID_paket','=','paket.ID_paket')
            ->join('kategori_event','detail_event.ID_kategori','=','kategori_event.id')
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
            ->paginate(5);
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
                    'nama_event' => $request->nama_event,
                    'desc_event' => $request->desc_event,
                    'start' => $request->start,
                    'end' => $request->end,
                    'public' => $request->public,
                    'status' => $request->status
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
                    'start','end','public','status'];
                    
                    // Loop melalui atribut dan periksa apakah ada dalam permintaan
                    foreach ($atributToUpdate as $atribut) {
                        if ($request->has($atribut)) {
                            $event->$atribut = $request->input($atribut);
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


//=====================DDDDETAILLL EVENTTTT================================


        public function all_detail(){
            $event =detail_event::all();
            return response()->json(
                ['is_success'=>true,
                'data'=>$event,
                'message'=>'data detail event'],'200');
            
        
            }
            
            public function show_detail(Request $request){
                $event = detail_event::find($request->ID_event);
                if($event){
                    return response()->json(
                        ['is_success'=>true,
                       'data'=>$event,
                       'message'=>'data detail event'],'200');
                       
                }
                return response()->json(
                    ['is_success'=>false,
                    'data'=>$event,
                    'message'=>'data tidak ditemukan'],'404');
                
            }
        
            public function store_detail(Request $request){
                    $event =detail_event::Create([
                        'ID_event' => $request->ID_event,
                        'ID_kategori' => $request->ID_kategori,
                        'alamat' => $request->alamat,
                        'ID_provinsi' => $request->ID_provinsi,
                        'ID_kabupaten' => $request->ID_kabupaten,
                        'lat' => $request->latitude,
                        'long' => $request->longitude,
                        'banner' => $request->banner,
                        'file' => $request->file
                    ]);
                    if($event){
                        return response()->json(
                            ['is_success'=>true,
                           'data'=>$event,
                           'message'=>'data detail event berhasil ditambahkan'],'200');       
                    }
                    return response()->json(
                        ['is_success'=>false,
                       'data'=>$event,
                       'message'=>'data detail event gagal ditambahkan'],'500');
                       
                    
            }
        
            public function update_detail(Request $request){
                    $event = detail_event::find($request->ID_event);
                    try {
                    if ($event) {
                        // Daftar atribut yang ingin diperbarui
                        $atributToUpdate = [
                            'ID_event', 'ID_kategori', 'alamat',
                            'ID_provinsi', 'ID_kabupaten', 'lat', 'long', 'banner', 'logo'
                            ,'materi'
                        ];
            
                        // Loop melalui atribut dan periksa apakah ada dalam permintaan
                        foreach ($atributToUpdate as $atribut) {
                            if ($request->has($atribut)) {
                                // If the attribute is a file, handle the file upload
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
            
                    return response()->json(
                        ['is_success'=>true,
                        'data'=>$event,
                        'message'=>'data berhasil diupdate'],'200');
                    
                    }
                    return response()->json(
                        ['is_success'=>false,
                        'data'=>$event,
                        'message'=>'data gagal diupdate'],'404');
                    
            }catch (\Exception $e) {
                // Log the exception for further investigation
                
        }
    }
        
            public function delete_detail($id){
                $event =detail_event::find($id);
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
                   'message'=>'data tidak ditemukan'],'404');
                 
            }

//==================KATEGORIII====================================
public function all_kategori(){
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

