<?php

require_once 'Espanyola.php';
require_once 'TraitJuego.php';
require_once 'Jugador.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Mus
 *
 * @author Yuli
 */
class Mus {

    //put your code here
    //baraja española
    use juegoTools;
    private $baraja;
    public $jugadores = array();

    function __construct() {
        $this->baraja = new Espanyola();
    }

    function __set($name, $value) {
        if (property_exists($this, $name)) {
            $this->$name = $value;
        } else {
            throw new Exception('Propiedad desconocida');
        }
    }

    function jugar() {
        $this->baraja->barajar();
        $quantityCard = 4;
        while ($quantityCard > 0) {
            foreach ($this->jugadores as $jugador) {
                $cartaJugador = $this->baraja->repartir();
                $jugador->cartas = $cartaJugador;
            }
            $quantityCard--;
        }
    }

    function pares(Array $cartasJugador) {
        $pares="";
        $nombreCartasJugador = array();
        foreach ($cartasJugador as $carta) {
            array_push($nombreCartasJugador, $carta->nombre);
        }

        $repetidos = array_count_values($nombreCartasJugador);
        if (in_array(2, $repetidos)) {
            if (count($repetidos) == 2) {
                $pares = "Duplex";
            } else {
                $pares = "Pares";
            }
        } elseif (in_array(3, $repetidos)) {
            $pares = "Medias";
        } elseif (in_array(4, $repetidos)) {
            $pares = "Duplex";
        }else{
            $pares = "Carta Alta";
        }
//        print_r($repetidos);
//        print_r(count($repetidos));
        return $pares;
    }

}

$jugarMus = new Mus();
$jugarMus->jugadores = [new Jugador("Yuliya"), new Jugador("Marvin"), new Jugador("Mireia"), new Jugador("Oriol")];
$jugarMus->jugar();
print_r($jugarMus->jugadores);
print_r($jugarMus->pares($jugarMus->jugadores[0]->cartas));
