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
			// echo $usuario->getNome();
			// echo '<br>'.$usuario->getLogin();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<title>Document</title>
</head>
<body>
	<!-- <header>
		<h1>Oi!</h1>
		<h2>Listar Usuários</h2>
	<sheader>
	<a href="inserir.php?model=usuario">Inserir novo</a>
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
				<td><a href="../controladores/Usuario.controlador.php?&a=elim&id=<?=$fila[0]?>" onclick="return confirm('Deseja excluir?')">Excluir</a></td>
			</tr>
		<?php } ?>
	</table> -->


	<header>
		<h2>Núcleos</h2>
	</header>

	<!-- Button trigger modal -->
	<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" href="inserir.php?model=nucleo">Inserir novo núcleo</button>

	<!-- Modal -->
	<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Inserir novo núcleo</h5>
	        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	      </div>
	      <div class="modal-body">

	      <!-- inserir -->
	      	<form method="post" action='../controller/Nucleo.controller.php?a=inserir'>

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
	
	<table>
		<tr>
			<th>Nome</th>
			<th colspan="2">Opções</th>
		</tr>

		<!-- listar todos nucleos que o usuario está na lista-->
		<?php 
		foreach (NucleoDAO::listarNucleoUsuarioParticipa() as $val)
			{ ?>
			<tr>
				<td><?= $val['nome'] ?></td>
				<td><a href="editar.php?id=<?=$val['id']?>">Editar</a></td>
				<td><a href="../controller/Nucleo.controller.php?a=elim&id=<?=$fila[0]?>" onclick="return confirm('Deseja excluir?')">Excluir</a></td>
			</tr>
		<?php } ?>
	</table>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>
</html>

<?php } ?>