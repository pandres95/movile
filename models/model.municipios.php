<?php

class municipiosModel extends Model{
    
    public function municipiosModel(){
        
    }
    
    public function getMunicipiosJSON($data){
        $sql = '';
        if($data){
            $sql = "SELECT movile_municipios.id as codigo, nombre, nombre_departamento, movile_municipios.longitud as longitud, movile_municipios.latitud as latitud FROM movile_municipios, movile_departamentos WHERE departamento = movile_departamentos.id AND movile_departamentos.id = $data";
        } else {
            $sql = "SELECT movile_municipios.id as codigo, nombre, nombre_departamento, movile_municipios.longitud as longitud, movile_municipios.latitud as latitud FROM movile_municipios, movile_departamentos WHERE departamento = movile_departamentos.id";
        }
        $municipios = Model::query($sql);
        
        if(count($municipios) > 0){
            if($data){
                $res = array();
                $depto = '';
                foreach($municipios as $key => $row) {
                    $depto = $row['nombre_departamento'];
                    $res[] = array(
                        "codigo" => $row['codigo'],
                        "municipio" => $row['nombre'],
                        "longitud" => $row['longitud'],
                        "latitud" => $row['latitud']
                    );
                }
                $res = array("departamento" => $depto, "municipios"=>$res);
            }else {
                foreach($municipios as $key => $row) {
                    $res[] = array(
                        "codigo" => $row['codigo'],
                        "municipio" => $row['nombre'],
                        "departamento" => $row['nombre_departamento'],
                        "longitud" => $row['longitud'],
                        "latitud" => $row['latitud']
                    );
                }
                $res = array("municipios"=>$res);
            }
            return json_encode($res, JSON_PRETTY_PRINT);
        }else{
            return json_encode(array('error' => true), JSON_PRETTY_PRINT);
        }
    }
    
}

?>