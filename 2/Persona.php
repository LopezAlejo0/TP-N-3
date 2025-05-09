<?php
    class Persona {
        private $nombre;
        private $apellido;
        private $nroDni;

        // Constructor
        public function __construct ($nombre, $apellido, $nroDni) {
            $this -> nombre = $nombre;
            $this -> apellido = $apellido;
            $this -> nroDni = $nroDni;
        }

        // Getters
        public function getNombre () {
            return $this -> nombre;
        }

        public function getApellido () {
            return $this -> apellido;
        }

        public function getNroDni () {
            return $this -> nroDni;
        }

        // Setters
        public function setNombre ($unNombre) {
            $this -> nombre = $unNombre;
        }

        public function setApellido ($unApellido) {
            $this -> apellido = $unApellido;
        }

        public function setNroDni ($unNroDni) {
            $this -> nroDni = $unNroDni;
        }

        // A String
        public function __toString () {
            return "Nombre: " . $this -> getNombre () .
                   "\nApellido: " . $this -> getApellido () . 
                   "\nNúmero de documento: " . $this -> getNroDni ();
        }
    }
?>