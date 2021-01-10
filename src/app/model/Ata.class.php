<?php 
Class Ata{
	protected $id, $nome, $descricao;

	public function __construct($id, $nome, $descricao){
		$this->id = $id;
		$this->nome = $nome;
		$this->descricao = $descricao;
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