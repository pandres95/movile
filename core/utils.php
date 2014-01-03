<?php

/* 

Util Function Scripting
Revision 0

*/

/* SLIM Routing */
function routing (){
    GLOBAL $route, $c,$m, $arg,$strc,$app;
    $app['app']::control_errors(true);
    
    $route = explode('/',$_GET['r']);
    @$c = ($route[0]) ? $route[0] : 'inicio';
    @$m = ($route[1]) ? $route[1] : '';
    @$arg = ($route[2]) ? $route[2] : '';
    $strc = 'controllers/controller.'.$c.'.php';
    
    if(file($strc)){
        include($strc);
        if(class_exists($c)){
            $cc = new $c;
            
            if($m != ''){
                if($arg != ''){
                    $cc::$m($arg);
                }elseif(isset($_POST)){
                    $cc::$m($_POST);
                }else{
                    $cc::$m();
                }
            }else{
                $cc::index();
            }
        }
    }
}

/* Object Factory */
function autoLoad($list){
    GLOBAL $app, $orm;
    foreach ($list as $vari => $class) {
        include($vari.'.class.php');	
        $app[$vari] = new $class;
        $app['app']::pushOStorage($class,$app[$vari]);
    }
}

/* upFx Files */
function upFx($rFiles,$cDestino,$extPermitidas){
    $destino = $cDestino;
    $files = (object)$rFiles['foto'];
    
    foreach($files->name as $key => $value){
        
        $file_name = $files->name[$key];
        $extFile   = explode('.',$file_name);
        
        if(in_array($extFile[1],$extPermitidas)){
            move_uploaded_file($_FILES['foto']['tmp_name'][$key], $destino."/".basename(normalizador($file_name))) or die('FILE : ERROR.');
            $exito['file_name_'.$key] = $file_name;
        }else{
            $error[] = 'Error al subir archivo, Formato no Valido => '.$file_name.'<br>';
        }
    }
    
    $dInfo['exito'] = $exito;
    $dInfo['error'] = $error;
    
    return (object) $dInfo;
}

/* BeanchMarking */
function getTiempo() { 
    list($usec, $sec) = explode(" ",microtime()); 
    return ((float)$usec + (float)$sec); 
} 

/* Cleaning Querys */
function limpia($var){
    $malo = array("\\","\'","'","%",";",":","&","#",' or ',' and ');
    $i=0;$o=count($malo);
    while($i<=$o){
        $var = str_replace($malo[$i],"",$var);
        $i++;
    }
    return $var;
}

/* Pluriza ?? */
function plurizador($str){
    $vocales = array('a','e','i','o','u');
    $ultima_letra = substr($str,(strlen($str)-1),strlen($str));
    if(in_array($ultima_letra, $vocales)){
        return $str.'s';	
    }else{
        return $str.'es';	
    }
}

/* Normalizator */
function normalizador($str){
    $str = str_replace(' ', '_', $str);
    $str = str_replace('&', '', $str);
    $str = str_replace('=', '', $str);
    return $str;
}

?>