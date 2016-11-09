<?php
class accesoController extends AppController {
    public function index(){
   	 // Selecciona el template 'mi_template.phtml'
   	 View::template('index');
    	$this->titulo ='Inicia sesion';
        $this->subtitulo ='necesitamos tu nickname y contraseña';
         if (Input::hasPost("correo","contrasena")){
            $pwd = Input::post("contrasena");
            $correo=Input::post("correo");
 
            $auth = new Auth("model", "class: usuarios", "correo: $correo", "contrasena: $pwd");
            if ($auth->authenticate()) {
                Router::redirect("usuarios/index");
            } else {
                Flash::error("Usuario no disponible en la base de datos");
               
            }
        }
        
    }
}
?>