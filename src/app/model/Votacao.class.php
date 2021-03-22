<?php

class Votacao {

	protected $id, $titulo, $descricao, $id_reuniao;

	function __construct($id_reuniao){
		$this->id_reuniao = $id_reuniao;	
	}

	public function getId() {
	    return $this->id;
	}
	 
	public function setId($id) {
	    $this->id = $id;
	}

	public function getDescricao() {
	    return $this->descricao;
	}
	 
	public function setDescricao($descricao) {
	    $this->descricao = $descricao;
	}

	public function getIdReuniao() {
	    return $this->id_reuniao;
	}
	 
	public function setIdReuniao($id_reuniao) {
	    $this->id_reuniao = $id_reuniao;
	}

}
?>
