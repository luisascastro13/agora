<?php
require_once '../model/Conexao.class.php';

if(!isset($_SESSION)){
	session_start();
}

class VotacaoDAO{
	public static function criarVotacao($idReuniao){
		$conn = new Conexao();

		$sql = "INSERT INTO votacao (id_reuniao) VALUES (?)";
		$id = $conn->atualizarTabela($sql, [$idReuniao]);

		return $id;
	}
}
?>