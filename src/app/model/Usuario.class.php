<?php

class Usuario {

	protected $login, $nome;
	public $listaNucleo = array();
	protected $listaComentario = array();

	function __construct($login, $nome, $nucleo, $comentario){
		$this->login = $login;
		$this->nome = $nome;
		// $this->listaNucleo.push($nucleo);
		// $this->listaComentario.push($comentario);
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


	//$a é o id_nucleo, $b é o id da tabela usuarios_frequentam_nucleo
	// a ideia é que fique assim:
	// Array (	
	//    [0] => Array (
	//              [0] => $a;
	// 		  		[1] => $b;
	//    )
	// )
	// ou seja, se tu procurares na tabela usuarios_frequentam_nucleo o índice id $b,
	// tu acha o valor de id_nucleo como id $a;
	// Esta função foi escrita desta maneira para poder inserir um usuário sem id, mas permitir alteração com base em um ID confiável, e não o nome de um usuário.
	public function addListaNucleo($nucleo, $idUsuarioNucleo){
		$array = [$nucleo, $idUsuarioNucleo];
		array_push($this->listaNucleo, $array);
	}

	public function addListaComentario($listaComentario){ 
		array_push($this->listaComentario, $listaComentario);
	}

	public function getListaComentario(){
		return $this->listaComentario;
	}

	

}
?>