<?php

Load:: models('usuarios');
class UsuariosController extends AppController{
    public function index($page=1){
        if(Auth::is_valid()){
            $this->titulo ='Acerca de:';
            $this->subtitulo ='SCRUMSY';
            $usuario= new Usuarios();
            $this->listUsuarios=$usuario->getUsuarios($page);
        }else{
            //Redirect::to('../scrum/index');
            echo "<br/><h1>" . "ERROR! no has iniciado sesión." . "</h1>";
            echo "Solo usuarios registrados pueden acceder a esta página." . "<br/>";
            echo "<br/><h2>" . "<a href='../index'>Iniciar sesión</a>"."</h2>";
            exit;
        }
    }
    
    public function saludo(){
        if(Auth::is_valid()){
            $this->titulo ='Acerca de:';
            $this->subtitulo ='SCRUMSY';
        }else{
            //Redirect::to('../scrum/index');
            echo "<br/><h1>" . "ERROR! no has iniciado sesión." . "</h1>";
            echo "Solo usuarios registrados pueden acceder a esta página." . "<br/>";
            echo "<br/><h2>" . "<a href='../index'>Iniciar sesión</a>"."</h2>";
            exit;
        }        
    }
    
    public function registrarUsuario(){
        Auth::destroy_identity();
        View::template('registro');
        $this->titulo ='Nuevo usuario:';
        $this->subtitulo ='';
        if(Input::hasPost('usuario')){
            /**
             * se le pasa al modelo por constructor los datos del form y ActiveRecord recoge esos datos
             * y los asocia al campo correspondiente siempre y cuando se utilice la convención
             * model.campo
             */
            $temporal=  Input::Post('usuario');
             $cadena2="contrasena";
             $contraTemporal=$temporal['contrasena'];
             $longitudContra=  strlen($contraTemporal);
             if($longitudContra<6 or $longitudContra >16 ){             
              //Flash::error('La contraseña debe tener minimo 6 caracteres, maximo 16');
               Flash::error('<font color = "red">La contraseña debe tener minimo 6 caracteres, maximo 16</font>');
                //se hacen persistente los datos en el formulario
                $this->usuarios = Input::Post('usuario');             
             }
             else{
             $contraTemporal=sha1($contraTemporal); 
             $temporal['contrasena']=$contraTemporal;
             
             $usuario = new Usuarios($temporal);
             
                if(!$usuario ->save()){
                    Flash::error('<font color = "red">Falló operación</font>');
                    //se hacen persistente los datos en el formulario
                    $this->usuarios = Input::Post('usuario');
                    /**
                     * NOTA: para que la autocarga aplique de forma correcta, es necesario que llame a la variable de instancia
                     * igual como esta el model de la vista, en este caso el model es "menus" y quedaria $this->menus
                     */
                }else{
                    $auth = new Auth("model", "class: usuarios", "correo: $usuario->correo", "contrasena: $usuario->contrasena");                    
                    if ($auth->authenticate()) {
                        Router::redirect("saludo");                      
                    } else {
                    }                        Flash::error('<font color = "red">Usuario no disponible en la base de datos</font>');

                }
            }
        }
    }
    
}


