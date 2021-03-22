<?php
require_once '../model/Conexao.class.php';

Class PerguntaDAO{
	public static function criarPergunta($id_votacao, $enunciado, $tipo_pergunta){
		$conn = new Conexao();

		$sql = "INSERT INTO pergunta (enunciado, id_votacao, tipo_pergunta) VALUES (?,?,?)";
		$id = $conn->atualizarTabela($sql, [$enunciado, $id_votacao, $tipo_pergunta]);
		return $id;
	}
}
?>