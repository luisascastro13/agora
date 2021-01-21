<?php
require_once '../model/Conexao.class.php';
require_once '../model/Usuario.class.php';
require_once '../model/Ata.class.php';
require_once '../dao/Ata.dao.php';

if(!ISSET($_SESSION)){
	session_start();
}

$conn = new Conexao();
$usuario = new Usuario($_SESSION['username'], $_SESSION['nomecompleto'], null, null);

if(ISSET($_GET['a'])){
	switch($_GET['a']){
		case 'atualizarAta':
			$ata = new Ata();
			$ata->setDescricao($_POST['content']);
			$ata->setId($_POST['idAta']);

			AtaDAO::atualizarAta($ata);

			$idReuniao = $_POST['idReuniao'];
			$conteudo=$ata->getDescricao();

			$_SESSION['conteudoAta'] = $ata->getDescricao();

			header("Location: ../view/visualizarReuniao.php?id=$idReuniao");
			break;			
	}
}
else{
	echo 'ops nao passou nenhum parametro na url pra eu saber se devo inserir, editar ou eliminar';
}



?>