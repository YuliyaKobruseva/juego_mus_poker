<?php

require_once 'Baraja.php';
require_once 'Carta.php';

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Francesa
 *
 * @author Yuli
 */
class Francesa extends Baraja {
    
    private $nombrePalos = ["Corazon", "Pica", "Diamante", "Trebol"];
    private $numeros = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, "J", "Q", "K"];

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
//$barajaFr = new Francesa();
//var_dump($barajaFr->cartas);
//echo "</pre>";
