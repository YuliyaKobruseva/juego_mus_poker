<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Carta
 *
 * @author Yuli
 */
class Carta {
    private $palo;
    private $nombre;
    private $valor;

    function __construct($palo, $nombre, $valor) {
        $this->palo = $palo;
        $this->nombre = $nombre;
        $this->valor = $valor;
    }
    
    function __get($atributo) {
        if (property_exists('Carta', $atributo)) {
            return $this->$atributo;
        } else {
            throw new Exception('Propiedad Desconocida');
        }
    }

    function __set($atributo, $valor) {
        if (!empty($valor)) {
            if (property_exists($this, $atributo)) {
                $this->$atributo = $valor;
            } else {
                throw new Exception('Propiedad Desconocida');
            }
        } else {
            throw new Exception('Valor vacío');
        }
    }
}
