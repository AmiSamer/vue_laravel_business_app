<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\User;
use Auth;
use Yajra\DataTables\Facades\DataTables;
use DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class SaleController extends Controller
{
    // store new sale 
    public function save_sale(Request $request){
    
        $receipt_image = $request->file('image');
        if($receipt_image == null){

        $sale_data['user_id'] = Auth::user()->id;
        $sale_data['role_id'] = Auth::user()->role_id;
        $sale_data['selling_date'] = $request->selling_date;
        $sale_data['product_name'] = $request->product;
        $sale_data['product_price'] = $request->price;
        $sale_data['quantity'] = $request->quantity;
        $sale_data['total_selling_price'] = $request->total;

        }else{

        $receipt_image_file_name = date('Ymd') . time() . '.' . $receipt_image->getClientOriginalExtension();
        $directory = 'public/frontend/sale_receipt/';
        $receipt = 'sale_receipt/' . $receipt_image_file_name;
        $receipt_image->move($directory, $receipt_image_file_name);       
        
        $sale_data['user_id'] = Auth::user()->id;
        $sale_data['role_id'] = Auth::user()->role_id;
        $sale_data['selling_date'] = $request->selling_date;
        $sale_data['product_name'] = $request->product;
        $sale_data['product_price'] = $request->price;
        $sale_data['quantity'] = $request->quantity;
        $sale_data['total_selling_price'] = $request->total;
        $sale_data['receipt_image'] = $receipt;
        }
        $sale = Sale::create($sale_data);
        
    }


    //index all sales
    public function show_all_sale(){

        $user_id = Auth::user()->id;
        $role_id = Auth::user()->role_id;

        if($role_id == 1){
            $sales = Sale::select('id','product_name')         
            ->selectRaw('DATE_FORMAT(selling_date, "%d-%m-%Y") as date')
            ->orderBy('id','DESC');
        }else{
            $sales = Sale::select('id','product_name')      
            ->selectRaw('DATE_FORMAT(selling_date, "%d-%m-%Y") as date')
            ->where('user_id',$user_id)
            ->orderBy('id','DESC');
        }

        return datatables($sales)
        ->addColumn('action', function($row){
            // Update Button
            $updateButton = "<button class='btn  btn-success updateUser'  data-id='".$row->id."'><i class='fas fa-eye'></i></button>";
            // Delete Button
            $deleteButton = "<button class='btn  btn-danger deleteUser' data-id='".$row->id."'><i class='fas fa-trash'></i></button>";
            return $updateButton." ".$deleteButton;
             }) 
             ->make(true);

    }

 
    //show specific sale
    public function show_single_sale($id){

        $sale = Sale::where('id',$id)->first();
        return response()->json([
            'sale' => $sale
        ],200);
    }

    //date wise sale report
    public function date_wise_report(Request $request){
       $start_date = $request->start_date;
       $end_date = $request->end_date;

       $sales = Sale::select('id','product_name')
                        ->selectRaw('DATE_FORMAT(selling_date, "%d-%m-%Y") as date')
                        ->whereBetween('selling_date', [$start_date, $end_date])
                        ->orderBy('id','DESC')
                        ->get();

    return datatables($sales)
    ->addColumn('action', function($row){
        // Update Button
        $updateButton = "<button class='btn  btn-success updateUser' data-id='".$row->id."'><i class='fas fa-eye'></i></button>";
        // Delete Button
        $deleteButton = "<button class='btn  btn-danger deleteUser' data-id='".$row->id."'><i class='fas fa-trash'></i></button>";
        return $updateButton." ".$deleteButton;
   }) 
         ->make(true);
                   
    }



   //update sale
   public function update_sale(Request $request){

    $sale_id = $request->sale_id;


    $pic = Sale::select('receipt_image')->where('id','=',$sale_id)->first();

    $getPicFromDb = $pic->receipt_image;

    $new_receipt_image = $request->file('image');

    if(!empty($new_receipt_image)){

        if(!empty($getPicFromDb)){
            unlink('public/frontend/' . $getPicFromDb);
        }
        
        $receiptNewImageFileName = date('Ymd') . time() . '.' . $new_receipt_image->getClientOriginalExtension();
        $directory = 'public/frontend/sale_receipt/';
        $receiptNewImageToSaveInDB = 'sale_receipt/' . $receiptNewImageFileName;
        $new_receipt_image->move($directory, $receiptNewImageFileName);

        $sale_data['user_id'] = Auth::user()->id;
        $sale_data['role_id'] = Auth::user()->role_id;
        $sale_data['selling_date'] = $request->selling_date;
        $sale_data['product_name'] = $request->product;
        $sale_data['product_price'] = $request->price;
        $sale_data['quantity'] = $request->quantity;
        $sale_data['total_selling_price'] = $request->total;
        $sale_data['receipt_image'] = $receiptNewImageToSaveInDB;

    }else{

        $sale_data['user_id'] = Auth::user()->id;
        $sale_data['role_id'] = Auth::user()->role_id;
        $sale_data['selling_date'] = $request->selling_date;
        $sale_data['product_name'] = $request->product;
        $sale_data['product_price'] = $request->price;
        $sale_data['quantity'] = $request->quantity;
        $sale_data['total_selling_price'] = $request->total;

    }

        $sale = Sale::where('id',$sale_id)->update($sale_data);
    
        if($sale == true){
            return response('update is successful');
        }

   }


    //delete sale 
     public function delete_sale($id){
        $sale = Sale::findOrFail($id);
        $sale->delete();
        if($sale == true){
            return response('delete is successful');
           }
        }


    //user profile update
    public function profile_update(Request $request){
  
        $user_id = $request->user_id;
        $user_current_input_password = $request->current_password;

        $user_info = User::select('password')->where('id','=',$user_id)->first();
        $user_password_from_db = $user_info->password;

        $checking = Hash::check($user_current_input_password, $user_password_from_db);

        if($checking == false){
            return response()->json([
                'message' => 'Current password did not match',
                'flag' => 0
            ]);
        }else{

        try{
            $user_data['name'] = $request->name;
            $user_data['email'] = $request->email;
            $user_data['password'] = Hash::make($request->new_password);
            $user = User::where('id',$user_id)->update($user_data);

            return response()->json(['success' => true, 'error' => false, 'message' =>  'Profile update done']);

        }catch(\Exception){      
            return response()->json(['success' => false, 'error' => true, 'message' =>  'This email is already taken']);
        }   
        }     
    }



     //today's total sales
     public function total_today(){

        $user_id = Auth::user()->id;
        $today = Carbon::now()->format('Y-m-d');
        $today_standard = Carbon::now()->format('d F Y');

        $total = Sale::where('user_id',$user_id) 
                      ->where('selling_date',$today)
                      ->sum('total_selling_price');     

        return response()->json([
            'today' => $today_standard,
            'total' => $total
        ]);
     }

     //total yearly sales
     public function total_year(){

        $current_year = Carbon::now()->format('Y');
        $user_id = Auth::user()->id;

        $january_sale = Sale::where('user_id',$user_id)
                             ->whereMonth('selling_date', '01')
                             ->whereYear('selling_date', $current_year)
                             ->sum('total_selling_price');

        $february_sale = Sale::where('user_id',$user_id)
                             ->whereMonth('selling_date', '02')
                             ->whereYear('selling_date', $current_year)
                             ->sum('total_selling_price');

        $march_sale = Sale::where('user_id',$user_id)
                             ->whereMonth('selling_date', '03')
                             ->whereYear('selling_date', $current_year)
                             ->sum('total_selling_price');

        $april_sale = Sale::where('user_id',$user_id)
                             ->whereMonth('selling_date', '04')
                             ->whereYear('selling_date', $current_year)
                             ->sum('total_selling_price');

        $may_sale = Sale::where('user_id',$user_id)
                             ->whereMonth('selling_date', '05')
                             ->whereYear('selling_date', $current_year)
                             ->sum('total_selling_price');

        $june_sale = Sale::where('user_id',$user_id)
                             ->whereMonth('selling_date', '06')
                             ->whereYear('selling_date', $current_year)
                             ->sum('total_selling_price');

        $july_sale = Sale::where('user_id',$user_id)
                             ->whereMonth('selling_date', '07')
                             ->whereYear('selling_date', $current_year)
                             ->sum('total_selling_price');

        $august_sale = Sale::where('user_id',$user_id)
                             ->whereMonth('selling_date', '08')
                             ->whereYear('selling_date', $current_year)
                             ->sum('total_selling_price');

        $september_sale = Sale::where('user_id',$user_id)
                             ->whereMonth('selling_date', '09')
                             ->whereYear('selling_date', $current_year)
                             ->sum('total_selling_price');

        $october_sale = Sale::where('user_id',$user_id)
                             ->whereMonth('selling_date', '10')
                             ->whereYear('selling_date', $current_year)
                             ->sum('total_selling_price');

        $november_sale = Sale::where('user_id',$user_id)
                             ->whereMonth('selling_date', '11')
                             ->whereYear('selling_date', $current_year)
                             ->sum('total_selling_price');

        $december_sale = Sale::where('user_id',$user_id)
                             ->whereMonth('selling_date', '12')
                             ->whereYear('selling_date', $current_year)
                             ->sum('total_selling_price');



        return response()->json([
            
            'current_year' => $current_year,
            
            'january_sale' => $january_sale,
            'february_sale' => $february_sale,
            'march_sale' => $march_sale,
            'april_sale' => $april_sale,
            'may_sale' => $may_sale,
            'june_sale' => $june_sale,
            'july_sale' => $july_sale,
            'august_sale' => $august_sale,
            'september_sale' => $september_sale,
            'october_sale' => $october_sale,
            'november_sale' => $november_sale,
            'december_sale' => $december_sale,
        ]);
     }



     //today sale list
     public function today_all_sale(){

        $user_id = Auth::user()->id;
        $role_id = Auth::user()->role_id;
        $today = Carbon::now()->format('Y-m-d');

        if($role_id == 1){
            $sales = Sale::select('id','product_name','product_price','quantity','total_selling_price')       
            ->where('selling_date',$today)
            ->orderBy('id','DESC');
        }else{
            $sales = Sale::select('id','product_name','product_price','quantity','total_selling_price')
            ->where('user_id',$user_id)
            ->where('selling_date',$today)
            ->orderBy('id','DESC');
        }
        return datatables($sales)->make(true);

    }


}
