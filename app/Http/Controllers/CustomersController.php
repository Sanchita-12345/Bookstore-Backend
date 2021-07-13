<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customers;

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
}
