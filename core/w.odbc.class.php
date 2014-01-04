<?php

class dborm{

public $enlace;
public $results,$data;

public function dborm($enlace){
 $this->enlace = $enlace;
}

public function query($sql_data = ''){
	@odbc_free_result($this->results);
	$sql = $sql_data;
	$this->results = $data = odbc_exec($this->enlace,$sql);
		while($rpt = odbc_fetch_array($data)){
			$datainf[] = $rpt;
		}
	$this->data = $datainf;
	return $datainf;
}

public function getData(){
	return $this->data;
}

public function numRows(){
  return odbc_num_rows($this->results);
}

public function select($data = array(),$like = false){
 $tabla = $data['tabla'];
 
	 foreach($data['campos'] as $key => $value){
	    $campos .= ($key != (count($data['campos'])-1)) ? $value.',' : $value ;
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
 
  
	$sql = 'SELECT '.$campos.' FROM '.$tabla.$where.$limit;
	$data = mysql_query($this->enlace,$sql) or die($sql);

	 while($rpt = mysql_fetch_array($data)){
		$datainf[] = $rpt;
	 }
	 
return $datainf;
}


public function selectMax($tabla, $campo_id = 'ID'){
 	$sql = 'SELECT CASE WHEN MAX('.$campo_id.') IS NULL THEN 1 ELSE MAX('.$campo_id.')+1 END as ultimo FROM '.$tabla;
	$data = odbc_exec($this->enlace,$sql);
	 $driver = odbc_fetch_array($data);
	 return $driver['ULTIMO'];
}


public function insert($data = array()){
 $tabla = $data['tabla'];
 $i = 1;
 $maxr = count($data['reg']);
 foreach($data['reg'] as $key => $data){
    $campos .= ($i != $maxr) ? $key.',' : $key ;
	$values .= ($i != $maxr) ? "'".$data."'," : "'".$data."'" ;
	++$i;
 }
 
 $sql = 'INSERT INTO '.$tabla.' ('.$campos.') values ('.$values.')';
 $data = mysql_query($sql,$this->enlace) or die($sql); 
 return $data;
}

public function updtae($data = array()){
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
      $data = odbc_exec($this->enlace,$sql) or die($sql); 
	 
	 if($data){
	 	return true;
	 }
}

}


$cnx = mysql_connect('localhost','hc','870122') or die(mysql_error());
mysql_select_db('hc');

$db = new dborm($cnx);
array_shift($_POST);
$db->insert(array('tabla'=>'hc_basicos','reg'=>$_POST));

?>
