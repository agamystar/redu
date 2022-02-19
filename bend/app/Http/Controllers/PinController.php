<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class PinController extends Controller
{
    public static $pinList=[];
    public function index(){

    }
    public function  getPinCodes(Request $r){
     $validator =Validator::make($r->all(), [
            'num_pin_code' => 'required|min:1|integer',
     ]);
        if($validator->errors()->any()){
            return Response()->json(["statusCode"=>500,"data"=>$validator->messages()]);
        }
     $num_pin=$r->num_pin_code;
     for($i=0;$i<$num_pin;$i++){
         $this->generatePin();
     }
     return Response()->json(["statusCode"=>200,"data"=>self::$pinList]);
    }
    public function generatePin(){
        $pin=rand(1000,9999);
        $d1= substr($pin,0,1);
        $d2= substr($pin,1,1);
        $d3= substr($pin,2,1);
        $d4= substr($pin,3,1);
        //It should not generate obvious combinations 1111
        if ($d1===$d2 && $d2===$d3 && $d3===$d4){
            $this->generatePin();
        }
        //pin must be in anon sequential order 1234
        elseif ($d4==$d3+1 && $d3==$d2+1 && $d2==$d1+1){
            $this->generatePin();
        }
        //No PIN should be repeated until all other possibilities have been generated
        elseif (in_array($pin,self::$pinList)){
            $this->generatePin();
        }
        //notes* we can merge all previous conditions in one condition
        else{
            self::$pinList[]=$pin;
        }

        return true;

    }

}
