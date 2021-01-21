<?php
require_once '../model/Conexao.class.php';

if(!isset($_SESSION)){
	session_start();
}

class ListaPresencaDAO{
	public static function criarListaPresenca($listaPresenca){
		$conn = new Conexao();

		$sql = "INSERT INTO listapresenca (descricao) VALUES (?)";
		$id = $conn->atualizarTabela($sql, [$listaPresenca->getDescricao()]);
		return $id;
	}
}

?>