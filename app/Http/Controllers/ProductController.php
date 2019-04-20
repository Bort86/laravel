<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;
use App\Category;

use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    public function check(Request $request){
        
        $alphabetic = "/^[a-z ]*$/i";
        $decimal = "/^\d{1,6}(\.\d{1,2})?$/";
        //$postalcode = "/^[0-9]{5}$/";
        
        $request->validate([
            'name' => "required|unique:products|regex:$alphabetic|min:1|max:50",
            'description' => "nullable|string|max:100",
            'price' => "required|min:1|regex:$decimal",
            'category_id' => "required",
        ]);
        
    }
    
    public function check_update(Request $request){
        
        $alphabetic = "/^[a-z ]*$/i";
        $decimal = "/^\d{1,6}(\.\d{1,2})?$/";
        //$numeric = "/[0-9]*$/";
        //$postalcode = "/^[0-9]{5}$/";
        
        $request->validate([
            'name' => "required|regex:$alphabetic|min:1|max:50",
            'description' => "nullable|string|max:100",
            'price' => "required|min:1|regex:$decimal",
        ]);
        
    }
    
    public function check_find(Request $request){
        $alphabetic = "/^[a-z ]*$/i";
        $request->validate([
            'id' => 'numeric|nullable',
            'name' => "regex:$alphabetic|min:1|max:50|nullable",
        ]);
    }
    
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
        return view('product.create', ['message' => $message, 'categories' => \App\Category::all()]);
    }
    
    
    public function find (Request $request) {
        $this->check_find($request);
        
        try {
            if(isset($request->id)){
                $objProduct = Product::findOrFail($request->id);
                return redirect()->to('/product/edit/' . $request->id);
            } else {
                $objProduct = Product::where("name", "=", $request->name)->get();
                dd($objProduct);
                return redirect()->to('/product/edit/' . $request->id);
            }
 
        } catch (\Exception $ex) {   //se pone contrabarra porque Exception está fuera deñ namespace definido arriba
            $message = "No data found " . $ex->getMessage();
        }
        return view('product.find', ['id'=> $request->id, 'message' => $message]);
    }
    
     public function edit($id){
        try {
            $objProduct = Product::findOrFail($id);
            
            $message=Session::get('message_update');
            
            return view('product.edit', ['objProduct' => $objProduct, 'message' => $message]);
            
            
        } catch (\Exception $ex) {   
            $message = "No data found " . $ex->getMessage();
        }
        
        return redirect()->to('fallback');
        
    }
    
    public function modify(Request $request){
        switch ($request->action) {
            case "update":
                return $this->update($request);
            case "delete":
                return $this->delete($request);                
        }
    }
    
     public function update($request){
        
        $this->check_update($request);
        
        try {
            $objProduct = Product::findOrFail($request->id);
            
            $objProduct->update($request->all());
            
            $message = "Data updated ok";
            
            return redirect()-> back()->with('message_update', $message);
            
        } catch (\Exception $ex) {
            $message = "No data found " . $ex->getMessage();
            
        }
        return view('product.edit', ['objProduct'=> $objProduct, 'message' => $message]);
    }
    
    public function delete($request){
        try {
            $objProduct = Product::findOrFail($request->id);
            
            $objProduct->delete();
            
            $message = "Data deleted ok";
            
            return view('product.find', ['message' => $message]);
            //return redirect()->to(route('catlist'));      // si queremos pasarle el nombre de la ruta en vez del url
            //return redirect()->to('/category/list');        //ojo, nos perdemos el mensaje
            
        } catch (\Exception $ex) {
            $message = "No data deleted " . $ex->getMessage();
            
        }
        return view('product.find', [ 'message' => $message]);
    }
    
}
