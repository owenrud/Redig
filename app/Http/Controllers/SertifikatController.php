<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\sertifikat;
use App\Models\event;
use App\Models\peserta_event;

use PDF;
use Illuminate\Support\Facades\Response;

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
        
        function handleFileUpload($request, $attribute)
        {
            if ($request->hasFile($attribute)) {
                $file = $request->file($attribute);
        
                // Modify the filename
                $modifiedFilename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
        
                // Store the file with the modified filename
                $path = $file->storeAs('uploads', $modifiedFilename, 'public');
        
                // Return the modified filename to be saved in the model
                return $modifiedFilename;
            }
        
            // If no file is uploaded, return the existing value or null, depending on your logic
            return $request->$attribute;
        }
    
        public function store(Request $request){
            $check_duplicate = sertifikat::where('ID_event',$request->ID_event)->first();
            if(!$check_duplicate){
                $sertifikat =sertifikat::Create([
                    'ID_event' => $request->ID_event,
                    'background' => $this->handleFileUpload($request, 'background'),
                    'logo' => $this->handleFileUpload($request, 'logo'),
                    'ttd' => $this->handleFileUpload($request, 'ttd'),
                    'nama_ketu_panitia' => $request->nama_ketu_panitia,
                    'kota_diterbitkan' => $request->kota_diterbitkan,
                    'tanggal_diterbitkan' => $request->tanggal_diterbitkan,
                ]);
                if($sertifikat){
                    return response()->json(['is_success'=>true,
                    'data'=>$sertifikat,
                    'message'=>"sertifikat Berhasil Di tambahkan"],'200');
                }
                return response()->json(['is_success'=>false,
                'data'=>$sertifikat,
                'message'=>"sertifikat Gagal Di tambahkan"],'404');
            }else{
               // Duplikasi ditemukan, lakukan pembaruan
        $sertifikat = sertifikat::where('ID_event', $request->ID_event)->first();

        if ($sertifikat) {
            $atributToUpdate = [
                'ID_event', 'background', 'logo',
                'ttd', 'nama_ketu_panitia', 'kota_diterbitkan', 'tanggal_diterbitkan'
            ];
    
            foreach ($atributToUpdate as $atribut) {
                if ($request->has($atribut)) {
                    // If the attribute is a file, handle the file upload
                    if ($atribut == 'background' || $atribut == 'logo' || $atribut == 'ttd') {
                        $sertifikat->$atribut = $this->handleFileUpload($request, $atribut);
                    } else {
                        // If it's not a file attribute, update the value directly
                        $sertifikat->$atribut = $request->input($atribut);
                    }
                }
            }

            $sertifikat->save();

            return response()->json(['is_success' => true, 'data' => $sertifikat, 'message' => 'sertifikat berhasil diupdate'], '200');
        }

        return response()->json(['is_success' => false, 'message' => "sertifikat Tidak ada"], '404');
            }
           
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

        public function export(){
            define('DOMPDF_DEBUG', true);
                set_time_limit(120);

                // Default view name and file name
                $viewName = 'pdf_sertif';
                $fileName = 'sertifikat';
        
                // Load the specified view and generate the PDF
                $pdf = PDF::loadView($viewName);
        
                // Get the PDF content as a string
                $pdfContent = $pdf->output();
        
                // Return a response for download
                return Response::make($pdfContent, 200, [
                    'Content-Type' => 'application/pdf',
                    'Content-Disposition' => 'attachment; filename=' . $fileName . '.pdf',
                ]);
            
}
public function test_export(Request $request){
    define('DOMPDF_DEBUG', true);
        set_time_limit(120);

        // Default view name and file name
        $data_peserta = peserta_event::where('ID_event',$request->ID_event)
        ->where('ID_User',$request->ID_user)->get();
        //return $data_peserta->ID_event;
        $data = sertifikat::where("ID_Event",$request->ID_event)->get();
        $event = event::find($request->ID_event);
        //dd($data);
        $viewName = 'pdf_sertif';
        $fileName = 'sertifikat';
        //dd($event);
        // Load the specified view and generate the PDF
        
        $pdf = PDF::loadView($viewName,['data' =>$data,'event'=>$event,'peserta'=>$data_peserta]);

        // Get the PDF content as a string
        $pdfContent = $pdf->output();

        // Return a response for download
        return Response::make($pdfContent, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename=' . $fileName . '.pdf',
        ]);
    
}
}
