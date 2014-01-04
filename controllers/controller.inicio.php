<?php

class inicio extends Controller{
    
    public function inicio(){
        if(!$_SESSION['u_session']['pase']){
            header('location: /movile/login');
        }
        $this->loadModel('info');
    }	
    
    public function index($data = ''){
        
        try{
            
            /* Obteniendo información sobre el panel de control */
            $sms_enviados = json_decode(Controller::getModel('info')->smsTotales());
            if(!$sms_enviados->error){
                $sms_enviados = $sms_enviados[0]->cuenta;
            }else {
                $sms_enviados = 0;
            }
            
            $sms_correctos = json_decode(Controller::getModel('info')->smsCorrectos());
            if(!$sms_correctos->error){
                $sms_correctos = $sms_correctos[0]->cuenta;
            }else {
                $sms_correctos = 0;
            }
            
            $sms_fallidos = json_decode(Controller::getModel('info')->smsFallidos());
            if(!$sms_fallidos->error){
                $sms_fallidos = $sms_fallidos[0]->cuenta;
            }else {
                $sms_fallidos = 0;
            }
            
            $num_encuestas = json_decode(Controller::getModel('info')->numeroEncuestas());
            if(!$num_encuestas->error){
                $num_encuestas = $num_encuestas[0]->cuenta;
            }else {
                $num_encuestas = 0;
            }
            /* -------------------------------------------------------- */
            
            $Slim = Controller::$slimx;
            $u = unserialize($_SESSION['u_session']['data']);
            
            $menu = array("nombre" => $u[0]->nombre,
                          "menu" => Controller::query("SELECT * FROM movile_menu WHERE nivel like '%".$u[0]->nivel."%'")
                         );
            
            $Slim::getView('head',$menu,function($route,$data){
                $data;
                include $route;
            });
            
            $data = array("sms" => array("enviados" => $sms_enviados,
                                         "correctos"=> $sms_correctos,
                                         "fallidos" => $sms_fallidos),
                          "encuestas" => $num_encuestas
                         );
            
            $Slim::getView('inicio',$data,function($route,$data){
                $data;
                include $route;
            });
            
            $Slim::getView('foot',$data,function($route,$data){
                $data;
                include $route;
            });
            
        }catch(Exception $e){
            throw $e;
        }
        
        
        
    }
    
}

?>