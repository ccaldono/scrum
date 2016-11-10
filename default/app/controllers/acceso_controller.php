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
            $pwd=  sha1($pwd);
            $contra=substr($pwd, 0, -30);
            //$pwd = substr($pwd, 0, -30);
            
            $auth = new Auth("model", "class: usuarios", "correo: $correo", "contrasena: $contra");
            if ($auth->authenticate()) {
                Router::redirect("usuarios/index");
                echo $pwd;
            } else {
                Flash::error("Usuario no disponible en la base de datasos");
             
            }
        }
        
    }
}
?>