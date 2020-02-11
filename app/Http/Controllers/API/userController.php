<?php

namespace App\Http\Controllers\API;
use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use App\User; 
use App\Otp;
use Illuminate\Support\Facades\Auth; 
use Validator;

class userController extends Controller
{
    public $successStatus = 200;
    /** 
     * Register api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function register(Request $request) 
    { 
        $validator = Validator::make($request->all(), [ 
            'name' => 'required', 
            'email' => 'required|email', 
            'mobile'=>'required',
            'user_type'=>'required' 
            
        ]);
            if($validator->fails()) { 
                        return response()->json(['error'=>$validator->errors()], 401);            
            }
            $input = $request->all(); 
            $input['password'] = bcrypt($input['password']);
            $input['profile_pic']="default.png"; 
            $user = User::create($input);
            $otp_d=$this->generateOtp(); 
            $success['token'] = $user->createToken('MyApp')-> accessToken; 
            $success['user'] =  $user;
            $success['otp']=$otp_d;
            return response()->json(['success'=>$success], $this->successStatus); 
    }

    public function generateOtp(){
        $otp=mt_rand(1000,9999);
        $date=strtotime(date("h:i:sa"))+900;//15*60=900 seconds
        $date=date("h:i:sa",$date);
      
        $data['otp_code']=$otp;
        $data['otp_valid_for'] =$date;
     
        $newotp=Otp::create($data);
        return $newotp;
    }

    public function login(Request $request){

          $validator=Validator::make($request->all(),[
            "mobile"=>"required"

          ]);
          if($validator->fails()){
              return $response()->json(['error'=>$validator->errors()],401);
          }
          $mobile=$request->all()['mobile'];
          $user=User::where(['mobile'=>$mobile,'user_type'=>"1"])->get();
          return response()->json(["user"=>$user],$this->successStatus);

    }
}
