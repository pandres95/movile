<?php

class app extends Controller {
    
    public function app() {
        header('Content-Type: application/json; charset=UTF-8');
    }
    
    public function header_items()  {
        
        $Slim = Controller::$slimx;
        $u = unserialize($_SESSION['u_session']['data']);
        
        $menu = array(
            "nombre" => $u[0]->nombre,
            "menu" => Controller::query("SELECT * FROM movile_menu WHERE nivel like '%".$u[0]->nivel."%'")
        );
        
        if(PHP_VERSION_ID < 50400){
            echo pretty_json(json_encode($menu), "\n", "    ");
        } else {
            echo json_encode($menu, JSON_PRETTY_PRINT);
        }
        
    }
    
}

?>