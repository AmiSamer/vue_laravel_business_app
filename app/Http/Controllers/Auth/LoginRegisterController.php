<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
// use Sanctum;


class LoginRegisterController extends Controller
{
    
    
    public function __construct()
    {
        $this->middleware('guest');
    }


    // public function __construct()
    // {
    //     $this->middleware('guest')->except([
    //         'logout'
    //     ]);
    // }
    
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    


    public function login() {
 
        $credentials = request()->validate([
           'email' => 'required|email',
           'password' => 'required'
        ]);
        if (Auth::attempt($credentials)) {
           $token = auth()->user()->createToken('authToken')->plainTextToken;
           return response()->json([
              'user' => auth()->user(),
              'token' => $token
           ]);
        }else{
            return response()->json([
                'message' => 'credentials are not matched'
             ]);
        }
      
     }



     public function logout() {
        if (auth()->check()) {
           request()->session()->invalidate();
           request()->session()->regenerateToken();
           Auth::logout();
        }
        return response()->noContent();
     }

    
    public function save_user(Request $request)
    {
        
        try{            
            $request->validate([           
                'email' => 'email|max:250|unique:users',
                'password' => 'required|min:3'
            ]);

            $u = User::create([
                    'name' => $request->full_name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password)
                ]);

        $credentials = $request->only('email', 'password');
        Auth::attempt($credentials);
        // $request->session()->regenerate();

        $id = Auth::user()->id;
        $my_email = Auth::user()->email;

        if ($u == true) { 
            return response()->json(['success' => true, 'my_id' => $id, 'my_email' => $my_email, 'error' => false, 'message' => 'User Added Successfully !']);
        } else {
            return response()->json(['success' => false, 'error' => true, 'message' => 'Unsuccessful to add an user !']);
        }

        }catch (\Exception $e) {
                return response()->json(
                    ['success' => false, 'error' => true, 'message' =>  $e->getMessage()]
                );
            }
    }




}
