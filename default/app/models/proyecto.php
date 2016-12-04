<?php
class Proyecto extends ActiveRecord{
    

    public function getProyectos($page, $ppage=20)
    {
        return $this->paginate("page: $page","per_page: $ppage");
        
    }
     protected function initialize()
    {
         $this->validates_presence_of("nombre");
         $this->validates_presence_of("descripcion");
         $this->validates_presence_of("fechaInicio");
         $this->validates_presence_of("fechaFin");
    }
    public function consultar($page=1,$id){
        //return $this->find('columns: proyecto.id,historiausuario.descripcion,historiausuario.prioridad,historiausuario.esfuerzo',
          //                 'join: inner join historiausuario on proyecto.id = historiausuario.idproyecto');
        //return 
        //$this->find_by_sql('select * from historiausuario where proyecto_id="$id"');
        
    }
}

