<?php namespace Controllers;
    use DAO\InfoDao as InfoDao;

class ViewsController{

    private $infoDao;

    public function _construct(){
        //hola
        $this->infoDao = new InfoDao();
    }

    public function grilla(){

        $info = $infoDao->getAll();
        require_once(VIEWS_PATH."grilla.php");
    }
   
}