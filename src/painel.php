<?php
require('mostrarReunioes.php');

?>

<html>
<head>
	<title>Ágora: Painel do Usuário</title>
	
</head>
<style></style>

<body>

	<div>
		<h1>Assembleias</h1>
		<form method="post" action="inserirReuniao.php">
		<input type="text" name="nome" placeholder="Nome da reunião" required>
		<input type="datetime-local" name="data" placeholder="Data" required>
		<input type="submit" value="Criar nova reunião">
		</form>

		<div>
			<?php mostrarReunioes(); ?>
		</div>			
	</div>	

</body>	
</html>