<?php

class info extends Controller {
    
    public function info()
    {
        if($_SERVER['REQUEST_METHOD'] != 'POST'){
            header('location: /movile/');
        }
        $this->loadModel('info');
    }
    
    public function index($data = ''){
        header('location: /movile/');
    }
    
    public function numeroencuestas(){
        try{
            $num_encuestas = json_decode(Controller::getModel('info')->numeroEncuestas());
            if(!$num_encuestas->error){
                echo $num_encuestas[0]->cuenta;
            }else {
                echo 0;
            }
        }catch(Exception $e){
            echo 0;
        }
    }
    
    public function smscorrectos() {
        try{
            $sms_correctos = json_decode(Controller::getModel('info')->smsCorrectos());
            if(!$sms_correctos->error){
                echo $sms_correctos[0]->cuenta;
            }else{
                echo 0;
            }
        }catch(Exception $e){
            echo 0;
        }
    }
    
    public function smsfallidos() {
        try{
            $sms_fallidos = json_decode(Controller::getModel('info')->smsFallidos());
            if(!$sms_fallidos->error){
                echo $sms_fallidos[0]->cuenta;
            }else{
                echo 0;
            }
        }catch(Exception $e){
            echo 0;
        }
    }
    
    public function smstotales() {
        try{
            $sms_totales = json_decode(Controller::getModel('info')->smsTotales());
            if(!$sms_totales->error){
                echo $sms_totales[0]->cuenta;
            }else{
                echo 0;
            }
        }catch(Exception $e){
            echo 0;
        }
    }
    
}

?>