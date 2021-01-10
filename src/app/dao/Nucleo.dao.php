<?php
require_once '../modelos/Conexao.class.php';

Class NucleoDAO{
	public static function listarNucleo($conn){
		$sql = "SELECT * FROM NUCLEO";
		$resultado = $conn->consultarTabela($sql);
		return $resultado;
	}
	public static function inserirNucleo($conn, $nucleo){
		$sql = "INSERT INTO NUCLEO (id, nome, descricao) VALUES (?,?,?)";
		$conn->atualizarTabela($sql, [$nucleo->getId(), $nucleo->getNome(), $nucleo->getDescricao()]);
	}
	public static function deletarNucleo($conn, $nucleo){
		$sql = "DELETE FROM NUCLEO WHERE id = $nucleo->getId()";
		$conn->atualizarTabela($sql);
	}
}
?>