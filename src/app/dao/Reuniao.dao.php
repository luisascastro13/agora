<?php
require_once '../model/Conexao.class.php';
require_once '../model/Reuniao.class.php';

if(!isset($_SESSION)){
    session_start();
}

Class ReuniaoDAO{

	// pega o resultado de uma consulta do banco e converte em objeto reuniao
	public static function bancoParaObjetoReuniao($reuniaoArray){

		$reuniao = $reuniaoArray[0];

		$objReuniao = new Reuniao($reuniao[1], $reuniao[3]);
		$objReuniao->setCodigo($reuniao[0]);
		$objReuniao->setDescricao($reuniao[2]);
		$objReuniao->setIdusuarioadm($reuniao[4]);
		$objReuniao->setIdAta($reuniao[5]);
		$objReuniao->setIdListaPresenca($reuniao[6]);
		$objReuniao->setIdVotacao($reuniao[7]);
		$objReuniao->setIdLocal($reuniao[8]);
		$objReuniao->setIdNucleo($reuniao[9]);

		return $objReuniao;
	}

	//lista todas reunioes do banco de dados
	public static function listarReunioes(){
		$conn = new Conexao();

		$sql = "SELECT * FROM REUNIAO WHERE status = 0";		
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

		$erro = $conn->atualizarTabela($sql, [$reuniao->getNome(), $reuniao->getDescricao(), $reuniao->getDatahora(), $reuniao->getIdusuarioadm(), $reuniao->getIdAta(), $reuniao->getIdListapresenca(), $reuniao->getIdVotacao(), $reuniao->getIdLocal(), $reuniao->getIdNucleo(), $reuniao->getCodigo()]);

		return $erro;
	}

	public static function listarReunioesDoNucleo($nucleo){
		$conn = new Conexao();
		$sql = "SELECT * FROM reuniao WHERE id_nucleo = ?";
		$resultado = $conn->consultarTabela($sql, [$nucleo->getId()]);
		return $resultado;
	}

	public static function buscarPorId($id){
		$conn = new Conexao();
		$sql = "SELECT * FROM REUNIAO where codigo = ?";
		$resultado = $conn->consultarTabela($sql, [$id]);
		$objetoReuniao = ReuniaoDAO::bancoParaObjetoReuniao($resultado);
		return $objetoReuniao;
	}

	public static function buscarProximasReunioes(){
		$conn = new Conexao();

		$sql = "SELECT reuniao.codigo, reuniao.nome, reuniao.descricao, reuniao.data, reuniao.id_nucleo, nucleo.nome as nomenucleo FROM reuniao
			INNER JOIN nucleo ON nucleo.id = reuniao.id_nucleo			
			WHERE data >= NOW() AND reuniao.status = 0
			ORDER BY data";

		$reunioes = $conn->consultarTabela($sql, null);
		return $reunioes;
	}

	public static function excluirReuniao($reuniao){
		$conn = new Conexao();

		$sql = "UPDATE reuniao SET status = 1 WHERE codigo = ?";
		$erro = $conn->atualizarTabela($sql, [$reuniao]);
		return $erro;
	}

	public static function mostrarIdNucleo($reuniao){
		$conn = new Conexao();

		$sql = "SELECT id_nucleo FROM reuniao WHERE codigo = ?";
		$id = $conn->consultarTabela($sql, [$reuniao]);
		return $id;
	}
}

?>