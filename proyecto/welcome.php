<?php 
include('header.php'); 
include('nav.php'); 
require_once "DAO/InfoDao.php";
use DAO\InfoDao as IO;

session_start();
if(isset($_SESSION['loggedUser'])){
    $user = $_SESSION['loggedUser'];

    $dao = new IO();
    $values = $dao->getAll();
	
?>
<div class="container mt-5">
	<h2 style="text-align: center;">Informacion del sensor</h2>
	<table class="table table-bordered table-striped">
		<thead class="thead-dark">
			<tr>
				<th scope="col">Distancia</th>
				<th scope="col">Fecha</th>
                <th scope="col">Hora</th>
			</tr>
		</thead>
		<tbody>

			<?php foreach($values as $value){ ?>
                <tr>
                    <td ><?php echo $value->getDistancia(); ?></td>
                    <td ><?php echo $value->getFecha();?></td>
                    <td ><?php echo $value->getHora();?></td>
                </tr>
                <?php } ?>
			
		</tbody>
	</table>

		<form action="process/cambio.php" method="post">
		<div class="row">
		<div class="col-md-2" >
			<button name="do" value="salir" class="btn btn-danger" >Salir</button>
		</div>
		
	</div>
	</form>

	

	
	
</div>
<?php }else{
	echo "<script> if(confirm('El usuario esta fuera de sesion, debe volver a loguearse.'));";
	echo "window.location = '../index.php';
		</script>";
}

?>


<?php 
include('footer.php')
?>