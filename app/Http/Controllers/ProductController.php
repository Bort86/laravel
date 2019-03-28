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
    
    public function create(Request $request) {
        
        $this-> check($request);
        
        try {
            //método 1: coge todos los campos del formulario
            Product::create($request->all());
            
            $message = "Product created succesfully";
           
        } catch (\Exception $e) {
            $message = "No product created - " . $e->getMessage();
        }
        return view('product.create', ['message' => $message]);
    }
    
        public function check(Request $request){
        
        $alphabetic = "/^[a-z ]*$/i";
        $numeric = "/^[0-9]+(\.[0-9]{1,2})?$/";
        //$postalcode = "/^[0-9]{5}$/";
        
        $request->validate([
            'name' => "required|regex:$alphabetic|min:1|max:50",
            'description' => "nullable|string|max:100",
            'price' => "required|min:1|regex:$numeric",
        ]);
        
    }
    
}
