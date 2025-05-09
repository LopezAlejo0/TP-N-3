<?php
    Class ProductoRegional extends Producto {
        private $porcentajeDescuento;

        // Constructor
        public function __construct ($codBarra, $descripcion, $stock, $porcentajeIva, $precioCompra, $objRubro, $porcentajeDescuento) {
            parent :: __construct ($codBarra, $descripcion, $stock, $porcentajeIva, $precioCompra, $objRubro);
            $this -> porcentajeDescuento = $porcentajeDescuento;
        }

        // Get
        public function getPorcentajeDescuento () {
            return $this -> porcentajeDescuento;
        }

        // Set
        public function setPorcentajeDescuento ($unDescuento) {
            $this -> porcentajeDescuento = $unDescuento;
        }

        // A String
        public function __toString () {
            return parent :: __toString () . "\nPorcentaje de descuento: %" . $this -> getPorcentajeDescuento ();
        }

        // Propias de la clase

        /**
         * Calcula el precio de venta y le aplica el descuento correspondiente
         * @return float
         */
        public function darPrecioVenta () {
            $precioVenta = parent :: darPrecioVenta ();
            return $precioVenta * (1 - $this -> getPorcentajeDescuento () / 100);
        }
    }
?>