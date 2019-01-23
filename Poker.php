<?php

require_once 'Francesa.php';
require_once 'Jugador.php';
require_once 'TraitJuego.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Poker
 *
 * @author Yuli
 */
class Poker {

//put your code here
//baraja francesa
    private $baraja;
    public $jugadores = array();
    use juegoTools;

    function __construct(Jugador $j1, Jugador $j2) {
        $this->baraja = new Francesa();
        $args = func_get_args();
        if (func_num_args() >= 2) {
            for ($i = 0; $i < func_num_args(); $i++) {
                array_push($this->jugadores, $args[$i]);
            }
        }
    }

    function setJugadores(Jugador $j) {        
        $args = func_get_args();
        for ($i = 0; $i < func_num_args(); $i++) {
            array_push($this->jugadores, $args[$i]);
        }
    }

    function jugar() {
        $this->baraja->barajar();
        $quantityCard = 5;
        while ($quantityCard > 0) {
            foreach ($this->jugadores as $jugador) {
                $cartaJugador = $this->baraja->repartir();
                $jugador->cartas = $cartaJugador;
            }
            $quantityCard--;
        }
    }

    function jugada(Array $cartasJugador) {
        print_r($cartasJugador);
        $jugada = "";
        $valoresCartasJugador = array();
        $palosCartasJugador = array();
        $nombresCartasJugador = array();
        foreach ($cartasJugador as $carta) {
            array_push($valoresCartasJugador, $carta->valor);
            array_push($palosCartasJugador, $carta->palo);
            array_push($nombresCartasJugador, $carta->nombre);
        }

        $repetidosNombres = array_count_values($nombresCartasJugador);
        $repetidosPalos = array_count_values($palosCartasJugador);

        $isConsecutive = $this->isConsecutive($cartasJugador);

        if (in_array(2, $repetidosNombres) && count($repetidosNombres) == 4) {
            $jugada = "Par";
        } elseif ((in_array(2, $repetidosNombres) && count($repetidosNombres) == 3) || (in_array(4, $repetidosNombres) &&
                count($repetidosNombres) == 2)) {
            $jugada = "Doble Par";
        } elseif (in_array(3, $repetidosNombres) && count($repetidosNombres) == 3) {
            $jugada = "Trio/Set";
        } elseif (in_array(3, $repetidosNombres) && in_array(2, $repetidosNombres)) {
            $jugada = "Full House";
        } elseif (in_array(4, $repetidosNombres)) {
            $jugada = "Poker";
        } elseif (count($repetidosPalos) == 1 && array_sum($valoresCartasJugador) == 41) {
            $jugada = "Escalera Real";
        } elseif (count($repetidosNombres) == 5 && (array_sum($valoresCartasJugador) == 15 || array_sum($valoresCartasJugador) == 20 ||
                array_sum($valoresCartasJugador) == 25 || array_sum($valoresCartasJugador) == 30 || array_sum($valoresCartasJugador) == 35 ||
                array_sum($valoresCartasJugador) == 40 || array_sum($valoresCartasJugador) == 44 || array_sum($valoresCartasJugador) == 37 ||
                array_sum($valoresCartasJugador) == 49) && $isConsecutive) {
            $jugada = "Escalera";
        } elseif (count($repetidosPalos) == 1 && count($repetidosNombres) == 5) {
            $jugada = "Color";
        } elseif (count($repetidosNombres) == 5 && count($repetidosPalos) == 1 && (array_sum($valoresCartasJugador) == 15 || array_sum($valoresCartasJugador) == 20 ||
                array_sum($valoresCartasJugador) == 25 || array_sum($valoresCartasJugador) == 30 || array_sum($valoresCartasJugador) == 35 ||
                array_sum($valoresCartasJugador) == 40 || array_sum($valoresCartasJugador) == 44 || array_sum($valoresCartasJugador) == 37 ||
                array_sum($valoresCartasJugador) == 49) && $isConsecutive) {
            $jugada = "Escalera de Color";
        } else {
            $jugada = "Carta Alta";
        }
        return $jugada;
    }

    function isConsecutive(Array $cartasJugador) {
        $newValorCarta = array();
        foreach ($cartasJugador as $carta) {
            if (is_string($carta->nombre)) {
                if ($carta->nombre == "J") {
                    array_push($newValorCarta, 11);
                } elseif ($carta->nombre == "Q") {
                    array_push($newValorCarta, 12);
                } elseif ($carta->nombre == "K") {
                    array_push($newValorCarta, 13);
                }
            } else {
                array_push($newValorCarta, $carta->valor);
            }
        }
        print_r($newValorCarta);
        for ($i = 0; $i < count($newValorCarta); $i++) {
            if (isset($newValorCarta[$i + 1]) && $newValorCarta[$i] + 1 != $newValorCarta[$i + 1]) {
                return false;
            }
        }
        return true;
    }

}

$jugarPoker = new Poker(new Jugador("Yuliya"), new Jugador("Marvin"));
$jugarPoker->setJugadores(new Jugador("Oriol"), new Jugador("Mireia"));
$jugarPoker->jugar();
echo "<pre>";
print_r($jugarPoker->jugadores);
print_r($jugarPoker->jugada($jugarPoker->jugadores[0]->cartas));
print_r($jugarPoker->puntos($jugarPoker->jugadores[0]->cartas));
echo "</pre>";


