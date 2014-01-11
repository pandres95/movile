<?php

class user extends Controller{
    
    public function user(){
        $this->loadModel('users');
    }	
    
    public function index($data = ''){
        $u = unserialize($_SESSION['u_session']['data']);
        $Slim = Controller::$slimx;
        $user = Controller::query("SELECT * FROM usuarios_generales WHERE id ='".$u[0]->id."'");
        $udata = array(
            'tabla' =>'arriendos',
            'campos' => 'all',
            'where'=> array(
                'id_usuario'=>$u[0]->id,
                ' and estado'	=> 1
            )
        );
        
        $user['arriendos'] = Controller::select($udata);
        
        $Slim::getView('head',function($route){
            include $route;
        });
        
        $Slim::getView('usuario',$user,function($route,$user){
            $user;
            include $route;
        });
        
        $Slim::getView('foot',function($route){
            include $route;
        });	
        
    }
    
    public function borrado(){
        $Slim = Controller::$slimx;
        $id = $_POST['id'];
        Controller::query("UPDATE arriendos SET estado = '0' WHERE id ='".$id."'");
    }
    
}

?>