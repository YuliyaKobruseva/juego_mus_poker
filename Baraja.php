<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Baraja
 *
 * @author Yuli
 */
abstract class Baraja {

    protected $cartas = [];
    protected $restart;

    function barajar() {
        shuffle($this->cartas);
    }

    function __get($nameVar) {
        if(property_exists('Baraja', $nameVar)){
            return $this->$nameVar;
        }else{
            throw new Exception('Propiedad desconocida');
        }
    }

    function repartir() {
        $this->restart = $this->cartas;
        $primeraCarta = array_shift($this->cartas); //quita y mueve array        
        return $primeraCarta;
    }

    abstract function reiniciar();
}
