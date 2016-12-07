<?php

Load:: models('proyecto','historiausuario','usuarios');
class ProyectoController extends AppController{
    
    
    public function index($id) 
    {
       
        if(Auth::is_valid()){
            $this->titulo ='Mis proyectos:';
            $this->subtitulo ='';
            $this->id=$id;            
            $usuarios= new Usuarios();
             $user=$usuarios->consultarNombres($id);               
            $this->nombre=$user->nombre;
            $this->apellido=$user->apellido;
        $proyecto = new Proyecto();
        $this->listProyectos = $proyecto->getProyectos($page=1);
        }else{
            //Redirect::to('../scrum/index');
            echo "<br/><h1>" . "ERROR! no has iniciado sesión." . "</h1>";
            echo "Solo usuarios registrados pueden acceder a esta página." . "<br/>";
            echo "<br/><h2>" . "<a href='../index'>Iniciar sesión</a>"."</h2>";
            exit;
        }

    }
     
    /**
     * Crea un Registro
     */
    public function crearProyecto ($id)
    {
        if(Auth::is_valid()){
            View::template('miTemplate');
            $this->titulo ='Crear nuevo proyecto:';
            $this->subtitulo ='';
            $this->id=$id;
            $usuarios= new Usuarios();
             $user=$usuarios->consultarNombres($id);               
            $this->nombre=$user->nombre;
            $this->apellido=$user->apellido;
            if(Input::hasPost('proyecto')){
                $temporal=  Input::Post('proyecto');
                $p_nombre=  $temporal['nombre'];
                


                $proyecto = new Proyecto(Input::Post('proyecto'));
                //En caso que falle la operación de guardar
                if(!$proyecto->save()){
                    Flash::error('<font color = "red">Falló operación</font>');   
                    //se hacen persistente los datos en el formulario
                    $this->proyecto = Input::Post('proyecto');
                    /**
                     * NOTA: para que la autocarga aplique de forma correcta, es necesario que llame a la variable de instancia
                     * igual como esta el model de la vista, en este caso el model es "menus" y quedaria $this->menus
                     */
                }else{                   
                    
                    Flash::success('<font color = "green">Operación exitosa</font>');
                    Router::redirect("proyecto/index/$id");
                }
            }
        }else{
            //Redirect::to('../scrum/index');
            echo "<br/><h1>" . "ERROR! no has iniciado sesión." . "</h1>";
            echo "Solo usuarios registrados pueden acceder a esta página." . "<br/>";
            echo "<br/><h2>" . "<a href='../index'>Iniciar sesión</a>"."</h2>";
            exit;
        }
    }
    
  public function edit($id)
    {

        if(Auth::is_valid()){
             $this->titulo ='Editando el proyecto:';
             //$this->proyecto = $proyecto->find_by_id((int)$id);
            $proyecto = new proyecto();

            //se verifica si se ha enviado el formulario (submit)
            if(Input::hasPost('proyecto')){

                if($proyecto->update(Input::post('proyecto'))){
                     Flash::valid('<font color = "green">Operación exitosa</font>');
                    //enrutando por defecto al index del controller
                    return Redirect::to();
                } else {
                    Flash::error('<font color = "red">Falló operación </font>');
                }
            } else {
                //Aplicando la autocarga de objeto, para comenzar la edición
                 $this->proyecto = $proyecto->find_by_id((int)$id);
                 $this->subtitulo =$this->proyecto->nombre;
            }


        }else{
            //Aplicando la autocarga de objeto, para comenzar la edición
            $this->proyecto = $proyecto->find_by_id((int)$id);
             $this->subtitulo =$this->proyecto->nombre;
             //Redirect::to('../scrum/index');
            echo "<br/><h1>" . "ERROR! no has iniciado sesión." . "</h1>";
            echo "Solo usuarios registrados pueden acceder a esta página." . "<br/>";
            echo "<br/><h2>" . "<a href='../index'>Iniciar sesión</a>"."</h2>";
            exit;
        }
    }
    
    public function view($id)
    {

        if(Auth::is_valid()){
             $this->titulo ='Detalles del proyecto:';
             
            // $this->subtitulo ='hola';
             //$this->proyecto = $proyecto->find_by_id((int)$id);
           
              $proyecto = new Proyecto();
                 $this->proyecto = $proyecto->find_by_id((int)$id);
                 $this->subtitulo =$this->proyecto->nombre;
                // $this->inner=$proyecto->consultar((int)$id);
                 $historiausuario= new Historiausuario();
                 $this->historia=$historiausuario->consultarHistoria((int)$id);
                 
                 
        }else{
            //Aplicando la autocarga de objeto, para comenzar la edición
            $this->proyecto = $proyecto->find_by_id((int)$id);
             $this->subtitulo =$this->proyecto->nombre;
             //Redirect::to('../scrum/index');
            echo "<br/><h1>" . "ERROR! no has iniciado sesión." . "</h1>";
            echo "Solo usuarios registrados pueden acceder a esta página." . "<br/>";
            echo "<br/><h2>" . "<a href='../index'>Iniciar sesión</a>"."</h2>";
            exit;
        }
    }
    
}
