<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    public function CategoryPage(){
        return  view('pages.category.category-page');
    }


    public function CreateCategory(Request $request){
        $user_id=$request->header('id');
        return Categorie::create([
            'name'=>$request->input('name'),
            'user_id'=>$user_id
        ]);

    }


    public function CategoryList(Request $request){
         $user_id=$request->header('id');
        return Categorie::where('user_id',$user_id)->get();
       
    }

   public function DeleteCategory(Request $request){
      $category_id=$request->input('id');
       $user_id=$request->header('id');
       return Categorie::where('id',$category_id)->where('user_id','=',value: $user_id)->delete();  
        
   }
  public function UpdateCategory(Request $request){
      $category_id=$request->input('id');
      $user_id=$request->header('id');
    return Categorie::where('id','=',$category_id)->where('user_id','=',$user_id)->update([
        'name'=>$request->input('name')
    ]);
   
  }

  
  function CategoryByID(Request $request){
    $category_id=$request->input('id');
    $user_id=$request->header('id');
    return Categorie::where('id',$category_id)->where('user_id',$user_id)->first();
}




}









