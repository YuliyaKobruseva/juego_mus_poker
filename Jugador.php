<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Jugador
 *
 * @author Yuli
 */
class Jugador {

    private $nombre;
    private $cartas;

    function __construct(String $nombre) {
        $this->nombre = $nombre;
        $this->cartas = array();
    }

    function __get($name) {
        if (property_exists('Jugador', $name)) {
            return $this->$name;
        } else {
            throw new Exception('Propiedad desconocida');
        }
    }

    function __set($name, $value) {
         if ($name == "cartas") {
            array_push($this->cartas, $value);
        }elseif (property_exists($this, $name)) {
            $this->$name = $value;
        } else {
            throw new Exception('Propiedad desconocida');
        }
    }
}
