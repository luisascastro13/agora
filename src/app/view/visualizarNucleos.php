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

	    	<div class="row pb-5 mb-4 mt-sm-3">
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
    
<?php } ?>
</body>
</html>