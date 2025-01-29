<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
class CustomerController extends Controller
{
    public function CustomerPage(){
        return view('pages.customer.customer-page');
    }


  public function CustomerCreate(Request $request){
        $user_id=$request->header('id');
        return Customer::create([
            'name'=>$request->input('name'),
            'email'=>$request->input('email'),
            "phone"=>$request->input('phone'),
            'user_id'=>$user_id,
        ]);
    }


    public function CustomerList(Request $request){
        $user_id=$request->header("id");
        return Customer::where('user_id',$user_id)->get();
    }

    public function CustomerUpdate(Request $request){
        $customer_id=$request->input('id');
        $user_id=$request->header('id');
        return Customer::where('id',$customer_id)->where('user_id',$user_id)->update([
            "name"=>$request->input('name'),
            "email"=>$request->input('email'),
            "phone"=>$request->input('phone')
        ]);
    }

    public function CustomerDelete(Request $request){
        $customer_id=$request->input('id');
        $user_id=$request->header('id');
        return Customer::where('id',$customer_id)->where("user_id", $user_id)->delete();
    }

     public function CustomerById(Request $request){
       $customer_id=$request->input('id');
       $user_id=$request->header('id');
       return Customer::where('id',$customer_id)->where('user_id',$user_id)->first();
     }


}


