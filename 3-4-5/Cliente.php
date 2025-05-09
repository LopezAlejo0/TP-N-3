<?php
    class Cliente extends Persona {
        private $nroCliente;

        // Constructor
        public function __construct ($nombre, $apellido, $nroDni, $nroCliente) {
            parent :: __construct ($nombre, $apellido, $nroDni);
            $this -> nroCliente = $nroCliente;
        }

        // Get
        public function getNroCliente () {
            return $this -> nroCliente;
        }

        // Set
        public function setNroCliente ($unNroCliente) {
            $this -> nroCliente = $unNroCliente;
        }

        // A String
        public function __toString () {
            $mensaje = parent :: __toString ();
            $mensaje .= "\nNúmero de cliente: " . $this -> getNroCliente ();
            return $mensaje;
        }
    }
?>