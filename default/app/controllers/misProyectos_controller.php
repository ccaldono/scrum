<?php
Load:: models('proyecto');
class MisProyectosController extends AppController {
   
    public function index($page=1){
   	// Selecciona el template 'mi_template.phtml'
   	if(Auth::is_valid()){ 
            $this->titulo ='Mis proyectos:';
            $this->subtitulo ='';
           
            $proyecto= new Proyecto();
            $this->listProyectos=$proyecto->getProyectos($page);
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
            $proyecto = new proyecto();

            //se verifica si se ha enviado el formulario (submit)
            if(Input::hasPost('proyecto')){

                if($proyecto->update(Input::post('proyecto'))){
                     Flash::valid('<font color="green">Operación exitosa</font>');
                    //enrutando por defecto al index del controller
                    return Redirect::to();
                } else {
                    Flash::error('<font color="red">Falló Operación</font>');
                }
            } else {
                //Aplicando la autocarga de objeto, para comenzar la edición
                $this->proyecto = $proyecto->find_by_id((int)$id);
            }
        }else{
            //Redirect::to('../scrum/index');
            echo "<br/><h1>" . "ERROR! no has iniciado sesión." . "</h1>";
            echo "Solo usuarios registrados pueden acceder a esta página." . "<br/>";
            echo "<br/><h2>" . "<a href='../index'>Iniciar sesión</a>"."</h2>";
            exit;
        }
    }
 }  
