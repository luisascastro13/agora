<?php
require_once '../model/Reuniao.class.php';
require_once '../dao/Reuniao.dao.php';

########## CRIA OBJETO REUNIAO ###########

$idReuniao = $_GET['id'];
$reuniao = ReuniaoDAO::buscarPorId($_GET['id']);

?>

<table>
	<tr>
		<th>Código</th>
		<th>Nome</th>
		<th>Data e horário</th>
		<th>Descricao</th>
	</tr>
	<?php foreach($reuniao as $r){ 

		$data = date_create($reuniao->getDatahora());
		$dataFormatada = date_format($data, 'd/m/Y H:i');
		?>
		
		<tr>
			<td><?=$reuniao->getCodigo()?></td>
			<td><?=$reuniao->getNome()?></td>
			<td><?=$dataFormatada?></td>
			<td><?=$reuniao->getDescricao()?></td>
		</tr>

	<?php } ?>
</table>



