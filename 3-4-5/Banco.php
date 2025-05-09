<?php
    class Banco {
        private $coleccionClientes;
        private $coleccionCuentasCorrientes;
        private $coleccionCajasAhorro;
        private $ultimoValorCuentaAsignado;

        // Constructor
        public function __construct () {
            $this -> coleccionClientes = [];
            $this -> coleccionCuentasCorrientes = [];
            $this -> coleccionCajasAhorro = [];
            $this -> ultimoValorCuentaAsignado = 0;
        }

        // Getters
        public function getColeccionClientes () {
            return $this -> coleccionClientes;
        }

        public function getColeccionCuentasCorrientes () {
            return $this -> coleccionCuentasCorrientes;
        }

        public function getColeccionCajasAhorro () {
            return $this -> coleccionCajasAhorro;
        }

        public function getUltimoValorCuentaAsignado () {
            return $this -> ultimoValorCuentaAsignado;
        }

        // Setters
        public function setColeccionClientes ($unaColeccion) {
            $this -> coleccionClientes = $unaColeccion;
        }

        public function setColeccionCuentasCorrientes ($unaColeccion) {
            $this -> coleccionCuentasCorrientes = $unaColeccion;
        }

        public function setColeccionCajasAhorro ($unaColeccion) {
            $this -> coleccionCajasAhorro = $unaColeccion;
        }

        public function setUltimoValorCuentaAsignado ($unValor) {
            $this -> ultimoValorCuentaAsignado = $unValor;
        }

        // A String
        public function __toString () {
            $mensajeClientes = "Lista de clientes\n";
            $mensajeClientes .= "---------------------\n";
            $i = 0;
            foreach ($this -> getColeccionClientes () as $cliente) {
                $mensajeClientes .= "- Cliente  " . $i + 1 . "\n" . $cliente . "\n";
                $i ++;
            }
            $mensajeCuentasCorrientes = "Lista de cuentas corrientes\n";
            $mensajeCuentasCorrientes .= "---------------------\n";
            $i = 0;
            foreach ($this -> getColeccionCuentasCorrientes () as $cuentaCorriente) {
                $mensajeCuentasCorrientes .= "- Cuenta corriente  " . $i + 1 . "\n" . $cuentaCorriente . "\n";
                $i ++;
            }
            $mensajeCajasAhorro = "Lista de cajas de ahorro\n";
            $mensajeCajasAhorro .= "---------------------\n";
            $i = 0;
            foreach ($this -> getColeccionCajasAhorro () as $cajaAhorro) {
                $mensajeCajasAhorro .= "- Caja de ahorro  " . $i + 1 . "\n" . $cajaAhorro . "\n";
                $i ++;
            }
            return $mensajeClientes . "\n" .
                   $mensajeCuentasCorrientes . "\n" . 
                   $mensajeCajasAhorro . "\nÚltimo valor de cuenta asignado: " . $this -> getUltimoValorCuentaAsignado ();
        }

        // Propias de la clase

        /**
         * Recibe un cliente y lo agrega a la colección de clientes del banco
         * @param Cliente $objCliente
         * @return void
         */
        public function incorporarCliente ($objCliente) {
            $colClientes = $this -> getColeccionClientes ();
            array_push ($colClientes, $objCliente);
            $this -> setColeccionClientes ($colClientes);
        }

        /**
         * Recibe un número de cliente y monto descubierto para que en caso de que el número recibido pertenezca al banco, se agregue una cuenta corriente
         * @param int $numeroCliente
         * @param int $montoDescubierto
         * @return CuentaCorriente
         */
        public function incorporarCuentaCorriente ($numeroCliente, $montoDescubierto) {
            $colClientes = $this -> getColeccionClientes ();
            $cantClientes = count ($colClientes);
            $colCuentasCorrientes = $this -> getColeccionCuentasCorrientes ();
            $encontrado = false;
            $i = 0;
            do {
                $cliente = $colClientes [$i];
                $numCliente = $cliente -> getNroCliente ();
                if ($numCliente == $numeroCliente) {
                    $encontrado = true;
                    $this -> setUltimoValorCuentaAsignado ($this -> getUltimoValorCuentaAsignado () + 1);
                    $nuevaCuenta = new CuentaCorriente ($cliente, $this -> getUltimoValorCuentaAsignado (), 0, $montoDescubierto);
                    array_push ($colCuentasCorrientes, $nuevaCuenta);
                    $this -> setColeccionCuentasCorrientes ($colCuentasCorrientes);
                }
                $i ++;
            } while ($i < $cantClientes && !$encontrado);
            return $nuevaCuenta;
        }

        /**
         * Recibe un número de cliente para que en caso de que el número recibido pertenezca al banco, se agregue una caja de ahorro
         * @param int $numeroCliente
         * @param int $montoDescubierto
         * @return CajaAhorro
         */
        public function incorporarCajaAhorro ($numeroCliente) {
            $colClientes = $this -> getColeccionClientes ();
            $cantClientes = count ($colClientes);
            $colCajasAhorro = $this -> getColeccionCajasAhorro ();
            $encontrado = false;
            $i = 0;
            do {
                $cliente = $colClientes [$i];
                $numCliente = $cliente -> getNroCliente ();
                if ($numCliente == $numeroCliente) {
                    $encontrado = true;
                    $this -> setUltimoValorCuentaAsignado ($this -> getUltimoValorCuentaAsignado () + 1);
                    $nuevaCuenta = new CajaAhorro ($cliente, $this -> getUltimoValorCuentaAsignado (), 0);
                    array_push ($colCajasAhorro, $nuevaCuenta);
                    $this -> setColeccionCajasAhorro ($colCajasAhorro);
                }
                $i ++;
            } while ($i < $cantClientes && !$encontrado);
            return $nuevaCuenta;
        }

        /**
         * Recibe un número de cuenta y un monto para depositar. Si el número pertenece al banco, se realiza el deposito
         * @param int $numCuenta
         * @param int $monto
         * @return boolean
         */
        public function realizarDeposito ($numCuenta, $monto) {
            $colCuentas = array_merge ($this -> getColeccionCajasAhorro (), $this -> getColeccionCuentasCorrientes ());
            $cantCuentas = count ($colCuentas);
            $i = 0;
            $encontrado = false;
            do {
                $cuenta = $colCuentas [$i];
                $nroCuenta = $cuenta -> getNroCuenta ();
                if ($nroCuenta == $numCuenta) {
                    $cuenta -> realizarDeposito ($monto);
                    $encontrado = true;
                }
                $i ++;
            } while ($i < $cantCuentas && !$encontrado);
            return $encontrado;
        }

        /**
         * Recibe un número de cuenta y un monto para depositar. Si el número pertenece al banco, se realiza el retiro
         * @param int $numCuenta
         * @param int $monto
         * @return boolean
         */
        public function realizarRetiro ($numCuenta, $monto) {
            $colCuentas = array_merge ($this -> getColeccionCajasAhorro (), $this -> getColeccionCuentasCorrientes ());
            $cantCuentas = count ($colCuentas);
            $i = 0;
            $encontrado = false;
            do {
                $cuenta = $colCuentas [$i];
                $nroCuenta = $cuenta -> getNroCuenta ();
                if ($nroCuenta == $numCuenta) {
                    $retiroRealizado = $cuenta -> realizarRetiro ($monto);
                    $encontrado = true;
                }
                $i ++;
            } while ($i < $cantCuentas && !$encontrado);
            return $encontrado;
        }
    }
?>