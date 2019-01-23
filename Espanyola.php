<?php

require_once 'Baraja.php';
require_once 'Carta.php';

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Espanyola
 *
 * @author Yuli
 */
class Espanyola extends Baraja {
    
    private $nombrePalos = ["Espada", "Basto", "Oro", "Copa"];
    private $numeros = [1, 2, 3, 4, 5, 6, 7, "Sota", "Caballo", "Rey"];

    function __construct() {
        $pos = 0;
        foreach ($this->nombrePalos as $palo) {
            foreach ($this->numeros as $num) {
                if (is_int($num)) {
                    $this->cartas[$pos] = new Carta($palo, $num, $num);
                } else {
                    $this->cartas[$pos] = new Carta($palo, $num, 10);
                }
                $pos++;
            }
        }
    }

    public function reiniciar() {  
        $this->cartas = $this->restart;
    }

}

//echo "<pre>";
//$barajaEsp = new Espanyola();
//var_dump($barajaEsp->cartas);
//echo "</pre>";
