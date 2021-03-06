<?php
require_once '../dao/Usuario.dao.php';
require_once '../dao/Nucleo.dao.php';
require_once '../model/Usuario.class.php';

$conn =  new Conexao();

if (!$conn) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
else {
	// $_SESSION['conn'] = $conn;
	$usuario = new Usuario($_SESSION['username'], $_SESSION['nomecompleto'], null, null);
	
?>

<!DOCTYPE html>
<html>
<?php include('template/head.php'); ?>

<body>
<!-- container grandao da pagina -->
<div class="container-fluid m-0 p-0">

	<!-- TELA TODA -->
    <div class="row p-0 m-0">

		<?php include('template/navbarPequenos.php'); ?>
		<?php include('template/navbarGrandes.php'); ?>	

        <!-- CONTEÚDO DA PÁGINA -->
	    <div id="pagina" class="container-fluid pl-md-4">

	    	<!-- Modal NOVO NUCLEO-->
			<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Inserir novo núcleo</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>

						<div class="modal-body">
							<!-- inserir novo nucleo-->
							<form method="post" action='../controller/Nucleo.controller.php?a=inserir'>
							<!-- inserir novo nucleo -->
							<label>Nome:</label>
							<input type="text" name="nome">
						</div>

						<div class="modal-footer">	      
							<input type='submit' class="btn btn-primary">
							</form>
						</div>
					</div>
				</div>
			</div>


	    	<div class="pb-5 mb-4 mt-sm-3">

			    <div class="col-12 col-md-8 col-lg-5">		    		
		    		<div class="d-flex justify-content-between">	
		    			<!-- novo nucleo Button trigger modal -->    		
						<button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">Inserir novo núcleo</button>
					</div>
				</div>


			    <div class="col-12 col-md-8 col-lg-5">	    		

					<div>
					<!-- listar todos nucleos que o usuario está na lista-->
					<?php $i=0;
					foreach (array_reverse(NucleoDAO::listarNucleoUsuarioParticipa()) as $val)
						{?>
						<tr class="">
							<td><a href="visualizarNucleo.php?id=<?=$val['id']?>" class="d-block btn btn-warning text-truncate text-left mt-1" ><?= $val['nome'] ?></a></td>
						</tr>
						<?php } ?>
					</div>
				</div>
			</div>		    

		<!-- fecha o conteudo da pagina -->
		</div>

	<!-- fecha a row da tela toda -->
    </div>
<!-- fecha o container grandao da pagina     -->
</div>


<!-- botões nucleo -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
<?php } ?>
</body>
</html>