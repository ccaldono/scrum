<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class EjemploController extends AppController
{

    public function index()
    {
        View::template('index');
    	$this->titulo ='Inicia sesion';
        $this->subtitulo ='necesitamos tu nickname y contraseña';
    }
}
