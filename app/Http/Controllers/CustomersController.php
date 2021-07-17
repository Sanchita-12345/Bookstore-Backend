<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customers;
use App\Models\Orders;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\Books;
use App\Models\Books as ModelsBooks;
use Illuminate\Support\Facades\Auth;
use App\Notifications\orderSuccessfullNotification;
use Illuminate\Support\Integer;

class CustomersController extends Controller
{
    public function customerRegistration(Request $request){
        $customer =new Customers();
        $customer->name=$request->input('name');
        $customer->phonenumber=$request->input('phonenumber');
        $customer->pincode=$request->input('pincode');
        $customer->locality=$request->input('locality');
        $customer->city=$request->input('city');
        $customer->address=$request->input('address');
        $customer->landmark=$request->input('landmark');
        $customer->type=$request->input('type');
        $customer->user_id = auth()->id();
        $customer->save();
    }

    public function orderSuccessfull(Request $request){
        $cust=new Customers();
        $cust->user_id = auth()->id();
        $cust_id=Customers::where('user_id',$cust->user_id)->value('user_id');
        $user_email=User::where('id',$cust_id)->value('email');
        $order = User::where('email', $user_email)->first();
        $ord = Orders::create(        
          [
              'orderNumber' => $order->orderNumber=mt_rand(1000000000, 9999999999),
              'customer_id'=>$order->id,
              'order_date'=>$order->order_date=Carbon::now(),
          ]
        );
        if($order && $ord){
            $order->notify(new orderSuccessfullNotification($ord->orderNumber));
        }
        return response()->json($ord->orderNumber);
    }
}
