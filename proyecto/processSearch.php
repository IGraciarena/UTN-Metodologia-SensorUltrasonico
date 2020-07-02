<?php
require_once  dirname(__DIR__) ."/proyecto/DAO/InfoDao.php";
require_once  dirname(__DIR__) ."/proyecto/Config/Config.php";
use DAO\InfoDao as IO;
session_start();
if($_POST){
    $dao = new IO();
    $fecha = $_POST["searchDate"];
    $_SESSION["fecha"]= $fecha;
    $total = $dao->getCountRow4PageByDate($fecha);
    // $_SESSION["fecha"]=$fecha;
     if(!$total){
         echo "<script> if(confirm('No hay datos para esas fechas'));";
         echo "window.location = 'welcome.php';
             </script>";
     }
    include_once("search.php");
    //header("location:../search.php");
}
?>