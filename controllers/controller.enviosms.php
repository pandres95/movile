<?php

class enviosms extends Controller{
    
    public function enviosms(){
        if(!$_SESSION['u_session']['pase']){
            header('location: /movile/login');
        }  
    }
    
    public function index($data = ''){
        
        try{
            
            $Slim = Controller::$slimx;
            $u = unserialize($_SESSION['u_session']['data']);
            
            $menu = array("nombre" => $u[0]->nombre,
                          "menu" => Controller::query("SELECT * FROM movile_menu WHERE nivel like '%".$u[0]->nivel."%'")
                         );
            
            $Slim::getView('head', $menu, function($route,$data){
                $data;
                include $route;
            });
            
            $Slim::getView('enviosms', $data, function($route,$data){
                $data;
                include $route;
            });
            
            $Slim::getView('foot', $data, function($route,$data){
                $data;
                include $route;
            });
            
        } catch (Exception $e) {
            throw $e;
        }
        
    }
    
    public function encuestas($data = ''){
        
        try{
            
            $Slim = Controller::$slimx;
            $u = unserialize($_SESSION['u_session']['data']);
            
            $menu = array("nombre" => $u[0]->nombre,
                          "menu" => Controller::query("SELECT * FROM movile_menu WHERE nivel like '%".$u[0]->nivel."%'")
                         );
            
            $Slim::getView('head', $menu, function($route,$data){
                $data;
                include $route;
            });
            
            $Slim::getView('formpull', $data, function($route,$data){
                $data;
                include $route;
            });
            
            $Slim::getView('foot', $data, function($route,$data){
                $data;
                include $route;
            });
            
        } catch (Exception $e) {
            throw $e;
        }
        
    }
    
    public function enviarsms($token = ''){
        $wsdl = Controller::$ws;
        if(isset($_POST)){
            
            if(!$_POST['text']){
                $contenido = $encuesta;
            }else{
                $contenido = $_POST['text'];
            }
            
            
            
            if ($_FILES) {
                $fila = 1;
                if (($gestor = fopen($_FILES['archivoPlano']['tmp_name'], "r")) !== FALSE) {
                    while (($datos = fgetcsv($gestor, 1000, ",")) !== FALSE) {
                        $numero = count($datos);
                        for ($c=0; $c < $numero; $c++) {
                            $data_sms = explode('|', $datos[$c]);
                            
                            // $data_sms[0] -> Numero del Movil
                            // $data_sms[1] -> Ciudad del Movil
                            
                            $param = array(
                                'User'			=>'developer2',
                                'Password'		=>'d5482c85',
                                'Message' 		=>$contenido,
                                'PhoneNumber' 	=> $data_sms[0]
                            );
                            
                            $wsdl->initClient('http://hackaton.inalambria.com/ServiceSendMessage.svc?wsdl');
                            
                            if($data = $wsdl->execMethod('SendMessage',$param)){
                                $status = true;
                            }
                        }
                    }
                    fclose($gestor);
                }
            }
            
            if ($status) {
                echo json_encode($data);
            }
            
        }
        
    }
    
}

?>