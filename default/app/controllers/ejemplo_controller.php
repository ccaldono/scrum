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
        if(Auth::is_valid()){
            View::template('index');
            $this->titulo ='Inicia sesion';
            $this->subtitulo ='necesitamos tu nickname y contraseña';
        }else{
            //Redirect::to('../scrum/index');
            echo "<br/><h1>" . "ERROR! no has iniciado sesión." . "</h1>";
            echo "Solo usuarios registrados pueden acceder a esta página." . "<br/>";
            echo "<br/><h2>" . "<a href='index'>Iniciar sesión</a>"."</h2>";
            exit;
        }
    }
}
