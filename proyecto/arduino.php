<?php 
    require_once "DAO/InfoDao.php";
    require_once "Controllers/EmailController.php";
    require_once "Controllers/DateTimeController.php";
    use Controllers\EmailController as EC;
    use Controllers\DateTimeController as DTC;
    use DAO\InfoDao as IFD;
    

    if( isset($_GET['distancia'])){


        $distancia = $_GET["distancia"];
        
        $dao = new IFD();
        $dtc = new DTC();
        $emailController = new EC();

        $dao->add($distancia);
        $fecha = $dtc->getActualDate();
        $hora = $dtc->getActualTime();
        $emailController->sendEmail($distancia,$fecha,$hora);


    }else{ 
        echo "datos incorrectos";
    }