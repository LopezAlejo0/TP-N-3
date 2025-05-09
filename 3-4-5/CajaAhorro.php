<?php
    class CajaAhorro extends Cuenta {
        // Constructor
        public function __construct ($objCliente, $nroCuenta, $saldoCuenta) {
            parent :: __construct ($objCliente, $nroCuenta, $saldoCuenta);
        }

        // A String
        public function __toString () {
            return parent :: __toString ();
        }
    }
?>