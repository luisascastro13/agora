<?php

require('mostrarNucleos.php');
require('mostrarNucleosPesquisados.php');

session_start();

?>

<html>
<head>
	<title>Ágora: Painel do Usuário</title>
	
</head>
<style></style>

<body>

	<div>
		<h4>
			Nome do usuário: <?php echo $_SESSION['primeironome'];?>
			<br>
			Matrícula: <?php echo $_SESSION['username'];?>
		</h4>
	</div>

	<div>
		<h1>Busca de núcleos</h1>

		<form method="post" action="">
			<input type="text" name="nomePesquisado" placeholder="Nome do núcleo" required>
			<input type="submit" value="Buscar">
		</form>
		
		<div><?php mostrarNucleosPesquisados(); ?></div>
	</div>

	<div>
		<h1>Núcleos que o usuário participa</h1>

		<form method="post" action="inserirNucleo.php">
			<input type="text" name="nome" placeholder="Nome do núcleo" required>
			<input type="submit" value="Criar novo núcleo">
		</form>	
		
		<div>	
			<?php
			echo mostrarNucleos();
			?>
		</div>
	</div>

</body>	
</html>