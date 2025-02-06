<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Invoice;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\Invoice_Product;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    public function InvoicePage(){

      return view('pages.invoice.invoice-page');

    }

    public function SelesPage(){

        return view('pages.create_seles.seles-page');
    } 

    function InvoiceCreate(Request $request){

        DB::beginTransaction();

        try {

        $user_id=$request->header('id');

        $total=$request->input('total');

        $discount=$request->input('discount');

        $vat=$request->input('vat');

        $payable=$request->input('payable');


        $customer_id=$request->input('customer_id');


        $invoice= Invoice::create([
            'total'=>$total,

            'discount'=>$discount,

            'vat'=>$vat,

            'payable'=>$payable,

            'user_id'=>$user_id,

            'customer_id'=>$customer_id,
        ]);


       $invoiceID=$invoice->id;

       $products= $request->input('products');

       foreach ($products as $Product) {

            Invoice_Product::create([

                'invoice_id' => $invoiceID,

                'user_id'=>$user_id,

                'product_id' => $Product['product_id'],

                'qty' =>  $Product['qty'],

                'seles_price'=>  $Product['seles_price'],
            ]);
        }

       DB::commit();

       return 1;

        }
        catch (Exception $e) {

            DB::rollBack();

            return 0;
        }

    }

     public function InvoiceSelect(Request $request){

        $user_id=$request->header('id');

        return Invoice::where('user_id','=',$user_id)->with('customer')->get();

    }
 

     public function InvoiceDetails(Request $request){
        
       $user_id=$request->header('id');

       $customerDetails=Customer::where('user_id','=',$user_id)->where('id','=',$request->input('customer_id'))->first();
     
       $invoiceTotal=Invoice::where('user_id','=',$user_id)->where('id','=',$request->input('invoice_id'))->first();

       $invoiceProducts=Invoice_Product::where('user_id','=',$user_id)->where('invoice_id','=',$request->input('invoice_id'))->with('Product')->get();

       return array(

        'customer'=>$customerDetails,

        'invoice'=>$invoiceTotal, 

        'invoiceProducts'=>$invoiceProducts,
       );

    }

 
    public function InvoiceDelete(Request $request){
    DB::beginTransaction();
    try{

      $user_id=$request->header('id');
      
      Invoice_Product::where('user_id','=',$user_id)->where('invoice_id','=',$request->input('invoice_id'))->delete();

      Invoice::where('id','=',$request->input('invoice_id'))->delete();
      
      DB::commit();

      return 1;

    }catch(Exception $e){
      
      DB::rollBack();

      return 0;

    }


   }


 



}







