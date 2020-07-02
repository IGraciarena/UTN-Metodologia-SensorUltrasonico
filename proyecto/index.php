<?php
 
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	
	require "Config/Autoload.php";
	//require "Config/Config.php";


	session_start();
	//session_destroy();
	include('header.php'); 
	include('nav.php'); 
	//var_dump($_SESSION);
	if(!isset($_SESSION['loggedUser'])){
	 ?>
   
		<main class="d-flex align-items-center justify-content-center height-100">
			 <div class="content">
				  <header style="margin-top:80px;"class="text-center">
					   <h2>Arduino UTN</h2>
				  </header>
				  <form action="logueo.php" method="post" class="login-form bg-dark-alpha p-5 text-white">
					   <div class="form-group">
							<label for="">User Name</label>
							<input type="text" name="userName" class="form-control form-control-lg" placeholder="Ingresar usuario">
					   </div>
					   <div class="form-group">
							<label for="">Password</label>
							<input type="password" name="password" class="form-control form-control-lg" placeholder="Ingresar constraseña">
					   </div>
					   <button class="btn btn-dark btn-block btn-lg" type="submit">Iniciar Sesión</button>
				  </form>
   
				  <br>
				 
			 </div>
			 
		</main>
   
   <?php
	
	include('footer.php'); 
	}else{
		header("location:welcome.php");
	}
   ?>
   
?>