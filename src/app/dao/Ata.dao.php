<?php
require_once '../model/Conexao.class.php';

if(!isset($_SESSION)){
	session_start();
}

class AtaDAO{
	public static function criarAta($ata){
		$conn = new Conexao();

		$sql = "INSERT INTO ata (descricao) VALUES (?)";
		$id = $conn->atualizarTabela($sql, [$ata->getDescricao()]);
		return $id;
	}
}

?>