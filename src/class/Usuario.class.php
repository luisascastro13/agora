<?php

class Usuario {

	protected $login, $nome, $listaNucleo, $listaComentario;

	function __construct($login, $nome, $nucleo, $comentario){
		$this->login = $login;
		$this->nome = $nome;
		$this->listaNucleo.push($nucleo);
		$this->listaComentario.push($comentario);
	}

	function __destruct(){ }

	public function getLogin() {
	    return $this->login;
	}
	 
	public function setLogin($login) {
	    $this->login = $login;
	}

	public function getNome() {
	    return $this->nome;
	}
	 
	public function setNome($nome) {
	    $this->nome = $nome;
	}

	public function getListaNucleo(){
		return $this->listaNucleo;
	}

	public function addListaNucleo($nucleo){
		$this->nucleos.push($nucleo);
	}

	public function addListaComentario($listaComentario){ 
		$this->comentarios.push($listaComentario);
	}

	public function getListaComentario(){
		return $this->listaComentario;
	}

	

}
?>