<?php namespace Models;
    
    class ClassInfo {
        
        //ATRIBUTES
        private $distancia;
        private $fecha;
        private $hora;

        //CONSTRUCTOR
        public function __construct($distancia,$fecha,$hora){
            $this->distancia = $distancia;
            $this->fecha = $fecha;
            $this->hora = $hora;
        }

    public function getDistancia(){
        return $this->distancia;
    }
    public function getFecha(){
        return $this->fecha;
    }
    public function getHora(){
        return $this->hora;
    }
}

?>