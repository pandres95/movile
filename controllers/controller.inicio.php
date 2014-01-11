<?php

class inicio extends Controller{
    
    public function inicio(){
        if(!isset($_SESSION['u_session']) and !$_SESSION['u_session']['pase']){
            header('location: /movile/login');
        }
        $this->loadModel('info');
        $this->loadModel('municipios');
    }	
    
    public function index($data = ''){
        
        try{
            
            /* Obteniendo información sobre el panel de control */
            $sms_enviados = json_decode(Controller::getModel('info')->smsTotales());
            if(!isset($sms_enviados->error)){
                $sms_enviados = $sms_enviados[0]->cuenta;
            }else {
                $sms_enviados = 0;
            }
            
            $sms_correctos = json_decode(Controller::getModel('info')->smsCorrectos());
            if(!isset($sms_correctos->error)){
                $sms_correctos = $sms_correctos[0]->cuenta;
            }else {
                $sms_correctos = 0;
            }
            
            $sms_fallidos = json_decode(Controller::getModel('info')->smsFallidos());
            if(!isset($sms_fallidos->error)){
                $sms_fallidos = $sms_fallidos[0]->cuenta;
            }else {
                $sms_fallidos = 0;
            }
            
            $num_encuestas = json_decode(Controller::getModel('info')->numeroEncuestas());
            if(!isset($num_encuestas->error)){
                $num_encuestas = $num_encuestas[0]->cuenta;
            }else {
                $num_encuestas = 0;
            }
            $municipios = json_decode(Controller::getModel('municipios')->getMunicipiosJSON());
            $sms_enviados_mun = array();
            if(!isset($municipios->error)){
                foreach($municipios->municipios as $key => $value){
                    $c_sms_enviados = json_decode(Controller::getModel('info')->smsEnviadosPorMunicipio($value->codigo));
                    if(!isset($c_sms_enviados->error))
                    {
                        if($c_sms_enviados[0]->cuenta > 0){
                            $sms_enviados_mun[] = array("municipio" => $value->municipio,
                                                        "longitud" => $value->longitud,
                                                        "latitud" => $value->latitud,
                                                        "cuenta" => (int) $c_sms_enviados[0]->cuenta
                                                       );
                        }
                    }
                }
            }
            $respuestas_por_deptos = json_decode(Controller::getModel('info')->respuestasPorDepartamentos());
            /* -------------------------------------------------------- */
            
            $Slim = Controller::$slimx;
            
            $Slim::getView('app/head',$menu,function($route,$data){
                $data;
                include $route;
            });
            
            $data = array("sms" => array("enviados" => $sms_enviados,
                                         "correctos"=> $sms_correctos,
                                         "fallidos" => $sms_fallidos),
                          "encuestas" => $num_encuestas,
                          "sms_enviados_mun" => json_encode($sms_enviados_mun),
                          "respuestas_por_deptos" => json_encode($respuestas_por_deptos)
                         );
            
            $Slim::getView('inicio/inicio',$data,function($route,$data){
                $data;
                include $route;
            });
            
            $Slim::getView('app/foot',$data,function($route,$data){
                $data;
                include $route;
            });
            
        }catch(Exception $e){
            throw $e;
        }
        
        
        
    }
    
}

?>