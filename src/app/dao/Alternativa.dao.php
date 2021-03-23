<?php
require_once '../model/Conexao.class.php';
require_once '../model/Alternativa.class.php';

if(!isset($_SESSION)){
	session_start();
}

class AlternativaDAO{
	public static function criarAlternativa($alternativa){
		$conn = new Conexao();

		$sql = "INSERT INTO alternativas (id_pergunta, nome) VALUES (?,?)";
		$idAlternativa = $conn->atualizarTabela($sql, [$alternativa->getIdPergunta(), $alternativa->getTexto()]);

		return $idAlternativa;
	}

	public static function buscarAlternativasDePergunta($idPergunta){
		$conn = new Conexao();

		$sql = "SELECT codigo, nome FROM alternativas WHERE id_pergunta = ?";
		$alternativas = $conn->consultarTabela($sql, [$idPergunta]);
		return $alternativas;
	}
}
?>