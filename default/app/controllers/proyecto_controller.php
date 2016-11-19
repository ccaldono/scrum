<?php

Load:: models('proyecto');
class ProyectoController extends AppController{
    
    
    public function index($page=1) 
    {
       
        if(Auth::is_valid()){
            $this->titulo ='Mis proyectos:';
        $this->subtitulo ='.i.';
        $proyecto = new Proyecto();
        $this->listProyectos = $proyecto->getProyectos($page);
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
    public function crearProyecto ()
    {
        if(Auth::is_valid()){
            View::template('miTemplate');
            $this->titulo ='Crear nuevo proyecto:';
            $this->subtitulo ='';
            if(Input::hasPost('proyecto')){



                $proyecto = new Proyecto(Input::Post('proyecto'));
                //En caso que falle la operación de guardar
                if(!$proyecto->save()){
                    Flash::error('Falló Operación');               
                    //se hacen persistente los datos en el formulario
                    $this->proyecto = Input::Post('proyecto');
                    /**
                     * NOTA: para que la autocarga aplique de forma correcta, es necesario que llame a la variable de instancia
                     * igual como esta el model de la vista, en este caso el model es "menus" y quedaria $this->menus
                     */
                }else{
                    Flash::success('Operación exitosa');
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
                     Flash::valid('Operación exitosa');
                    //enrutando por defecto al index del controller
                    return Redirect::to();
                } else {
                    Flash::error('Falló Operación');
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
    
}
