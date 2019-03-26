<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;

class ProductController extends Controller
{
    public function listAll(){
                
        $arrProduct = Product::all();
        
        $message = count($arrProduct) . " products found.";
        
       // dd($arrCat); //equivale al var_dump() y luego mata como die()

        return view('product.list', array('arrProduct'=>$arrProduct, 'message'=> $message));
    }
}
