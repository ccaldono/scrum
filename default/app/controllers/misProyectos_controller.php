<?php
Load:: models('proyecto');
class MisProyectosController extends AppController {
   
    public function index($page=1){
   	 // Selecciona el template 'mi_template.phtml'
   	 
    	$this->titulo ='Mis proyectos:';
        $this->subtitulo ='';
        $proyecto= new Proyecto();
        $this->listProyectos=$proyecto->getProyectos($page);
    }
    public function mostar($id){
   	 // Selecciona el template 'mi_template.phtml'
   	 
    	$this->titulo ='Mis proyectos:';
        $this->subtitulo ='';
        $proyecto= new Proyecto();
        $this->listProyectos=$proyecto->getProyectos($page);
    }
    public function edit($id)
    {
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
        }
    }
 }  