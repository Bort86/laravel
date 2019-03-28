<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;

class CategoryController extends Controller
{
    public function listAll(){
                
        $arrCat = Category::all();
        
        $message = count($arrCat) . " categories found.";
        
       // dd($arrCat); //equivale al var_dump() y luego mata como die()
        
       // $arrCat = Category::where("id", ">", "3")->get();
        
        //$arrCat = Category::where("id", ">", "3")->orderBy('name')->take(2)->get();
        
       // $arrCat = Category::take(5)->get();
        
     //   $arrCat = Category::where("name", "like", "%$name%")->get();

        return view('category.list', array('arrCategory'=>$arrCat, 'message'=> $message));
    }
}
