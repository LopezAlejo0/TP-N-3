<?php
    class Cuenta {
        private $objCliente;
        private $nroCuenta;
        private $saldoCuenta;

        // Constructor
        public function __construct ($objCliente, $nroCuenta, $saldoCuenta) {
            $this -> objCliente = $objCliente;
            $this -> nroCuenta = $nroCuenta;
            $this -> saldoCuenta = $saldoCuenta;
        }

        // Getters
        public function getObjCliente () {
            return $this -> objCliente;
        }

        public function getNroCuenta () {
            return $this -> nroCuenta;
        }

        public function getSaldoCuenta () {
            return $this -> saldoCuenta;
        }

        // Setters
        public function setObjCliente ($unaCliente) {
            $this -> objCliente = $unaCliente;
        }

        public function setNroCuenta ($unNro) {
            $this -> nroCuenta = $unNro;
        }

        public function setSaldoCuenta ($unSaldo) {
            $this -> saldoCuenta = $unSaldo;
        }

        // A String
        public function __toString () {
            return "Datos del dueño de la cuenta: " . $this -> getObjCliente () .
                   "\nNúmero de cuenta: " . $this -> getNroCuenta () .  
                   "\nSaldo de la cuenta: $" . $this -> getSaldoCuenta ();
        }

        // Propias de la clase

        /**
         * Recibe un monto para depositar en la cuenta
         * @param int $monto
         * @return void
         */
        public function realizarDeposito ($monto) {
            $this -> setSaldoCuenta ($this -> getSaldoCuenta () + $monto);
        }

        /**
         * Recibe un monto para retirar de la cuenta. Si no es posible realizar el retiro, se retorna false
         * @param int $monto
         * @return boolean
         */
        public function realizarRetiro ($monto) {
            $retiro = false;
            $saldo = $this -> getSaldoCuenta ();
            if ($saldo >= $monto) {
                $this -> setSaldoCuenta ($saldo - $monto);
                $retiro = true;
            }
            return $retiro;
        }
    }
?>