<?php
     Class ProductoImportado extends Producto {
        private $incremento;
        private $impuesto;
        // Constructor
        public function __construct ($codBarra, $descripcion, $stock, $porcentajeIva, $precioCompra, $objRubro) {
            parent :: __construct ($codBarra, $descripcion, $stock, $porcentajeIva, $precioCompra, $objRubro);
            $this -> incremento = 50;
            $this -> impuesto = 10;
        }

        // Getters
        public function getIncremento () {
            return $this -> incremento;
        }

        public function getImpuesto () {
            return $this -> impuesto;
        }

        // Setters
        public function setIncremento ($porcentajeIncremento) {
            $this -> incremento = $porcentajeIncremento;
        }

        public function setImpuesto ($porcentajeImpuesto) {
            $this -> impuesto = $porcentajeImpuesto;
        }

        // A String
        public function __toString () {
            return parent :: __toString () . "\nPorcentaje de incremento: %" . $this -> getIncremento () . 
                   "\nPorcentaje de impuesto: %" . $this -> getImpuesto ();
        }

        // Propias de la clase

        /**
         * Calcula el precio de venta "base" de un producto y lo incrementa un 50%. Posteriormente, se le agrega un impuesto del 10% sobre el valor obtenido
         * @return float
         */
        public function calcularPrecioVenta () {
            $precioVenta = parent :: darPrecioVenta ();
            return $precioVenta + ($precioVenta * ($this -> getIncremento () / 100)) + ($precioVenta * ($this -> getImpuesto () / 100));
        }
    }
?>