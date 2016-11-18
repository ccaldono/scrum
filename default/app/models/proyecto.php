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
}

