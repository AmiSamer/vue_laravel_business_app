<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Yajra\DataTables\Facades\DataTables;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }


     
         //all user list
         public function all_user(){

            $role_id = Auth::user()->role_id;
    
            if($role_id == 1){
                $users = User::select('id','name','email','status')
                ->orderBy('id','DESC')
                ->get();
            }
            return datatables($users)
            ->addColumn('action', function($row){              
                if($row->status == 1){
                    // Active Button
                    $statusButton = "<button class='btn  btn-success activation'  data-id='".$row->id."'><i class='fas fa-toggle-on'></i></button>";
                }else{
                    // Deactive Button
                    $statusButton = "<button class='btn  btn-danger activation'  data-id='".$row->id."'><i class='fas fa-toggle-off'></i></button>";
                }               
                return $statusButton;
                 }) 
           ->make(true);
    
        }


        public function change_status($id){
            $user = User::where('id',$id)->first();

            $status = $user->status;

            if($status == 1){
                $change = User::where('id',$id)->update(['status' => 0]);
            }else{
                $change = User::where('id',$id)->update(['status' => 1]);
            }

            return response($status);
        }






}
