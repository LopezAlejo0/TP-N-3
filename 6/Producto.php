<?php
    class Producto {
        private $codBarra;
        private $descripcion;
        private $stock;
        private $porcentajeIva;
        private $precioCompra;
        private $objRubro;

        // Constructor
        public function __construct ($codBarra, $descripcion, $stock, $porcentajeIva, $precioCompra, $objRubro) {
            $this -> codBarra = $codBarra;
            $this -> descripcion = $descripcion;
            $this -> stock = $stock;
            $this -> porcentajeIva = $porcentajeIva;
            $this -> precioCompra = $precioCompra;
            $this -> objRubro = $objRubro;
        }

        // Getters
        public function getCodBarra () {
            return $this -> codBarra;
        }

        public function getDescripcion () {
            return $this -> descripcion;
        }

        public function getStock () {
            return $this -> stock;
        }

        public function getPorcentajeIva () {
            return $this -> porcentajeIva;
        }

        public function getPrecioCompra () {
            return $this -> precioCompra;
        }

        public function getObjRubro () {
            return $this -> objRubro;
        }

        // Setters
        public function setCodBarra ($codigo) {
            $this -> codBarra = $codigo;
        }

        public function setDescripcion ($unaDescripcion) {
            $this -> descripcion = $unaDescripcion;
        }

        public function setStock ($unStock) {
            $this -> stock = $unStock;
        }

        public function setPorcentajeIva ($unIva) {
            $this -> porcentajeIva = $unIva;
        }

        public function setPrecioCompra ($unPrecio) {
            $this -> precioCompra = $unPrecio;
        }

        public function setObjRubro ($unRubro) {
            $this -> objRubro = $unRubro;
        }

        // A String
        public function __toString () {
            return "Código de barra: " . $this -> getCodBarra () . 
                   "\nDescripción: " . $this -> getDescripcion () . 
                   "\nStock: " . $this -> getStock () . " unidades" . 
                   "\nPorcentaje de IVA: %" . $this -> getPorcentajeIva () . 
                   "\nPrecio de compra: $" . $this -> getPrecioCompra () . 
                   "\nDatos del rubro:\n" . $this -> getObjRubro ();
        }

        // Propias de la clase

        /**
         * Calcula el precio de venta del producto dado el precio de compra, el porcentaje de IVA y el porcentaje de ganancia del rubro al que pertenece
         * @return float
         */
        public function darPrecioVenta () {
            $rubro = $this -> getObjRubro ();
            return ($this -> getPrecioCompra () * (1 + $rubro -> porcentajeGanancia () / 100) * (1 + $this -> getPorcentajeIva () / 100));
        }
    }
?>