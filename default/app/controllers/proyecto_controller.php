<?php

Load:: models('proyecto');
class ProyectoController extends AppController{
    
    
    public function index($page=1) 
    {
        $this->titulo ='Acerca de:';
        $this->subtitulo ='SCRUMSY';
        $proyecto = new Proyecto();
        $this->listProyectos = $proyecto->getProyectos($page);
    }
 
    /**
     * Crea un Registro
     */
    public function crearProyecto ()
    {
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
