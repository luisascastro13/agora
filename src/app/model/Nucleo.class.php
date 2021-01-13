<?php
Class Nucleo{
	protected $id, $nome, $descricao;
	protected $listaMembro = array();
	protected $listaAdm = array();
	protected $listaAtivo = array();


	public function __construct($nome){
		$this->nome = $nome;
	}

	public function __destruct(){ }

	public function getId() {
	    return $this->id;
	}
	 
	public function setId($id) {
	    $this->id = $id;
	}

	public function getNome() {
	    return $this->nome;
	}
	 
	public function setNome($nome) {
	    $this->nome = $nome;
	}

	public function getDescricao() {
	    return $this->descricao;
	}
	 
	public function setDescricao($descricao) {
	    $this->descricao = $descricao;
	}

	public function getListaMembro(){
		return $this->listaMembro;
	}

	public function addListaMembro($listaMembro) {
		$this->listaMembro.push($listaMembro);
	}

	public function removeListaMembro($listaMembro) {
		unset($this->listaMembro[array_search($listaMembro,$this->listaMembro)]);
	}

	public function addListaAdm($a) {
		array_push($this->listaAdm, $a);
	}

	public function getListaAdm(){	

		foreach($this->listaAdm as $adm){
			return $adm;
		}
	}

	public function removeListaAdm($listaAdm) {
		unset($this->listaAdm[array_search($listaAdm,$this->listaAdm)]);
	}

	public function addListaAtivo($listaAtivo) {
		$this->listaAtivo.push($listaAtivo);
	}

	public function removeListaAtivo($listaAtivo) {
		unset($this->listaAtivo[array_search($listaAtivo,$this->listaAtivo)]);
	}




}
?>