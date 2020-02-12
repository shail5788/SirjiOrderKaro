<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Category;
class CategoryController extends Controller
{
    //
  public $status=200;
  public function index(){
     
      $category=Category::all();
      if($category){
         $success['response']=true;
         $success['category']=$category;
      }else{
        $success['response']=false;
        $success['category']=null;
        $success['errors']="Internal server error";
        $this->status=500;
      }
      
      return response()->json(['response'=>$success],$this->status);
     
  }
  public function createCategory(Request $request){
      $validator=Validator::make($request->all(),[
         "cate_name"=>"required"
      ]);
     
        if($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
       $input=$request->all();
       $input['slug']=strtolower($input['cate_name']);
       $category=Category::create($input);
       $success['response']=true;
       $success['category']=$category;
       return response()->json(['response'=>$success],200);


  }
  public function make_slug($str){
     
     $str=strtolower(preg_replace(' ', '-', $str)); 
     return $str;
  }

}
