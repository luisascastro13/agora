<?php

Class Local{
	protected $id, $nome, $cep, $logradouro, $numero;

	public function __construct( $id, $nome, $cep, $logradouro, $numero){
		$this->id = $id;
		$this->nome = $nome;
		$this->cep = $cep;
		$this->logradouro = $logradouro;
		$this->numero = $numero;
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

	public function getCep() {
	    return $this->cep;
	}
	 
	public function setCep($cep) {
	    $this->cep = $cep;
	}

	public function getLogradouro() {
	    return $this->logradouro;
	}
	 
	public function setLogradouro($logradouro) {
	    $this->logradouro = $logradouro;
	}

	public function getNumero() {
	    return $this->numero;
	}
	 
	public function setNumero($numero) {
	    $this->numero = $numero;
	}
}

?>