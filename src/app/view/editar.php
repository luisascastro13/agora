<?php
require_once '../dao/Nucleo.dao.php';

$nucleo = NucleoDAO::buscarPorId($_GET['id']);

$nome = $nucleo['0']['nome'];
$id = $nucleo['0']['id'];

?>


<html>
	<h1>Editar</h1>
	<a href="index.php">Voltar</a>

	<form action="../controller/Nucleo.controller.php?a=editar" method="POST">
		<input type="hidden" name="id" value="<?=$id ?>" />
		<input name="nome" placeholder="Nome" value='<?=$nome ?>' />
		<input type="submit" value="Editar" />
	</form>


</html>
