<?php

header('Content-Type: application/json');

class opendata extends Controller {
    
    public function opendata(){
        $this->loadModel('municipios');
    }
    
    public function index($data = ''){
    }
    
    public function infomunicipios($data) {
        $municipios = Controller::getModel('municipios')->getMunicipiosJSON($data);
        echo $municipios;
    }
    
}