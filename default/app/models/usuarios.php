<?php

class Usuarios extends ActiveRecord{
    
    
    
    public function getUsuarios($page, $ppage=20)
    {
        return $this->paginate("page: $page","per_page: $ppage");
    }
    
    protected function initialize()
    {
         $this->validates_presence_of("nombre");
         $this->validates_presence_of("apellido");
         $this->validates_email_in("correo");
         $this->validates_presence_of("correo");
         $this->validates_uniqueness_of("correo");
         $this->validates_presence_of("contrasena");
         //$this->validates_length_of("contrasena", 16,6);
         
         
    }
    	
  }

