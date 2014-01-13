<?php

class informe extends Controller {

    public function informe () {
        $this->loadModel('info');
    }


    public function index($data = '')  {

        $Slim = Controller::$slimx;

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

        $Slim::getView('app/head', $data, function($route,$data){
            $data;
            include $route;
        });

        $data = array("sms" => array("enviados" => $sms_enviados,
                                     "correctos"=> $sms_correctos,
                                     "fallidos" => $sms_fallidos
                                    ));

        $Slim::getView('informe/inicio', $data, function($route,$data){
            $data;
            include $route;
        });

        $Slim::getView('app/foot', $data, function($route,$data){
            $data;
            include $route;
        });

    }

}

?>
