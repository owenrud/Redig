<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Models\Profile;
use App\Models\paket;
use App\Models\provinsi;
use App\Models\kabupaten;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;


class RegisterController extends Controller
{
    public function statsAccEO()
{
    $EOCounts = User::where('Role', 'EO')
        ->selectRaw('YEAR(created_at) as year, COUNT(*) as count')
        ->groupByRaw('YEAR(created_at)')
        ->get();

    return response()->json([
        'success' => true,
        'data' => $EOCounts,
        'message' => 'Visualization of EO account creation statistics'
    ]);
}
    public function Login_G(Request $request){
        $request->session()->forget(['google_login_completed', 'Guser']);
        $Guser = Socialite::driver('google')->user();
        //dd($user);
        $find = User::where('email',$Guser->email)->get();
        $findG_ID = User::where('google_id',$Guser->id)->get();
         //dd($find);    
        if($find->isEmpty() && $findG_ID->isEmpty()){
            //dd($Guser->email);
            $request->session()->put('Guser', $Guser);
           // dd($request->session());
         return redirect('/register');
           // return redirect('/register')->action([UserController::class, 'register'], ['data' => $Guser]);
        }else{
            if($findG_ID){
                $id = $findG_ID[0]['ID_User'];
                
                $user = User::where('ID_User',$id)->first();
                //dd($user);
                Auth::Login($user);
                if(Auth::check()){
                    return redirect('/dashboard');
                }
                
            }
            
        }
    }
    public function index(Request $request){
        $Guser = $request->session()->get('Guser');
        // Forget the 'Guser' session
    $request->session()->forget('Guser');
        return view('registrasi',compact('Guser'));
    }

    /*public function Register(Request $request){
      // dd($request);
        //dd($request->google_id);
        $paket = Paket::where('nama_paket','LIKE','%Gratis%')->first();
        $default_Paket = $paket->ID_paket;
        if(isset($request->google_id)){
            $user = User::Create([
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'Role'=> $request->role,
                'email_valid'=>$request->verify_email,
                'google_id' =>$request->google_id
            ]);

            //dd($user);
            $id = $user->ID_User;
            //dd($id);
            
            $find = Profile::where('ID_User',$id)->get();
             if($find->isEmpty()){
                $profile = Profile::Create([
                    'ID_User' => $id,
                    'nama_lengkap' => $request->full_name,
                    'no_telp' => $request->phone_number,
                    'Kategori_paket'=> $default_Paket,
                    'alamat' => $request->alamat,
                    'provinsi'=> $request->provinsi,
                    'kota' => $request->kabupaten,
                    'foto' => $request->profile_picture
                ]);
             }
           
                }else{
            $user = User::Create([
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'Role'=> $request->role,
                'email_valid'=>0,
                'google_id' =>null
            ]);
            $id = $user->ID_User;
            //d($user->ID_User);
            $find = Profile::where('ID_User',$id)->get();
             if($find->isEmpty()){
                $profile = Profile::Create([
                    'ID_User' => $id,
                    'nama_lengkap' => $request->full_name,
                    'no_telp' => $request->phone_number,
                    'Kategori_paket'=> $default_Paket,
                    'alamat' => $request->alamat,
                    'provinsi'=> $request->provinsi,
                    'kota' => $request->kabupaten,
                    'foto' => $request->profile_picture
                ]);
             }
        }
        return redirect('/')->with('status','Akun Berhasil di Buat');
    
    }*/

    public function Login(Request $req){
        $credentials = $req->only('email','password');
        
        if(Auth::attempt($credentials)){
            $user = Auth::user();
            //dd($user->Role);
            // Check user's role
            if ($user->isAdmin()) {
                return redirect()->route('admin.dashboard'); // Redirect Admin to their dashboard
            } elseif($user->isEO()) {
                return redirect()->route('eo.dashboard'); // Redirect EO to their dashboard
            }else{
                abort(403);
            }
        }else{
            return redirect()->back()->with('error', 'Invalid credentials.'); // Redirect back with error for invalid credentials
        }
    }

