<?php

class Reuniao{
	protected $codigo, $nome, $datahora, $descricao,
		$idusuarioadm, $idNucleo, $idAta, $idListapresenca, $idVotacao, $idLocal;

	public function __construct($nome, $datahora){
		$this->nome = $nome;
		$this->datahora = $datahora;
	}

	public function setCodigo($codigo){
		$this->codigo = $codigo;
	}
	public function getCodigo(){
		return $this->codigo;
	}

	public function setNome($nome){
		$this->nome = $nome;
	}
	public function getNome(){
		return $this->nome;
	}

	public function setDatahora($datahora){
		$this->datahora = $datahora;
	}
	public function getDatahora(){
		return $this->datahora;
	}

	public function setDescricao($descricao){
		$this->descricao = $descricao;
	}
	public function getDescricao(){
		return $this->descricao;
	}

	public function setIdusuarioadm($idusuarioadm){
		$this->idusuarioadm = $idusuarioadm;
	}
	public function getIdusuarioadm(){
		return $this->idusuarioadm;
	}

	public function setIdNucleo($idNucleo){
		$this->idNucleo = $idNucleo;
	}

	public function getIdNucleo(){
		return $this->idNucleo;
	}

	public function getIdAta(){
		return $this->idAta;
	}

	public function setIdAta($idAta){
		$this->idAta = $idAta;
	}

	public function getIdListapresenca(){
		return $this->idListapresenca;
	}

	public function setIdListapresenca($idlistaPresenca){
		$this->idListapresenca = $idlistaPresenca;
	}

	public function getIdVotacao(){
		return $this->idVotacao;
	}

	public function setIdVotacao($idVotacao){
		$this->idVotacao = $idVotacao;
	}

	public function getIdLocal(){
		return $this->idLocal;
	}

	public function setIdLocal($idLocal){
		$this->idLocal = $idLocal;
	}

	

}
?>