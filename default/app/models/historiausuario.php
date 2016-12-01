<?php
class Historiausuario extends ActiveRecord{
    

    public function getHistorias($page, $ppage=20)
    {
        return $this->paginate("page: $page","per_page: $ppage");
        
    }
}