<?php
class accesoController extends AppController {
    public function index(){
   	 // Selecciona el template 'mi_template.phtml'
   	View::template('index');
    	$this->titulo ='Inicia sesion';
        $this->subtitulo ='necesitamos tu nickname y contraseña';
    }
}
?>