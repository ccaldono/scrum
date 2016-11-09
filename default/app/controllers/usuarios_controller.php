<?php

Load:: models('usuarios');
class UsuariosController extends AppController{
    public function index($page=1){
        $this->titulo ='Acerca de:';
        $this->subtitulo ='SCRUMSY';
        $usuario= new Usuarios();
        $this->listUsuarios=$usuario->getUsuarios($page);
    }
    public function saludo(){
        $this->titulo ='Acerca de:';
        $this->subtitulo ='SCRUMSY';
        
    }
    public function registrarUsuario(){
        View::template('registro');
        $this->titulo ='Nuevo usuario:';
        $this->subtitulo ='';
        if(Input::hasPost('usuario')){
            /**
             * se le pasa al modelo por constructor los datos del form y ActiveRecord recoge esos datos
             * y los asocia al campo correspondiente siempre y cuando se utilice la convención
             * model.campo
             */
            $usuario = new Usuarios(Input::Post('usuario'));
            
           
            //En caso que falle la operación de guardar
            if(!$usuario ->save()){
                Flash::error('Falló Operación');
                //se hacen persistente los datos en el formulario
                $this->usuarios = Input::Post('usuario');
                /**
                 * NOTA: para que la autocarga aplique de forma correcta, es necesario que llame a la variable de instancia
                 * igual como esta el model de la vista, en este caso el model es "menus" y quedaria $this->menus
                 */
            }else{
                Flash::success('Operación exitosa');
               Router::redirect("saludo");
                
                     
            }
        }
    }
    
}


