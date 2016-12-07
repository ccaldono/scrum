<?php
Load:: models('proyecto','usuarios');
/**
 * Controller por defecto si no se usa el routes
 * 
 */
class IndexController extends AppController
{

    public function index()
    {
        Auth::destroy_identity();
        View::template('index');
        $this->titulo ='Login:';
        $this->subtitulo ='';
           
        if (Input::hasPost("correo","contrasena")){
            $pwd = Input::post("contrasena");
            $correo=Input::post("correo");
            $pwd=  sha1($pwd);
            $auth = new Auth("model", "class: usuarios", "correo: $correo", "contrasena: $pwd");
            if ($auth->authenticate()) {
               $usuarios= new Usuarios();
                $user=$usuarios->consultarUsuario($correo);
                Router::redirect("saludo/index/$user->id");                 
            } else {
                Flash::error("Usuario o contraseña incorrectos");
               
            }
        }
    
    }
}
