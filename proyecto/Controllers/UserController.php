<?php namespace Controllers;

use Controllers\ViewsController as VC;
use Models\User as User;
class UserController{
    private $view;


    public function __construct(){
        $this->view = new VC();
    }

    public function login($user,$pass){
        
    }
}