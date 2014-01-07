<?php


/*

Core CC - ccToolkit
Revision 0

*/


class core {
    
    public static $cnx;
    public static $objs;
    public static $uri;
    
    public function core(){
        
    }
    
    public static function settings($sets = array()){
        self::control_errors($sets['errors']);
        self::$uri = $sets['uri'];
    }
    
    public static function SQLConnect($params){
        try{
            self::$cnx = mysqli_connect($params['host'],$params['user'],$params['pass'],$params['db']);
            self::$cnx->set_charset('utf8');
        }catch(Exception $ex){
            throw $ex;
        }
        return self::$cnx;
    }
    
    public function gerCnx(){
        return self::$cnx;
    }
    
    public static function control_errors($sw = fasle){
        if($sw){
            ini_set('display_errors', 0);
            ini_set('log_errors', 1);
            ini_set('error_log', dirname(__DIR__) . '/error_log.txt');
            error_reporting(E_ALL);
        }
    }
    
    public static function pushOStorage($name,$val){
        self::$objs[$name] = $val;
    }
    
    public function getObject($name){
        return self::$objs[$name];
    }
    
    public function getObs(){
        return self::$objs;
    }
    
    public static function getURI(){
        return self::$uri;
    }
    
    public static function ARMail($datau = array()){
        $mailEngine = new PHPMailer();
        $mailu = $datau['email'];
        $nomu  = $datau['nombres'];
        $html = file_get_contents($datau['plantilla']);
        
        $html = str_replace('{user}',$datau['daccess']['user'], $html);
        $html = str_replace('{pass}',$datau['daccess']['pass'], $html);
        
        try{
            $mailEngine->IsSMTP();
            $mailEngine->SMTPDebug  = 0;
            $mailEngine->Debugoutput = 'html';
            $mailEngine->Host       = 'smtp.mandrillapp.com';
            $mailEngine->Port       = 587;
            $mailEngine->SMTPSecure = 'tls';
            $mailEngine->SMTPAuth   = true;
            $mailEngine->Username   = "admin@caribecoders.com";
            $mailEngine->Password   = "748f8842-c867-468c-8d92-80e099afd6d8";
            $mailEngine->SetFrom('no-reply@negociolocal.net', 'Negociolocal.net');
            $mailEngine->AddReplyTo('no-reply@negociolocal.net','Negociolocal.net');
            $mailEngine->AddAddress($mailu, $nomu);
            $mailEngine->Subject = 'Negociolocal Te Informa';
            $mailEngine->MsgHTML($html, dirname(__FILE__));
            $mailEngine->Send();
        }catch(phpmailerException $e) {
            echo $e->errorMessage();
        }catch(Exception $e) {
            echo $e->getMessage();
        }
        
    }
}



?>
