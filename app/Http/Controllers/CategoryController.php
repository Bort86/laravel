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

        return view('category.list', array('arrCategory'=>$arrCat, 'message'=> $message));
    }
}
