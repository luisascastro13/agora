<?php
require_once '../model/Conexao.class.php';

if(!isset($_SESSION)){
    session_start();
}

Class ReuniaoDAO{

	//lista todas reunioes do banco de dados
	public static function listarReunioes(){
		$conn = new Conexao();

		$sql = "SELECT * FROM REUNIAO";		
		$resultado = $conn->consultarTabela($sql, null);

		return $resultado;
	}

	// insere somente com as colunas not-nullable
	public static function inserirReuniao($reuniao){
		$conn = new Conexao();
		$sql = "INSERT INTO reuniao (nome, data, id_usuarioadm) VALUES (?,?,?)";

		$id = $conn->atualizarTabela($sql, [$reuniao->getNome(), $reuniao->getDatahora(), $reuniao->getIdusuarioadm()]);
		return $id;
	}

	public static function atualizarReuniao($reuniao){
		$conn = new Conexao();
		$sql = "UPDATE reuniao set
			nome = ?, descricao = ?, data = ?, id_usuarioadm = ?, id_ata = ?,
			id_listapresenca = ?, id_votacao = ?,	id_local = ?, id_nucleo = ?
			WHERE codigo = ?";

		$erro = $conn->atualizarTabela($sql, [$reuniao->getNome(), $reuniao->getDescricao(), $reuniao->getDatahora(), $reuniao->getIdusuarioadm(), $reuniao->getIdAta(), $reuniao->getIdListapresenca(), $reuniao->getIdVotacao(), $reuniao->getIdLocal(), $reuniao->getIdNucleo(), $reuniao->getId()]);

		return $erro;
	}

	public static function listarReunioesDoNucleo($nucleo){
		$conn = new Conexao();
		$sql = "SELECT * FROM reunioes WHERE id_nucleo = ?";
		$resultado = $conn->consultarTabela($sql, [$nucleo->getId()]);
		return $resultado;
	}



}

?>