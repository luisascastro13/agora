<?php
require_once '../model/Conexao.class.php';
require_once '../model/Nucleo.class.php';

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

	public static function inserirMembroNaLista($listaPresenca, $membro){
		$conn = new Conexao();

		$sql = "INSERT INTO presenca VALUES (?, ?, 1, 0)";
		$erro = $conn->atualizarTabela($sql, [$listaPresenca->getId(), $membro]);
		return $erro;
	}

	public static function mostrarListaPresenca($nucleo){
		$conn = new Conexao();

		$sql = "SELECT presenca.id_usuario, usuario.nome, presenca.convidado, presenca.presente FROM presenca INNER JOIN usuario ON usuario.login = presenca.id_usuario";	

		$lista = $conn->consultarTabela($sql, [$nucleo->getId()]);	
		return $lista;
	}


}

?>