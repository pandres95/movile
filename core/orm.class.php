<?php

/*

ccRICK
ORM System
Revison 0

*/

class orm extends core{
    
    public static $results,$data;
    
    public function orm($cnxo = false){
        
    }
    
    public static function versig(){
        echo 'siii';
    }
    
    /*  Query Method  */
    public static function query($sql_data = ''){
        $datainf = null;
        $sql = $sql_data;
        self::$results = $data = mysqli_query(self::$cnx,$sql) or die("Error: " . mysqli_error(self::$cnx) . ": " .  mysqli_errno(self::$cnx) . "<br/>" . $sql_data);
        if(count(self::$results) > 0){
            while($rpt = mysqli_fetch_array($data)){
                $datainf[] = $rpt;
            }
        }
        
        self::$data = $datainf;
        return $datainf;
    }
    
    /* Stored Procedure Query Method */
    public static function spQuery($sql_data = '') {
        
        $datainf = null;
        $sql = $sql_data;
        
        self::$results = $query = self::$cnx->multi_query($sql);
        
        if($query){
            
            do{
                if($result = self::$cnx->use_result()){
                    $tres = array();
                    while($rpt = mysqli_fetch_array($result)){
                        $tres[] = $rpt;
                    }
                    $datainf[] = $tres;
                    $result->close();
                }
            } while(self::$cnx->more_results() and self::$cnx->next_result());
            
            self::$data = $datainf;
            return $datainf;
            
        }
    }
    
    /* Simple Select Method */
    public function select($data = array(),$like = false){
        array_walk_recursive($data,'mysql_real_escape_string');
        $tabla = $data['tabla'];
        
        if($data['campos'] == 'all'){
            $campos = '*';
        }else{
            foreach($data['campos'] as $key => $value){
                $campos .= ($key != (count($data['campos'])-1)) ? $value.',' : $value ;
            }	
        }
        
        if($data['where'] != ''){
            $where = ' WHERE ';
            foreach($data['where'] as $key => $value){
                if($like){
                    $where .= $key." like '%".$value."%' AND ";
                }else{
                    $where .= $key.'='.$value;
                }
            }
            if($like){
                $where = substr($where, 0, (strlen($where)-5));
            }
        }else{
            $where = '';
        }
        
        if($data['limit'] != ''){
            $limit = ' LIMIT '.$data['limit']['inferior'].','.$data['limit']['superior'];
        }else{
            $limit = '';
        }
        
        if($data['order'] != ''){
            $order = ' ORDER BY '.$data['order']['campos'].' '.$data['order']['orientacion'];
        }else{
            $limit = '';
        }
        
        $sql = 'SELECT '.$campos.' FROM '.$tabla.$where.$order.$limit;
        
        $data = mysqli_query(self::$cnx,$sql) or die($sql);
        
        while($rpt = mysqli_fetch_array($data)){
            $datainf[] = $rpt;
        }
        
        return $datainf;
    }    
    
    
    /* Simple Select Method */
    public function genQuery($data = array(),$like = false){
        array_walk_recursive($data,'mysql_real_escape_string');
        $tabla = $data['tabla'];
        
        if($data['campos'] == 'all'){
            $campos = '*';
        }else{
            foreach($data['campos'] as $key => $value){
                $campos .= ($key != (count($data['campos'])-1)) ? $value.',' : $value ;
            }	
        }
        
        if($data['where'] != ''){
            $where = ' WHERE ';
            foreach($data['where'] as $key => $value){
                if($like){
                    $where .= $key." like '%".$value."%' AND ";
                }else{
                    $where .= $key.'='.$value;
                }
            }
            if($like){
                $where = substr($where, 0, (strlen($where)-5));
            }
        }else{
            $where = '';
        }
        
        if($data['limit'] != ''){
            $limit = ' LIMIT '.$data['limit']['inferior'].','.$data['limit']['superior'];
        }else{
            $limit = '';
        }
        
        
        if($data['order'] != ''){
            $order = ' ORDER BY '.$data['order']['campos'].' '.$data['order']['orientacion'];
        }else{
            $limit = '';
        }
        
        $sql = 'SELECT '.$campos.' FROM '.$tabla.$where.$order.$limit;
        
        return $sql;
    }
    
    
    /* Simple Insert Method */
    public function insert($data = array()){
        array_walk_recursive($data,'limpia');
        $tabla = $data['tabla'];
        $i = 1;
        $maxr = count($data['reg']);
        foreach($data['reg'] as $key => $data){
            $campos .= ($i != $maxr) ? $key.',' : $key ;
            $values .= ($i != $maxr) ? "'".$data."'," : "'".$data."'" ;
            ++$i;
        }
        
        $sql = 'INSERT INTO '.$tabla.' ('.$campos.') values ('.$values.')';
        $data = mysqli_query(self::$cnx,$sql) or die($sql); 
        return $data;
    }
    
    
    /* Simple Update Method */
    public function updata($data = array()){
        array_walk_recursive($data,'limpia');
        $tabla = $data['tabla'];
        
        $i = 1;
        $maxr = count($data['reg']);
        foreach($data['reg'] as $key => $datax){
            $campos .= ($i != $maxr) ? $key.'='.(($datax == '') ? 'NULL' : "'".$datax."'" ).',' : $key.'='.(($datax == '') ? 'NULL' : "'".$datax."'" ) ;
            //$values .= ($i != $maxr) ? "'".$data."'," : "'".$data."'" ;
            ++$i;
        }
        
        if($data['where'] != ''){
            $where = ' WHERE ';
            foreach($data['where'] as $key => $value){
                $where .= $key.'='.$value;
            }
        }else{
            $where = '';
        }
        
        if($data['limit'] != ''){
            //$limit = ' LIMIT '.$data['limit']['inferior'].','.$data['limit']['superior'];
        }else{
            $limit = '';
        }
        
        $sql = 'UPDATE '.$tabla.' SET '.$campos.' '.$where;
        $data = mysqli_query(self::$cnx,$sql) or die($sql); 
        
        if($data){
            return true;
        }
    }
    
    public static function getLast(){
        return mysqli_insert_id(self::$cnx);
    }
    
    public static function genNumberPage($pagina){
        $max = 9; 
        if(!$pagina){ 
            $inicio = 0; 
        }else{ 
            $inicio =  $pagina * $max;
        } 
        
        return array('inferior'=>$inicio,'superior'=>$max);
        
    }
}

?>