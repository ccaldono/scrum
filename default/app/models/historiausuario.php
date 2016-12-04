<?php
class Historiausuario extends ActiveRecord{
    

    public function getHistorias($page, $ppage=20)
    {
        return $this->paginate("page: $page","per_page: $ppage");
        
    }
    public function consultarHistoria($id){
        $condition="select * from historiausuario where proyecto_id= '$id'";
        return $this->paginate_by_sql($condition, 'per_page: 5', 'page: 1');
    }
}