<?php 
Class Ata{
	protected $id, $nome, $descricao;

	public function __construct(){
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
}
?>