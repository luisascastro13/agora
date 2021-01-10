<?php
Class Nucleo{
	protected $id, $nome, $descricao, $listaMembro;

	public function __construct($id, $nome, $descricao, $listaMembro){
		$this->id = $id;
		$this->nome = $nome;
		$this->descricao = $descricao;
		$this->listaMembro.push($listaMembro);
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
}
?>