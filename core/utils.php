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
            
            if($m != '' and method_exists($cc, $m)){
                if($arg != ''){
                    $cc->$m($arg);
                }else{
                    $cc->$m();
                }
            }else{
                $cc->index();
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

function PHP_VERSION_ID(){
    
    // PHP_VERSION_ID is available as of PHP 5.2.7, if our 
    // version is lower than that, then emulate it
    if (!defined('PHP_VERSION_ID')) {
        $version = explode('.', PHP_VERSION);
        
        define('PHP_VERSION_ID', ($version[0] * 10000 + $version[1] * 100 + $version[2]));
    }
    
}

/**
 * JSON beautifier
 * 
 * @param string    The original JSON string
 * @param   string  Return string
 * @param string    Tab string
 * @return string
 */
function pretty_json($json, $ret= "\n", $ind="\t") {

    $beauty_json = '';
    $quote_state = FALSE;
    $level = 0; 

    $json_length = strlen($json);

    for ($i = 0; $i < $json_length; $i++)
    {                               

        $pre = '';
        $suf = '';

        switch ($json[$i])
        {
            case '"':                               
                $quote_state = !$quote_state;                                                           
                break;

            case '[':                                                           
                $level++;               
                break;

            case ']':
                $level--;                   
                $pre = $ret;
                $pre .= str_repeat($ind, $level);       
                break;

            case '{':

                if ($i - 1 >= 0 && $json[$i - 1] != ',')
                {
                    $pre = $ret;
                    $pre .= str_repeat($ind, $level);                       
                }   

                $level++;   
                $suf = $ret;                                                                                                                        
                $suf .= str_repeat($ind, $level);                                                                                                   
                break;

            case ':':
                $suf = ' ';
                break;

            case ',':

                if (!$quote_state)
                {  
                    $suf = $ret;                                                                                                
                    $suf .= str_repeat($ind, $level);
                }
                break;

            case '}':
                $level--;   

            case ']':
                $pre = $ret;
                $pre .= str_repeat($ind, $level);
                break;

        }

        $beauty_json .= $pre.$json[$i].$suf;

    }

    return $beauty_json;

}

?>