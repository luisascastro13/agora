<?php
require_once '../dao/Usuario.dao.php';
require_once '../dao/Nucleo.dao.php';
require_once '../model/Usuario.class.php';
require_once '../dao/Reuniao.dao.php';
require_once '../model/Nucleo.class.php';


$conn =  new Conexao();

if (!$conn) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
} else {
	
	// $_SESSION['conn'] = $conn;
	$usuario = new Usuario($_SESSION['username'], $_SESSION['nomecompleto'], null, null);
	
	// echo $usuario->getNome() . '<br>'. $usuario->getLogin();

	if(isset($_GET['msg'])){
		switch($_GET['msg']){
			case '1':
			echo "<script>alert('Já existe núcleo com esse nome. Tente outro.')</script>";
		}
	}

	$dataAtual = date('d-m-Y');

	$reunioes = ReuniaoDAO::buscarProximasReunioes();
	// echo '<pre>';
	// print_r($reunioes);
	// echo '</pre>';
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
	    <div id="pagina" class="container-fluid pl-md-4 pt-3 mb-4 pb-5">

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

		    <!-- botões nucleo -->
		    <div class="row">
			    <div class="col-12 col-md-8 col-lg-5">		    		
		    		<div class="d-flex justify-content-between">	
		    			<!-- novo nucleo Button trigger modal -->    		
						<button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">Inserir novo núcleo</button>
						<a href="visualizarNucleos.php" type="button" class="btn btn-primary btn-sm">Ver todos</a>
					</div>

					<div>
					<!-- listar todos nucleos que o usuario está na lista-->
					<?php $i=0;
					foreach (array_reverse(NucleoDAO::listarNucleoUsuarioParticipa()) as $val)
						{?>
						<tr class="">
							<td><a href="visualizarNucleo.php?id=<?=$val['id']?>" class="d-block btn btn-warning text-truncate text-left mt-1" ><?= $val['nome'] ?></a></td>
						</tr>
						<?php
						if (++$i >= 3)
   							break;
						} ?>
					</div>

					



			    </div>
			    <div class="col-12 col-md-4 col-lg-4">

			    	<?php $res = ReuniaoDAO::buscarProximasReunioes();

			    	if(count($res) != 0){ 
			    	?><span class="fs-3 fw-bold">Próximas reuniões</span>
			    	<?php }	?>

			    	
			    	<div class="row">						
                        <?php $i=0;
                        foreach(ReuniaoDAO::buscarProximasReunioes() as $r){

							$data = date_create($r['data']);
							$dataFormatada = date_format($data, 'd/m/Y à\s H:i');

							$somenteData = date_format($data, 'd/m/Y');
							$somenteHorario = date_format($data, 'H:i');

							$idNucleo = $r['id_nucleo'];
							$nucleo = NucleoDAO::buscarPorId($idNucleo);
							$objNucleo = new Nucleo($nucleo[0]['nome']);
							$objNucleo->setId($nucleo[0]['id']);		                      	

                        	?>

                            <div class="col-sm-12 col-lg-12 my-2">

                            	<div class="card border border-primary">
                            		<div class="card-header d-flex justify-content-between pb-0 mb-0">
                            			<h5 class="fs-5"><a href="visualizarReuniao.php?id=<?=$r['codigo']?>"><?=$r['nome']?></a></h5>
                            			<h5 class="text-muted fs-6"><?=$r['nomenucleo']?></h5>
                            		</div>								
								  <div class="card-body">

								  	<div class="d-inline">
									  	<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="blue" class="bi bi-calendar-event" viewBox="0 0 16 16">
											<path d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1z"/>
											<path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
										</svg>										
										<h6 class="d-inline p-2"><?=$somenteData?></h6>
									</div>

									<div class="d-inline m-3">
									  	<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="blue" class="bi bi-clock" viewBox="0 0 16 16">
											<path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
											<path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"/>
										</svg>
									    <h6 class="d-inline p-2"><?=$somenteHorario?></h6>
									</div>
								    

								    <p class="card-text mt-2"><?=$r['descricao']?></p>

								  </div>
								</div>


                            
                            </div>

                        <?php 
                      	if (++$i >= 3) break;
						} ?>
                     

					</div>
			    </div>

		<!-- fecha o conteudo da pagina -->
		</div>

	<!-- fecha a row da tela toda -->
    </div>
<!-- fecha o container grandao da pagina     -->
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

<!-- MDB -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.2.0/mdb.min.js"
></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10">
</script>

</body>
</html>
<?php } ?>