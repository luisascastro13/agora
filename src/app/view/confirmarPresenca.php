<!DOCTYPE html>
<html>
<?php include('template/head.php');
require_once '../model/Usuario.class.php'; 
session_start(); 

$usuario = new Usuario($_SESSION['username'], $_SESSION['nomecompleto'], null, null);

?>
<body>
<!-- container grandao da pagina -->
<div class="container-fluid m-0 p-0">

	<!-- TELA TODA -->
    <div class="row p-0 m-0">

		<?php include('template/navbarPequenos.php'); ?>
		<?php include('template/navbarGrandes.php'); ?>	
        <!-- CONTEÚDO DA PÁGINA -->
	    <div id="pagina" class="container-fluid pl-md-4">

	   	<form>
	   		Mostrar a lista dos membros do núcleo
	   		
	   		Nome: (tentar achar o nome na lista)
	   		<input type="text">
	   		Matrícula:
	   		<input type="number">
	   		<button type="submit">Confirmar presença</button>
	   	</form>	    

		<!-- fecha o conteudo da pagina -->
		</div>

	<!-- fecha a row da tela toda -->
    </div>
<!-- fecha o container grandao da pagina     -->
</div>