<?php
class InicioController extends AppController {
    public function index(){
        Auth::destroy_identity();
        View::template("templateInicio");
   }  
}