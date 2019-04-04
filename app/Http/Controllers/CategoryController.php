<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;

use Illuminate\Support\Facades\Session;

class CategoryController extends Controller {

    public function check_create(Request $request){
        
        $alphabetic = "/^[a-z ]*$/i";
        //$numeric = "/[0-9]*$/";
        //$postalcode = "/^[0-9]{5}$/";
        
        $request->validate([
            'name' => "required|unique:categories|regex:$alphabetic|min:1|max:50", // unique:categories valida que sea unico
            'description' => "nullable|string|max:100",
        ]);
        
    }
    public function check_update(Request $request){
        
        $alphabetic = "/^[a-z ]*$/i";
        //$numeric = "/[0-9]*$/";
        //$postalcode = "/^[0-9]{5}$/";
        
        $request->validate([
            'name' => "required|regex:$alphabetic|min:1|max:50",
            'description' => "nullable|string|max:100",
        ]);
        
    }
    
    public function check_find(Request $request){
        $request->validate([
            'id' => 'required|numeric',
        ]);
    }
    
    public function listAll() {

        $arrCat = Category::all();

        $message = count($arrCat) . " categories found.";

        // dd($arrCat); //equivale al var_dump() y luego mata como die()
        // $arrCat = Category::where("id", ">", "3")->get();
        //$arrCat = Category::where("id", ">", "3")->orderBy('name')->take(2)->get();
        // $arrCat = Category::take(5)->get();
        //   $arrCat = Category::where("name", "like", "%$name%")->get();

        return view('category.list', array('arrCategory' => $arrCat, 'message' => $message));
    }

    public function create(Request $request) {
        
        $this-> check_create($request);
        
        try {
            //método 1: coge todos los campos del formulario
            Category::create($request->all());
            
            $message = trans('messages.create_ok');
            //método 2: cogemos los campos que queramos
//        $cat= new Category();
//        $cat->name = $request->name;
//        $cat->description = $request->description;
//        $cat->save();
            //una vez lo hemos creado, para saber qué id tiene lo podemos recuperar así
            // lo hacemos así porque por la bbdd, el id es autoincremental
            //$idNew = $cat->id;
        } catch (\Exception $e) {
            if ($e->getCode()==23000){
                
                $message = "Name already exists, please put another one";
            }
            
        }
        return view('category.create', ['message' => $message]); // tmb puede ser array('message' => $message)
    }
    
    public function find (Request $request) {
        $this->check_find($request);
        
        try {
            $objCat = Category::findOrFail($request->id);
            
            //vamos a edit
            return redirect()->to('/category/edit/' . $request->id);
            
        } catch (\Exception $ex) {   //se pone contrabarra porque Exception está fuera deñ namespace definido arriba
            $message = "No data found " . $ex->getMessage();
        }
        return view('category.find', ['id'=> $request->id, 'message' => $message]);
    }
    
    public function edit($id){
        try {
            $objCat = Category::findOrFail($id);
            
            $message=Session::get('message_update');
            
            return view('category.edit', ['objCategory' => $objCat, 'message' => $message]);
            
            
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
            $objCat = Category::findOrFail($request->id);
            
            $objCat->update($request->all());
            
            $message = "Data updated ok";
            
            return redirect()-> back()->with('message_update', $message);
            
        } catch (\Exception $ex) {
            $message = "No data found " . $ex->getMessage();
            
        }
        return view('category.edit', ['objCategory'=> $objCat, 'message' => $message]);
    }
    
    public function delete($request){
        try {
            $objCat = Category::findOrFail($request->id);
            
            $objCat->delete();
            
            $message = "Data deleted ok";
            
            return view('category.find', ['message' => $message]);
            //return redirect()->to(route('catlist'));      // si queremos pasarle el nombre de la ruta en vez del url
            //return redirect()->to('/category/list');        //ojo, nos perdemos el mensaje
            
        } catch (\Exception $ex) {
            $message = "No data deleted " . $ex->getMessage();
            
        }
        return view('category.find', [ 'message' => $message]);
    }

}
