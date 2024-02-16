<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Models\Profile;
use App\Models\paket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function Login_G(){
        $Guser = Socialite::driver('google')->user();
        //dd($user);
        $find = User::where('email',$Guser->email)->get();
        $findG_ID = User::where('google_id',$Guser->id)->get();
         //dd($find);    
        if($find->isEmpty() && $findG_ID->isEmpty()){
         return redirect('/register')->with('Guser',$Guser);
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
    public function index(){
        return view('registrasi');
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
        //dd($req);
        $credentials = $req->only('email','password');
        //dd ($credentials);
        //dd(Auth::attempt($credentials));
        if(Auth::attempt($credentials)){
            $user = Auth::user();
            //dd($user);
            return redirect('/dashboard');
        }else{
            return redirect('/');
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
    

    
    
    public function Register_API(Request $request){
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
                      'no_telp' => $request->no_telp,
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
                  'email_valid'=>$request->verify_email,
                  'google_id' =>null
              ]);
              $id = $user->ID_User;
              //d($user->ID_User);
              $find = Profile::where('ID_User',$id)->get();
               if($find->isEmpty()){
                  $profile = Profile::Create([
                      'ID_User' => $id,
                      'nama_lengkap' => $request->full_name,
                      'no_telp' => $request->no_telp,
                      'Kategori_paket'=> $default_Paket,
                      'alamat' => $request->alamat,
                      'provinsi'=> $request->provinsi,
                      'kota' => $request->kabupaten,
                      'foto' => $request->profile_picture
                  ]);
               }
          }
          if($user !== null && $profile !== null){
            return response()->json([
                'is_success'=> true,
                'data'=>[
                    'user' => $user,
                    'profile' => $profile
                ]
            ],'201');
          }
         return response()->json([
            'is_success' => false,
            'data'=> null,
         ],'500');
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