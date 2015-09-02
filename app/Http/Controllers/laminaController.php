<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\model\lamina;
use Validator;
use route;
use Auth;
class laminaController extends Controller
{
     public function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {
        return view('ConsultaLaminas');
    }

    public function getLaminas(){
        // return lamina::all();
        return DB::table('laminas')
                    ->where('users_id','=',Auth::user()->id)
                    ->get();

    }
    public function getEditoriales(){
        return DB::select('select distinct editorial from laminas where users_id='.Auth::user()->id.'  group  by editorial');
    }

    public function validarLamina($lamina){
        
         $reglas=array(
            'numero'=>'numeric|required',
            'titulo'=>'required',
            'editorial'=>'required',
            'cantidad'=>'numeric');
        $input=$lamina;
        $validator=Validator::make($input,$reglas);
        if ($validator->fails()) {
            return $validator->messages();
        }else{
            return null;
        }
    }

  public function updateLamina(Request $request){
        $request=$request->all();
        
        $message=$this->validarLamina($request);
        // return $message;
        if(!is_null($message)){
            return $message;
        }else{
            $lamina=lamina::find($request["id"]);
            $lamina["numero"]=$request["numero"];
            $lamina["titulo"]=$request["titulo"];
            $lamina["editorial"]=$request["editorial"];
            $lamina["users_id"]=Auth::user()->id;
            $lamina["descripcion"]=$request["descripcion"];
            $lamina["cantidad"]=$request["cantidad"];
            $lamina->save();
            return $lamina;
        }
    }
    public function createLamina(Request $request){
        $request=$request->all();
        $message=$this->validarLamina($request);
        if(!is_null($message)){
            return $message;
        }else{
            $lamina=lamina::find($request["id"]);
            $lamina["numero"]=$request["numero"];
            $lamina["titulo"]=$request["titulo"];
            $lamina["editorial"]=$request["editorial"];
            $lamina["users_id"]=Auth::user()->id;
            if(!empty($lamina['descripcion']))$lamina["descripcion"]=$request["descripcion"];
            if(!empty($lamina['cantidad']))$lamina["cantidad"]=$request["cantidad"];
            $lamina->save();
            return "Lamina creada Exitosamente";
        }

    }
    public function createListLamina(Request $request){
        $arrayMessageError=[];
        $arrayMessageSuccess=[];
        $request=$request->all();
        // return $request;
        foreach ($request as $lamina ) {
            $message=$this->validarLamina($lamina);
            if(!is_null($message)){
                array_push($arrayMessageError, array("id_"=>$lamina["id_"],"message"=>$message)) ;
            }else{
                $Lamina=new lamina;
                $Lamina["numero"]=$lamina["numero"];
                $Lamina["titulo"]=$lamina["titulo"];
                $Lamina["editorial"]=$lamina["editorial"];
                $Lamina["users_id"]=Auth::user()->id;
                if(!empty($lamina['descripcion']))$Lamina["descripcion"]=$lamina["descripcion"];
                if(!empty($lamina['cantidad']))$Lamina["cantidad"]=$lamina["cantidad"];
                $Lamina->save();
                array_push($arrayMessageSuccess, $Lamina);
            }
        }
        return array("Error"=>$arrayMessageError,"Success"=>$arrayMessageSuccess);
    }

    public function vender(Request $request)
    {
        $id=$request->input('id');
        $cantidad=$request->input('cantidad');
        $lamina=lamina::find($id);
        if($lamina["cantidad"]>$cantidad){
            $lamina["cantidad"]=$lamina["cantidad"]-$cantidad;
            $lamina->save();
            return "Venta Exitosa";
        }else{
            return "No hay laminas Suficientes";
        }
    }

  public function deleteLamina(Request $request){
        $id=$request->input("id");
        $lamina=lamina::find($id);
        $lamina->delete();
        return "se ha eliminado exitosamente";
  }
}
