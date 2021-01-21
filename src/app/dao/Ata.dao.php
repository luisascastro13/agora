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

	public static function atualizarAta($ata){
		$conn = new Conexao();

		$sql = "UPDATE ata SET descricao = ? WHERE id = ?";
		$erro = $conn->atualizarTabela($sql, [$ata->getDescricao(), $ata->getId()]);

		if(isset($erro)){
			return $erro;
		}
	}

	public static function mostrarDescricao($id){
		$conn = new Conexao();

		$sql = "SELECT descricao FROM ata WHERE id = ?";
		$resultado = $conn->consultarTabela($sql, [$id]);
		return $resultado;
	}
}

?>