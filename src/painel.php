<?php
require('mostrarReunioes.php');
require('mostrarNucleos.php');

session_start();

?>

<html>
<head>
	<title>Ágora: Painel do Usuário</title>
	
</head>
<style></style>

<body>

	<div>
		

	</div>

	<div>
		<h1>Núcleos</h1>

		<form method="post" action="inserirNucleo.php">
			<input type="text" name="nome" placeholder="Nome do núcleo" required>
			<input type="submit" value="Criar novo núcleo">
		</form>		
		
		
		<div>	
			<?php echo mostrarNucleos();
			?>
		</div>		

	</div>

	<div>
		<!-- <h1>Locais</h1> -->
		
	</div>



<br><br>
</body>	
</html>