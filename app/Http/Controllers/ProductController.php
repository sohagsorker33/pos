<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
class ProductController extends Controller
{

      public function ProductPage(){

        return view('pages.product.product-page');
        
      } 

     public function ProductCreate(Request $request){

       $user_id=$request->header('id');

       //prepare imgae file path

       $image=$request->file('image');

       $time=time();

       $file_name=$image->getClientOriginalName();

       $image_name="{$user_id}-{$time}-{$file_name}";

       $image_url="uploads/{$image_name}";

       //upload image file path

       $image->move(public_path('uploads'),$image_name);


       return Product::create([

          "name"=>$request->input('name'),

          "price"=>$request->input('price'),

          "unit"=>$request->input('unit'),

          "image"=>$image_url,

          "category_id"=>$request->input('category_id'),
          
          "user_id"=>$user_id

       ]);

     }

     public function ProductById(Request $request){

      $user_id=$request->header('id');

      $product_id=$request->input('id') ;

      return Product::where('user_id','=',$user_id)->where('id','=',$product_id)->first();
      
     }


     public function ProductList(Request $request){
       
        $user_id=$request->header('id');
        
        return Product::where('user_id','=',$user_id)->get();

     }


     public function ProductUpdate(Request $request){

     } 


     public function ProductDelete(Request $request){  
      
          $user_id=$request->header('id');

           $product_id=$request->input('id');

           $filePath=$request->input('file_path');

           File::delete($filePath);

           return Product::where('user_id','=',$user_id)->where('id','=',$product_id)->delete();
      
     }

     

}
