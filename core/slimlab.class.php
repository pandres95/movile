<?php

/*

Slimax - SlimFrame Views System
Revision 0

*/


class Slimax{

	public function Slimax(){

	}
	
	public function setSettings($settings = array()){}
	
	public function get() {
        $args = func_get_args();
        $f = $this->getFunction($args);
        $f($args[0]);
    }
    
    public static function getView() {
        $args = func_get_args();
        $f = self::getFunction($args);
        $f('views/'.$args[0].'.php',$args[1]);
    }
    
    public function getRows(){
      $args = func_get_args();      
      $f = $this->getFunction($args);
      $f($args[0]);
  }

  public static function getFunction($args){
      $pattern = array_shift($args);
      $callable = array_pop($args);
      if(is_callable($callable)){
       return $callable;
   }
}
}








