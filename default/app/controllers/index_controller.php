<?php

/**
 * Controller por defecto si no se usa el routes
 * 
 */
class IndexController extends AppController
{

    public function indexito()
    {
        View::template('index');
    	$this->titulo ='Inicia sesion';
        $this->subtitulo ='';
    }
    
    public function index()
	{
        View::template('index');
        $this->titulo ='Login:';
        $this->subtitulo ='';
           
        if (Input::hasPost("correo","contrasena")){
            $pwd = Input::post("contrasena");
            $correo=Input::post("correo");
            $pwd=  sha1($pwd);
            $contra=substr($pwd, 0, -30);
 
            $auth = new Auth("model", "class: usuarios", "correo: $correo", "contrasena: $contra");
            if ($auth->authenticate()) {
                Router::redirect("usuarios/index");
            } else {
                Flash::error("Usuario no disponible en la base de datos");
                 echo $contra;
            }
        }
    
        }
}
