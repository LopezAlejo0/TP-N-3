<?php
    Class Rubro {
        private $descripcion;
        private $porcentajeGanancia;

        // Constructor
        public function __construct ($descripcion, $porcentajeGanancia) {
            $this -> descripcion = $descripcion;
            $this -> porcentajeGanancia = $porcentajeGanancia;
        }

        // Getters
        public function getDescripcion () {
            return $this -> descripcion;
        }

        public function getPorcentajeGanancia () {
            return $this -> porcentajeGanancia;
        }

        // Setters
        public function setDescripcion ($unaDescripcion) {
            $this -> descripcion = $unaDescripcion;
        }

        public function setPorcentajeGanancia ($unPorcentaje) {
            $this -> porcentajeGanancia = $unPorcentaje;
        }

        // A String
        public function __toString () {
            return "Descripción: " . $this -> getDescripcion () . 
                   "\nPorcentaje de ganancia: " . $this -> getPorcentajeGanancia ();
        }
    }
?>