<?php
Class ListaPresenca{
	protected $id, $nome, $descricao, $lista;

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

	public function getLista(){
		return $this->lista;
	}

	public function addLista($lista){
		$this->lista.push($lista);
	}

	public function removeLista($lista){
		unset($this->lista[array_search($lista,$this->lista)]);
	}
}
?>