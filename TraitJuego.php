<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TraitJuego
 *
 * @author Yuli
 */
trait juegoTools {

    public function puntos(Array $cartasJugador) {
        $puntos = 0;
        foreach ($cartasJugador as $carta) {
            $puntos += $carta->valor;
        }
        
        return $puntos;
    }

}