    public function Login_API(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
    
        // Assuming your user model is named 'User'
        $user = User::where('email', $email)->first();
    
        if ($user && Hash::check($password, $user->password)) {
            // Password matches, generate your response
            
            
            return response()->json(['is_success' => true, 'user' => $user], 200);
        } else {
            // Invalid credentials
            return response()->json(['is_success' => false, 'error' => 'Unauthorized'], 401);
        }
    }
    
// Function to send OTP to email
private function sendOTPByEmail($email, $otp){
    $data = ['otp' => $otp];
    Mail::send('emails.otp', $data, function($message) use ($email) {
        $message->to($email)->subject('Verify OTP');
    });
}

    
private function generateOTP() {
    do {
        $otp = random_int(1000, 9999); // Generate a 4-digit OTP
    } while(User::where('otp', $otp)->exists()); // Check if the OTP already exists in the database

    return $otp;
}



    public function Register_API(Request $request){
        // dd($request);
          //dd($request->google_id);
          $namaProvinsi = Provinsi::find($request->provinsi);
          $namaKabupaten = kabupaten::find($request->kabupaten);
          //return $namaKabupaten->nama;
          //return strtolower($request->role) !== "admin";
          if (strtolower($request->role) !== "admin" && strtolower($request->role) !== "eo") {
            
            
            $otp = $this->generateOTP();
            // Send OTP to user's email
            $this->sendOTPByEmail($request->email, $otp);
        } else {
            $otp = null; // Set OTP to null if not generated
        } 
          $paket = Paket::where('nama_paket','LIKE','%Gratis%')->first();
          $default_Paket = $paket->ID_paket;
          if(isset($request->google_id)){
              $user = User::Create([
                  'email' => $request->email,
                  'password' => bcrypt($request->password),
                  'Role'=> $request->role,
                  'email_valid'=>$request->verify_email,
                  'google_id' =>$request->google_id,
                  'nama_lengkap' => $request->full_name,
                  'otp'=>$otp,
                      'no_telp' => $request->no_telp,
                      'ID_paket'=> $default_Paket,
                      'alamat' => $request->alamat,
                      'provinsi'=> $namaProvinsi->nama,
                      'kabupaten' => $namaKabupaten->nama,
                      'foto' => $request->profile_picture
              ]);
             
                  }else{
              $user = User::Create([
                  'email' => $request->email,
                  'password' => bcrypt($request->password),
                  'Role'=> $request->role,
                  'email_valid'=>$request->verify_email,
                  'google_id' =>null,
                  'nama_lengkap' => $request->full_name,
                  'otp'=>$otp,
                      'no_telp' => $request->no_telp,
                      'ID_paket'=> $default_Paket,
                      'alamat' => $request->alamat,
                      'provinsi'=> $namaProvinsi->nama,
                      'kabupaten' => $namaKabupaten->nama,
                      'foto' => $request->profile_picture
              ]);
          }
          if($user !== null){
            return response()->json([
                'is_success'=> true,
                'data'=>[
                    'user' => $user,
                ],
                'message' => 'OTP sent to email. Please verify.'
            ],'201');
          }
         return response()->json([
            'is_success' => false,
            'data'=> null,
         ],'500');
      }
      
      public function verifyOTP(Request $request){
        $verify_user = User::where('otp',$request->otp)->first();
        if($verify_user){
            $verify_user->email_valid = 1;
            $verify_user->otp = 0;
            $verify_user->save();

            return response()->json([
                'is_success'=>true,
                'data'=>$verify_user,
                'message'=>"User Berhasil di verifikasi"
            ],200);
        }
        return response()->json([
            'is_success'=>false,
            'message'=>'OTP Salah'
        ],500);
      }
      // UserController
public function getUserByGoogleId(Request $request) {
    $user = User::where('google_id', $request->googleId)->first();

    if ($user) {
        // User found, return user data
        return response()->json(['is_registered' => true, 'user' => $user]);
    } else {
        // User not found, return as not registered
        return response()->json(['is_registered' => false]);
    }
}
}