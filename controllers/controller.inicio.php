<?php

class inicio extends Controller{
    
    public function inicio(){
        if(!$_SESSION['u_session']['pase']){
            header('location: /movile/login');
        }
    }	
    
    public function index($data = ''){
        
        $Slim = Controller::$slimx;
        $u = unserialize($_SESSION['u_session']['data']);
        
        $menu = Controller::query("SELECT * FROM movile_menu WHERE nivel like '%".$u[0]->nivel."%'");
        
        $Slim::getView('head',$menu,function($route,$data){
            $data;
            include $route;
        });
        
        $Slim::getView('inicio',$data,function($route,$data){
            $data;
            include $route;
        });
        
        $Slim::getView('foot',$data,function($route,$data){
            $data;
            include $route;
        });
        
    }
    
}

?>