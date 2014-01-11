<?php

class enviosms extends Controller{
    
    public function enviosms(){
        if(!$_SESSION['u_session']['pase']){
            header('location: /movile/login');
        }
        $this->loadModel('sms');
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
            
            $encuestas = Controller::query("SELECT id, nombre FROM movile_encuestas");
            
            $Slim::getView('enviosms', $encuestas, function($route,$data){
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
        
        $issms = true;
        $wsdl = Controller::$ws;
        $res = new stdClass;
        
        if(isset($_POST)){
            
            if(!$_POST['text']){
                $issms = false;
                $encuesta = $_POST['survey'];
            }else{
                $contenido = $_POST['text'];
            }
            
            if ($_FILES['archivoPlano']['tmp_name'] != '') {
                $fila = 1;
                if (($gestor = fopen($_FILES['archivoPlano']['tmp_name'], "r")) !== FALSE) {
                    while (($datos = fgetcsv($gestor, 17, ",")) !== FALSE) {
                        
                        // $datos[0] -> Numero del Movil
                        // $datos[1] -> Ciudad del Movil
                        
                        if($datos[0] != null && $datos[1] != null){
                            
                            $celular = array("celular" => $datos[0],
                                             "ciudad" => $datos[1]
                                            );
                            
                            try{
                                
                                Controller::getModel('sms')->registraCelular($celular['celular'], $celular['ciudad']);
                                
                                if(!$issms){
                                    $ans = Controller::spQuery("SELECT nombre FROM movile_encuestas WHERE id = $encuesta; SELECT texto FROM movile_preguntas WHERE id_encuesta = $encuesta LIMIT 1; SELECT numeral, texto FROM movile_respuestas WHERE id_pregunta = (SELECT id FROM movile_preguntas WHERE id_encuesta = $encuesta LIMIT 1);");
                                    
                                    $contenido = $ans[0][0][0] . "\n" .
                                        $ans[1][0][0] . "\n\n";
                                    
                                    foreach($ans[2] as $key => $val){
                                        $contenido .= $val[0] . ". " . $val[1] . ".\n";
                                    }
                                }
                                
                                $param = array(
                                    'User'			=> 'developer1',
                                    'Password'		=> 'acd52431',
                                    'Message' 		=> $contenido,
                                    'PhoneNumber' 	=> $celular['celular']
                                );
                                
                                $wsdl->initClient('http://hackaton.inalambria.com/ServiceSendMessage.svc?wsdl');
                                
                                if($data = $wsdl->execMethod('SendMessage', $param)){
                                    $res = $data;
                                }
                                
                                if($issms){
                                    Controller::getModel('sms')->registraSMS($celular['celular'], $contenido);
                                } else {
                                    Controller::getModel('sms')->iniciaEncuesta($celular['celular'], $encuesta);
                                }
                                
                                $res->status = true;
                                
                            } catch(Exception $ex) {
                                Controller::getModel('sms')->fallaSMS($celular['celular']);
                                $res->status = false;
                                $res->error = $ex->getMessage();
                            }
                            
                        }
                    }
                    fclose($gestor);
                }
            } else {
                $res->status = false;
                $res->error = "No se ha encontrado el archivo";
            }
            
        } else {
            $res->status = false;
            $res->error = "No se han hallado datos";
        }
        
        echo json_encode($res);
        
    }
    
}

?>