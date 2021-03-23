<?php
require_once '../model/Conexao.class.php';

Class PerguntaDAO{
	public static function criarPergunta($id_votacao, $enunciado, $tipo_pergunta){
		$conn = new Conexao();

		$sql = "INSERT INTO pergunta (enunciado, id_votacao, tipo_pergunta) VALUES (?,?,?)";
		$id = $conn->atualizarTabela($sql, [$enunciado, $id_votacao, $tipo_pergunta]);
		return $id;
	}

	public static function mostrarPerguntasVotacao($idVotacao){
		$conn = new Conexao();

		$sql = "SELECT * FROM pergunta WHERE id_votacao = ?";
		$perguntas = $conn->consultarTabela($sql, [$idVotacao]);
		return $perguntas;
	}

	public static function votar($id_usuario, $id_pergunta, $texto){
		$conn = new Conexao();

		$sql = "INSERT INTO responde (id_usuario, id_pergunta, texto) VALUES (?,?,?)";
		$id = $conn->atualizarTabela($sql, [$id_usuario, $id_pergunta, $texto]);
		return $id;
	}

	public static function atualizarEnunciado($idPergunta, $enunciado){
		$conn = new Conexao();

		$sql = "UPDATE pergunta SET enunciado = ? WHERE id = ?";
		$erro = $conn->atualizarTabela($sql, [$enunciado, $idPergunta]);
		return $erro;
	}

	public static function qualReuniao($idPergunta){
		$conn = new Conexao();

		$sql = "SELECT votacao.id_reuniao FROM pergunta
				INNER JOIN votacao ON votacao.id = pergunta.id_votacao
				WHERE pergunta.id = ?";
		$idReuniao = $conn->consultarTabela($sql, [$idPergunta]);
		return $idReuniao;
	}

	public static function verificarSeUsuarioJaVotouNaPergunta($idUsuario, $idPergunta){
		$conn = new Conexao();

		$sql = "SELECT * FROM responde where id_pergunta = ? and id_usuario = ?";
		$res = $conn->consultarTabela($sql, [$idPergunta, $idUsuario]);

		return $res;

	}


}

?>