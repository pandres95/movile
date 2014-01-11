<?php


class encuesta extends Controller {
    
    public function encuesta() {}
    
    public function index($data = ''){
        
        try{
            
            $Slim = Controller::$slimx;
            
            $data = array("num" => Controller::query("SELECT COUNT(id) AS cuenta FROM movile_encuestas;")[0]['cuenta'],
                         "encuestas" => Controller::query("SELECT id, nombre FROM movile_encuestas")
                         );
            
            $Slim::getView('app/head', $data, function($route,$data){
                $data;
                include $route;
            });
            
            $Slim::getView('encuesta/lista', $data, function($route,$data){
                $data;
                include $route;
            });
            
            $Slim::getView('app/foot', $data, function($route,$data){
                $data;
                include $route;
            });
            
        } catch (Exception $e) {
            throw $e;
        }
        
    }
    
    public function nueva($data = ''){
        
        try{
            
            $Slim = Controller::$slimx;
            
            $Slim::getView('app/head', $data, function($route,$data){
                $data;
                include $route;
            });
            
            $Slim::getView('encuesta/nueva', $data, function($route,$data){
                $data;
                include $route;
            });
            
            $Slim::getView('app/foot', $data, function($route,$data){
                $data;
                include $route;
            });
            
        } catch (Exception $e) {
            throw $e;
        }
        
    }
    
}

?>