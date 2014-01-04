<?php
class opendata extends Controller {
    
    public function opendata(){
        $this->loadModel('municipios');
        header('Content-Type: application/json; charset=UTF-8');
        header('Access-Control-Allow-Origin: *');
    }
    
    public function index($data = ''){
    }
    
    public function infomunicipios($data) {
        $municipios = Controller::getModel('municipios')->getMunicipiosJSON($data);
        header('Content-Lenght: '.strlen($municipios));
        echo $municipios;
    }
    
    public function encuestas($data) {
        $encuestas = Controller::getModel('municipios')->getEncuestas($data);
        echo $data;
    }

}