<?php
    class CuentaCorriente extends Cuenta {
        private $montoDescubierto;

        // Constructor
        public function __construct ($objCliente, $nroCuenta, $saldoCuenta, $montoDescubierto) {
            parent :: __construct ($objCliente, $nroCuenta, $saldoCuenta);
            $this -> montoDescubierto = $montoDescubierto;
        }

        // Get
        public function getMontoDescubierto () {
            return $this -> montoDescubierto;
        }

        // Set
        public function setMontoDescubierto ($unMonto) {
            $this -> montoDescubierto = $unMonto;
        }

        // A String
        public function __toString () {
            $mensaje = parent :: __toString ();
            $mensaje .= "\nMonto descubierto: $" . $this -> getMontoDescubierto ();
            return $mensaje;
        }

        // Propias de la clase

        /**
         * Recibe un monto para retirar de la cuenta. En caso de no ser posible, retorna false
         * @param int $monto
         * @return boolean
         */
        public function realizarRetiro ($monto) {
            $retiro = false;
            $saldo = parent :: getSaldoCuenta ();
            $montoTotal = $this -> getMontoDescubierto () + $saldo;
            if ($montoTotal >= $monto) {
                parent :: setSaldoCuenta ($saldo - $monto);
                $retiro = true;
            }
            return $retiro;
        }
    }
?>