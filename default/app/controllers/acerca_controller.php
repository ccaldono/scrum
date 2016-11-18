<?php
class AcercaController extends AppController {
   
    public function index(){
   	 // Selecciona el template 'mi_template.phtml'
   	if(Auth::is_valid()){ 
            $this->titulo ='Acerca de:';
            $this->subtitulo ='SCRUMSY';
        }else{
            //Redirect::to('../scrum/index');
            echo "<br/><h1>" . "ERROR! no has iniciado sesión." . "</h1>";
            echo "Solo usuarios registrados pueden acceder a esta página." . "<br/>";
            echo "<br/><h2>" . "<a href='index'>Iniciar sesión</a>"."</h2>";
            exit;
        }
    }
  }