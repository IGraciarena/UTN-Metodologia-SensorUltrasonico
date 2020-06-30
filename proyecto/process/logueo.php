<?php namespace process;
require_once "../Models/ClassUser.php";
use Models\ClassUser as User;

$users = array();

$user1 = new User('admin', 'admin', 'Georgie', 'Soler', 'geges@utn.com');


$loggedUser = NULL;
if($_POST){
	
	
		if($_POST['userName'] == $user1->getUserName()){
			if($_POST['password'] == $user1->getPassword()){
				$loggedUser = $user1;
			}
		}
	
}
if($loggedUser != NULL){
	session_start();
	$_SESSION['loggedUser'] = $loggedUser;
	header("location:../welcome.php");
	
}else{
	echo "<script> if(confirm('Verifique que los datos ingresados sean correctos'));";
	echo "window.location = '../index.php';
		</script>";
}

	

 ?>