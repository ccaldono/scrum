<?php
class AcercaController extends AppController {
   
    public function index(){
   	 // Selecciona el template 'mi_template.phtml'
   	 
    	$this->titulo ='Acerca de:';
        $this->subtitulo ='SCRUMSY';
    }
  }