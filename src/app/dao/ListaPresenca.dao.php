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

		$sql = "INSERT INTO presenca VALUES (?, ?, 0, 0)";
		$erro = $conn->atualizarTabela($sql, [$listaPresenca->getId(), $membro]);
		return $erro;
	}

	public static function mostrarListaPresenca($idLista){
		$conn = new Conexao();

		$sql = "SELECT presenca.id_usuario, usuario.nome, presenca.convidado, presenca.presente FROM presenca
		INNER JOIN listapresenca ON listapresenca.id = presenca.id_lista_presenca
		INNER JOIN usuario ON usuario.login = presenca.id_usuario
		WHERE presenca.id_lista_presenca = ?";	

		$lista = $conn->consultarTabela($sql, [$idLista]);	
		return $lista;
	}

	public static function mostrarAusentes($idLista){
		$conn = new Conexao();

		$sql = "SELECT usuario.nome FROM presenca
		INNER JOIN listapresenca ON listapresenca.id = presenca.id_lista_presenca
		INNER JOIN usuario ON usuario.login = presenca.id_usuario
		INNER JOIN usuarios_frequentam_nucleo ON usuarios_frequentam_nucleo.id_usuario = presenca.id_usuario
		WHERE presenca.id_lista_presenca = ? AND presenca.presente = 0 AND usuarios_frequentam_nucleo.ativo = 1 GROUP BY usuario.nome";

		$lista = $conn->consultarTabela($sql, [$idLista]);
		return $lista;
	}

	public static function atualizarMembroPresente($idLista, $membro){
		$conn = new Conexao();

		$sql = "UPDATE presenca SET presente = 1 WHERE id_lista_presenca = ? AND id_usuario = ?";
		$erro = $conn->atualizarTabela($sql, [$idLista, $membro]);
		return $erro;
	}

}

?>