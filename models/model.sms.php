<?php

class smsModel extends Model{
    
    public function smsModel(){}
    
    public function registraCelular($celular, $ciudad) {
        $sql = "CALL insertar_celular('$celular', '$ciudad')";
        Model::spQuery($sql);        
    }
    
    public function registraSMS($celular, $mensaje){
        $sql = "INSERT INTO sms_enviados (celular, mensaje) VALUES ('$celular', '$mensaje');";
        Model::query($sql);
    }
    
    public function fallaSMS($celular){
        $sql = "INSERT INTO sms_fallidos (celular) VALUES ('$celular');";
        Model::query($sql);
    }
    
    public function iniciaEncuesta($celular, $encuesta){
        $sql = "CALL iniciar_encuesta('$celular', $encuesta, @res);";
        Model::spQuery($sql);
    }
    
    public function smsEnviados($pagenum){


        $filtro = '';

        if(isset($_GET['filtro'])){
            $filtro = "WHERE " . $_GET['filtro'] . " LIKE '%" . $_GET['valor'] . "%'";
        }

        if (!(isset($pagenum))){
            $pagenum = 1;
        }

        $tmp = Controller::query("SELECT " .
                                 "(SELECT COUNT(id) as cuenta FROM respuestas_usuarios $filtro) + ".
                                 "(SELECT COUNT(id) as cuenta FROM sms_enviados $filtro) +".
                                 "(SELECT COUNT(id) as cuenta FROM sms_fallidos $filtro) as cuenta;");
        $rows = $tmp[0]['cuenta'];
        $page_rows = isset($_POST['page_rows']) ? $_POST['page_rows'] : 4;
        $last = ceil($rows / $page_rows);

        if ($pagenum < 1) {
            $pagenum = 1;
        } elseif ($pagenum > $last) {
            $pagenum = $last;
        }

        $limit = 'LIMIT ' .($page_rows * ((int)$pagenum - 1)) . ', ' . $page_rows;


        $sql = "SELECT * FROM (SELECT id, celular, mensaje, fecha, 'SENT' as tipo FROM sms_enviados ".
            "UNION ALL ".
            "SELECT id, celular, '' as mensaje, fecha, 'FAIL' as tipo FROM sms_fallidos ".
            "UNION ALL ".
            "SELECT r.id, r.celular, p.texto as mensaje, r.fecha, 'SURV' as tipo ".
            "FROM respuestas_usuarios r, movile_preguntas p WHERE p.id = r.id_pregunta) i_union $filtro ORDER BY fecha, celular $limit;";

        $data = array("num_paginas" => $last,
                      "resultados" => Controller::query($sql)
                     );

        if(PHP_VERSION_ID < 50400){
            $res = pretty_json(json_encode($data), "\n", "    ");
        } else {
            $res = json_encode($data, JSON_PRETTY_PRINT);
        }

        return $res;

    }
    
    public function smsCorrectos($pagenum){


        $filtro = '';

        if(isset($_GET['filtro'])){
            $filtro = "WHERE " . $_GET['filtro'] . " LIKE '%" . $_GET['valor'] . "%'";
        }

        if (!(isset($pagenum))){
            $pagenum = 1;
        }

        $tmp = Controller::query("SELECT " .
                                 "(SELECT COUNT(id) as cuenta FROM respuestas_usuarios $filtro) + ".
                                 "(SELECT COUNT(id) as cuenta FROM sms_enviados $filtro) as cuenta;");
        $rows = $tmp[0]['cuenta'];
        $page_rows = isset($_POST['page_rows']) ? $_POST['page_rows'] : 4;
        $last = ceil($rows / $page_rows);

        if ($pagenum < 1) {
            $pagenum = 1;
        } elseif ($pagenum > $last) {
            $pagenum = $last;
        }

        $limit = 'LIMIT ' .($page_rows * ((int)$pagenum - 1)) . ', ' . $page_rows;


        $sql = "SELECT * FROM (SELECT id, celular, mensaje, fecha, 'SENT' as tipo FROM sms_enviados ".
            "UNION ALL ".
            "SELECT r.id, r.celular, p.texto as mensaje, r.fecha, 'SURV' as tipo ".
            "FROM respuestas_usuarios r, movile_preguntas p WHERE p.id = r.id_pregunta) i_union $filtro ORDER BY fecha, celular $limit;";

        $data = array("num_paginas" => $last,
                      "resultados" => Controller::query($sql)
                     );

        if(PHP_VERSION_ID < 50400){
            $res = pretty_json(json_encode($data), "\n", "    ");
        } else {
            $res = json_encode($data, JSON_PRETTY_PRINT);
        }

        return $res;

    }

}
