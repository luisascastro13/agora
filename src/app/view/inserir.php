<html>
<?php include('template/head.php'); ?>
<body>
	<?php include('template/navbarPequenos.php'); ?>
	<?php include('template/navbarGrandes.php'); ?>

	<h1>Inserir</h1>

	<?php 

	switch($_REQUEST['model']){
		case 'nucleo':
			$url = "../controller/Nucleo.controller.php";
			echo 'NUCLEO';
			break;
		case 'usuario':
			$url = "../controller/Usuario.controller.php";
			echo 'USUARIO';
			break;
	}

	?>

	<form action="$url" method="POST">
		<!-- enviar para a classe controller da classe q esta sendo inserida-->
		<input name='nome'>
		<input type='submit'>		
	</form>

	<a href="index.php">VOLTAR</a>
</html>