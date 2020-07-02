<?php 
//require_once "../Models/ClassUser.php";
//require_once "../Config/Config.php";
//require_once "../Controllers/ViewsController.php";
//use Models\ClassUser as User;
//use Controllers\ViewsController as VC;

//$users = array();

//$user1 = new User('admin', 'admin', 'Georgie', 'Soler', 'geges@utn.com');


$loggedUser = NULL;
if($_POST){
	
	
		if($_POST['userName'] == 'admin'){
			echo 'hola';
			if($_POST['password'] == 'admin'){
				$loggedUser = 'admin';
			}
		}
	
}
if($loggedUser != NULL){
	session_start();
	$_SESSION['loggedUser'] = $loggedUser;
	//$vc = new VC();
	//$vc->home();
	header("location:welcome.php");
	//include_once(ROOT."welcome.php");
	
}else{
	echo "<script> if(confirm('Verifique que los datos ingresados sean correctos'));";
	echo "window.location = '../index.php';
		</script>";
}

	

 ?>