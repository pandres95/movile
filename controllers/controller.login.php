<?php

class login extends Controller{
    public static $mailengine;
    
    public function login(){
        if($_SESSION['u_session']['pase']){
            header('location: /movile/');
        }
        $this->loadModel('users');
    }	
    
    public function index($data = ''){
        
        $Slim = Controller::$slimx;
        
        $Slim::getView('login',function($route){
            include $route;
        });
        
    }
    
    public function auth(){
        $auth = json_decode(Controller::getModel('users')->validaUsario($_POST));
        if(!$auth->error){
            $_SESSION['u_session']['data'] = serialize($auth);
            $_SESSION['u_session']['pase'] = true;
            $_SESSION['u_session']['nombre'] = $auth[0]->nombre;
            header('location: /movile/');
        }else{
            header("Location: /movile/login");
        }
    }
        
    public function logout(){
        $_SESSION['u_session'] = NULL;
        unset($_SESSION['u_session']);
        header('location: /movile/');
    }
    
    
}

?>