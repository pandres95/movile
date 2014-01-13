<?php

class encuestaModel extends Model {

    public function listarEncuestas($pagenum){

        $filtro = '';

        if(isset($_GET['filtro'])){
            $filtro = "WHERE " . $_GET['filtro'] . " LIKE '%" . $_GET['valor'] . "%'";
        }

        if (!(isset($pagenum))){
            $pagenum = 1;
        }

        $tmp = Controller::query("SELECT COUNT(id) as cuenta FROM movile_encuestas $filtro;");
        $rows = $tmp[0]['cuenta'];
        $page_rows = isset($_POST['page_rows']) ? $_POST['page_rows'] : 4;
        $last = ceil($rows / $page_rows);

        if ($pagenum < 1) {
            $pagenum = 1;
        } elseif ($pagenum > $last) {
            $pagenum = $last;
        }

        $limit = 'LIMIT ' .($page_rows * ((int)$pagenum - 1)) . ', ' . $page_rows;
        $data = array("num_paginas" => $last,
                      "encuestas" => Controller::query("SELECT * FROM movile_encuestas $filtro $limit;")
                     );

        if(PHP_VERSION_ID < 50400){
            $res = pretty_json(json_encode($data), "\n", "    ");
        } else {
            $res = json_encode($data, JSON_PRETTY_PRINT);
        }

        return $res;

    }

}

?>
