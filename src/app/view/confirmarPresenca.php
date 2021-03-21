<?php

require_once '../model/Usuario.class.php';
require_once '../model/Reuniao.class.php';
require_once '../dao/ListaPresenca.dao.php';
require_once '../dao/Reuniao.dao.php';
require_once '../dao/Usuario.dao.php';

$usuario = new Usuario($_SESSION['username'], $_SESSION['nomecompleto'], null, null);

########## CRIA OBJETO REUNIAO ###########
$idReuniao = $_GET['id'];
$reuniao = ReuniaoDAO::buscarPorId($_GET['id']);

if(isset($_GET['msg'])){
	switch($_GET['msg']){
		case 1:
			echo "<script>alert('matricula não coincide com o nome do usuario, tente novamente.')</script>";
			break;

		case 2:
			echo "<script>alert('esse não é o seu nome.')</script>";
			break;
	}
}

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


	    <div class="mt-3 container">
	    	<form method="POST" id="formulario" action="../controller/ListaPresenca.controller.php?a=confirmarPresenca&idReuniao=<?=$idReuniao?>" onsubmit="return check_form()">
		    	<div class="row">
					<div class="col">
					  	<div class="form-floating">
						  <select class="form-select" name="select" id="floatingSelect" aria-label="Floating label select example" style="height: 60px;">
						    <option selected value="1">Clique aqui!</option>

						    <!-- FOREACH AUSENTES -->
						    <?php
							foreach(ListaPresencaDAO::mostrarAusentes($reuniao->getIdListapresenca()) as $membro){ ?>
								<option class="membro"><?=$membro['nome']?></option>							
							<?php }	?>

						  </select>
						  <label for="floatingSelect">Selecione seu nome</label>
						</div>			    
				  	</div>
					<div class="col">
						<input type="text" class="form-control" placeholder="Matrícula" name="matricula" style="height: 60px;" required>
					</div>
				</div>

				<div class="row">
				    <div class="col-md-4 col-lg-3">
				      <button type="submit" id="botaoConfirmarPresenca" class="btn btn-primary btn-block mt-3 mb-2">Confirmar presença</button>
				    </div>
				</div>
			<!-- </form> -->

			<a href="#" class="link-primary">Não estou na lista</a>

		</div>  




		<!-- fecha o conteudo da pagina -->
		</div>

	<!-- fecha a row da tela toda -->
    </div>
<!-- fecha o container grandao da pagina     -->
</div>


<script>

	function check_form(){
		if (document.getElementById('floatingSelect').value == 1) { 
			console.log('tem clique');
			alert('Selecione um nome da lista!');
			return false;
		}
		else{
			console.log('nao tem clique');
			return true;			
		}
	}
	
</script>

<!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

</body>
