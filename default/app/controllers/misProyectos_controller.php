<?php
Load:: models('proyecto');
class MisProyectosController extends AppController {
   
    public function index($page=1){
   	 // Selecciona el template 'mi_template.phtml'
   	 
    	$this->titulo ='Mis proyectos:';
        $this->subtitulo ='';
        $proyecto= new Proyecto();
        $this->listProyectos=$proyecto->getProyectos($page);
    }
 }  