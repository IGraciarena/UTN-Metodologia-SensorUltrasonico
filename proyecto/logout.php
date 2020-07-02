<?php 
    session_start();
    unset($_SESSION['loggedUser']);
    //unset($_SESSION['fecha']);
    //$_SESSION[""]
    
    header("location:index.php");



?>