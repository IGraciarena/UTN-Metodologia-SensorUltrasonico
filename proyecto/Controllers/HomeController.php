<?php
    namespace Controllers;
    use Controllers\ViewsController as VC;

    class HomeController
    {
        private $views;

        public function __construct(){
            $this->views = new VC();
        }

        public function Index($message = "")
        {
            require_once(VIEWS_PATH."nav.php");
            $views->grilla();
        }        
    }
?>