<?php
    class Venta {
        private $fecha;
        private $coleccionProductos;
        private $nombreCliente;

        // Constructor
        public function __construct ($fecha, $nombreCliente) {
            $this -> fecha = $fecha;
            $this -> nombreCliente = $nombreCliente;
            $this -> coleccionProductos = [];          
        }

        // Getters
        public function getFecha () {
            return $this -> fecha;
        }

        public function getColeccionProductos () {
            return $this -> coleccionProductos;
        }

        public function getNombreCliente () {
            return $this -> nombreCliente;
        }

        // Setters
        public function setFecha ($unaFecha) {
            $this -> fecha = $unaFecha;
        }

        public function setColeccionProductos ($unaColeccion) {
            $this -> coleccionProductos = $unaColeccion;
        }

        public function setNombreCliente ($unNombre) {
            $this -> nombreCliente = $unNombre;
        }

        // A String
        public function __toString () {
            $mensaje = "Lista de productos\n";
            $mensaje .= "---------------------\n";
            $i = 0;
            foreach ($this -> getColeccionProductos () as $producto) {
                $mensaje .= "- Producto  " . $i + 1 . "\n" . $producto . "\n";
                $i ++;
            }
            return "Fecha de la venta: " . $this -> getFecha () . "\n" . $mensaje . "\nNombre del cliente: " . $this -> getNombreCliente ();
        }

        // Propias de la clase

        /**
         * Calcula el importe total de la venta sumando los precios de venta al público de cada producto correspondiente a la venta
         * @return float
         */
        public function darImporteVenta () {
            $importeVenta = 0;
            $colProductos = $this -> getColeccionProductos ();
            if ($colProductos != []) {
                foreach ($colProductos as $producto) {
                    $precioVentaProducto = $producto -> darPrecioVenta ();
                    $importeVenta += $precioVentaProducto;
                }
            }
            return $importeVenta;
        }
    }
?>