<?php
class opendata extends Controller {
    
    public function opendata(){
        $this->loadModel('municipios');
        header('Content-Type: application/json; charset=UTF-8');
        header('Access-Control-Allow-Origin: *');
    }
    
    public function index($data = ''){
        header ('Content-Type: text/plain; charset=UTF-8');
        echo file_get_contents(self::getURI().'/xhtml/txt/info_opendata.txt');
    }
    
    public function infomunicipios($data) {
        $municipios = Controller::getModel('municipios')->getMunicipiosJSON($data);
        header('Content-Lenght: '.strlen($municipios));
        echo $municipios;
    }

}