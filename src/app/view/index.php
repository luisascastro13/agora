<?php
require_once '../dao/Usuario.dao.php';

$conn = new PDO('mysql:host=localhost;dbname=agora', 'useragora', '');

		if (!$conn) {
		    echo "Error: Unable to connect to MySQL." . PHP_EOL;
		    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
		    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
		    exit;
		}
		else {
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<title>Document</title>
</head>
<body>
	<header>
		<h1>Oi!</h1>
		<h2>Listar</h2>
	</header>

	<a href="inserir.php">Inserir novo</a>

	<table>
		<tr>
			<th>Nome</th>
			<th colspan="2">Opções</th>
		</tr>
		<?php 
		foreach (UsuarioDAO::listarUsuario($conn) as $fila)
			{ ?>
			<tr>
				<td><?= $fila[1] ?></td>
				<td><a href="editar.php?id=<?=$fila[0]?>">Editar</a></td>
				<td><a href="../controladores/Usuario.controlador.php?a=elim&id=<?=$fila[0]?>" onclick="return confirm('Deseja excluir?')">Excluir</a></td>
			</tr>
		<?php } ?>
	</table>
</body>
</html>

<?php } ?>