<?php
    include_once 'Persona.php';
    include_once 'Cliente.php';
    include_once 'Banco.php';
    include_once 'Cuenta.php';
    include_once 'CuentaCorriente.php';
    include_once 'CajaAhorro.php';

    $miBanco = new Banco ();

    $cliente1 = new Cliente ("Alejo", "Lopez", "43.597.626", "4758");
    $cliente2 = new Cliente ("Genoveva", "Ottaviano", "25.597.255", "5433");

    $miBanco -> incorporarCliente ($cliente1);
    $miBanco -> incorporarCliente ($cliente2);

    $cuentaCorriente1 = $miBanco -> incorporarCuentaCorriente ($cliente1 -> getNroCliente (), 3000);
    $cuentaCorriente2 = $miBanco -> incorporarCuentaCorriente ($cliente2 -> getNroCliente (), 1500);

    $cajaAhorro1 = $miBanco -> incorporarCajaAhorro ($cliente1 -> getNroCliente ());
    $cajaAhorro2 = $miBanco -> incorporarCajaAhorro ($cliente1 -> getNroCliente ());
    $cajaAhorro3 = $miBanco -> incorporarCajaAhorro ($cliente2 -> getNroCliente ());

    $miBanco -> realizarDeposito ($cajaAhorro1 -> getNroCuenta (), 300);
    $miBanco -> realizarDeposito ($cajaAhorro2 -> getNroCuenta (), 300);
    $miBanco -> realizarDeposito ($cajaAhorro3 -> getNroCuenta (), 300);

    if ($miBanco -> realizarRetiro ($cuentaCorriente2 -> getNroCuenta (), 150)) {
        $miBanco -> realizarDeposito ($cajaAhorro3 -> getNroCuenta (), 150);
    }

    echo $miBanco;
?>