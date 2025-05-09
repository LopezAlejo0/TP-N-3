<?php
    class Local {
        private $coleccionProductos;
        private $coleccionProductosImportados;
        private $coleccionProductosRegionales;
        private $coleccionVentas;

        // Constructor
        public function __construct ($coleccionProductos, $coleccionProductosImportados, $coleccionProductosRegionales, $coleccionVentas) {
            $this -> coleccionProductos = $coleccionProductos;
            $this -> coleccionProductosImportados = $coleccionProductosImportados;
            $this -> coleccionProductosRegionales = $coleccionProductosRegionales;
            $this -> coleccionVentas = $coleccionVentas;
        }

        // Getters
        public function getColeccionProductos () {
            return $this -> coleccionProductos;
        }

        public function getColeccionProductosImportados () {
            return $this -> coleccionProductosImportados;
        }

        public function getColeccionProductosRegionales () {
            return $this -> coleccionProductosRegionales;
        }

        public function getColeccionVentas () {
            return $this -> coleccionVentas;
        }

        // Setters
        public function setColeccionProductos ($unaColeccion) {
            $this -> coleccionProductos = $unaColeccion;
        }

        public function setColeccionProductosImportados ($unaColeccion) {
            $this -> coleccionProductosImportados = $unaColeccion;
        }

        public function setColeccionProductosRegionales ($unaColeccion) {
            $this -> coleccionProductosRegionales = $unaColeccion;
        }

        public function setColeccionVentas ($unaColeccion) {
            $this -> coleccionVentas = $unaColeccion;
        }

        // A String
        public function __toString () {
            $mensajeProductos = "Lista de productos disponibles\n";
            $mensajeProductos .= "---------------------\n";
            $i = 0;
            foreach ($this -> getColeccionProductos () as $producto) {
                $mensajeProductos .= "- Producto  " . $i + 1 . "\n" . $producto . "\n";
                $i ++;
            }
            $mensajeImportados = "Lista de productos importados disponibles\n";
            $mensajeImportados .= "---------------------\n";
            $i = 0;
            foreach ($this -> getColeccionProductosImportados () as $producto) {
                $mensajeImportados .= "- Producto importado " . $i + 1 . "\n" . $producto . "\n";
                $i ++;
            }
            $mensajeRegionales = "Lista de productos regionales disponibles\n";
            $mensajeRegionales .= "---------------------\n";
            $i = 0;
            foreach ($this -> getColeccionProductosRegionales () as $producto) {
                $mensajeRegionales .= "- Producto regional  " . $i + 1 . "\n" . $producto . "\n";
                $i ++;
            }
            $mensajeVentas = "Lista de ventas\n";
            $mensajeVentas .= "---------------------\n";
            $i = 0;
            foreach ($this -> getColeccionVentas () as $venta) {
                $mensajeVentas .= "- Venta  " . $i + 1 . "\n" . $venta . "\n";
                $i ++;
            }
            return $mensajeProductos . "\n" . $mensajeImportados . "\n" . $mensajeRegionales . "\n" . $mensajeVentas;
        }

        // Propias de la clase

        /**
         * Recibe un producto y verifica a través de su código de barra que no se encuentre dentro de la colección.
         * Si no se encuentra, se agrega y retorna true. Caso contrario, retorna false
         * @param Producto $objProducto
         * @return boolean
         */
        public function incorporarProductoLocal ($objProducto) {
            $codBarraProducto = $objProducto -> getCodBarra ();
            $colProductos = $this -> getColeccionProductos ();
            $cantProductos = count ($colProductos);
            $i = 0;
            $repetido = false;
            do {
                $producto = $colProductos [$i];
                $codigoBarra = $producto -> getCodBarra ();
                if ($codBarraProducto == $codigoBarra) {
                    $repetido = true;
                }
                $i ++;
            } while ($i < $cantProductos && !$repetido);
            if (!$repetido) {
                array_push ($colProductos, $producto);
                $this -> setColeccionProductos ($colProductos);
            }
            return !$repetido;
        }

        /**
         * Recibe un código de producto para buscarlo dentro de la colección y calcular su precio de venta para retornarlo. Si no se encuentra, retorna -1
         * @param String $codProducto
         * @return float
         */
        public function retornarImporteProducto ($codProducto) {
            $colProductos = $this -> getColeccionProductos ();
            $cantProductos = count ($colProductos);
            $i = 0;
            $precioVenta = - 1;
            $realizado = false;
            do {
                $producto = $colProductos [$i];
                $codigoBarra = $producto -> getCodBarra ();
                if ($codProducto == $codigoBarra) {
                    $precioVenta = $producto -> darPrecioVenta ();
                    $realizado = true;
                }
            } while ($i < $cantProductos && !$realizado);
            return $precioVenta;
        }

        /**
         * Recorre todos los productos de la tienda y retorna la suma de los costos de cada producto teniendo en cuenta el stock de cada uno
         * @return float
         */
        public function retornarCostoProductoLocal () {
            $colProductos = $this -> getColeccionProductos ();
            $cantProductos = count ($colProductos);
            $costoTotal = 0;
            if ($colProductos != []) {
                foreach ($colProductos as $producto) {
                    $costoConStock = $producto -> getPrecioCompra () * $producto -> getStock ();
                    $costoTotal += $costoConStock;
                }
            }
            return $costoTotal;
        }

        /**
         * Recibe un rubro y retorna el producto más económico de dicho rubro
         * @param Rubro $unRubro
         * @return null|Producto
         */
        public function productoMasEconomico ($unRubro) {
            $colProductos = $this -> getColeccionProductos ();
            $precioEconomico = 9999999999;
            $productoEconomico = null;
            foreach ($colProductos as $producto) {
                $rubroProducto = $producto -> getObjRubro ();
                if ($rubroProducto == $unRubro) {
                    $precioProducto = $producto -> darPrecioVenta ();
                    if ($precioProducto < $precioEconomico) {
                        $productoEconomico = $producto;
                    }
                }
            }
            return $productoEconomico;
        }

        /**
         * 
         */
        public function informarProductosMasVendidos ($anio, $n) {
            // Filtar las ventas por año
            $colVentas = $this -> getColeccionVentas ();
            $colVentasAnio = [];
            foreach ($colVentas as $venta) {
                $fechaVenta = $venta -> getFecha ();
                $anioVenta = $fechaVenta -> format("Y");
                if ($anioVenta == $anio) {
                    array_push ($colVentasAnio, $venta);
                }
            }

            // Contar los productos vendidos
            foreach ($colVentasAnio as $venta) {
                $colProductos = $venta -> getColeccionProductos ();
                foreach ($colProductos as $producto) {
                    
                }
            }
        }
    }
?>