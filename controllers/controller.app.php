<?php

class app extends Controller {
    
    public function app() {
        if($_SERVER['REQUEST_METHOD'] == 'GET'){
            http_response_code(401);
            include '/xhtml/err_docs/401.html';
            exit;
        }
        header('Content-Type: application/json; charset=UTF-8');
    }
    
    public function header_items()  {

        if(http_response_code() != 403){

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

}

?>
