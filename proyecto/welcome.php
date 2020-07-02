<?php 

require_once "DAO/InfoDao.php";
use DAO\InfoDao as IO;

session_start();
if(isset($_SESSION['loggedUser'])){
	include('header.php'); 
	include('nav.php'); 
	if(!isset($_GET["pagina"])){
		$_GET["pagina"]=1;
	}
	
	
	$dao = new IO();
	$art_x_pag=10;
	$total = $dao->getRowCount();
	$pages = $total/$art_x_pag;
	$pages = ceil($pages);

	$iniciar=($_GET["pagina"]-1)*$art_x_pag;

	$values = $dao->getRow4Page($iniciar,$art_x_pag);
	
	
?>
<div class="container mt-5">
	<h2 style="text-align: center;" class="mb-5">Informacion del sensor</h2>
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
	<nav aria-label="Page navigation example">
		<ul class="pagination">
			<li class="page-item <?php if($_GET['pagina']<=1){  echo 'disabled';}else{ echo '';} ?>"><a class="page-link" href="<?php echo FRONT_ROOT?>welcome.php?pagina=<?php echo $_GET['pagina']-1?>">Previous</a></li>
			<?php for($i=0;$i<$pages;$i++){ ?>
			<li class="page-item <?php if($_GET['pagina']==$i+1){  echo 'active';}else{ echo '';} ?>" ><a class="page-link" href="<?php echo FRONT_ROOT?>welcome.php?pagina=<?php echo $i+1; ?>"><?php echo $i+1; ?></a></li>
			<?php } ?>
			<li class="page-item <?php if($_GET['pagina']>=$pages){  echo 'disabled';}else{ echo '';} ?>"><a class="page-link" href="<?php echo FRONT_ROOT?>welcome.php?pagina=<?php echo $_GET['pagina']+1?>" >Next</a></li>
		</ul>
	</nav>

	

	

	
	
</div>
<?php }else{
	echo "<script> if(confirm('El usuario esta fuera de sesion, debe volver a loguearse.'));";
	echo "window.location = 'index.php';
		</script>";
}

?>


<?php 
include('footer.php')
?>