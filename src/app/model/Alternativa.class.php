<?php 
Class Alternativa{
	protected $id, $texto, $idPergunta;

	public function __construct($texto, $idPergunta){
		$this->texto = $texto;
		$this->idPergunta = $idPergunta;
	}

	public function __destruct(){ }

	public function getId() {
	    return $this->id;
	}
	 
	public function setId($id) {
	    $this->id = $id;
	}

	public function getTexto() {
	    return $this->texto;
	}
	 
	public function setTexto($texto) {
	    $this->texto = $texto;
	}

	public function getIdPergunta(){
		return $this->idPergunta;
	}

	public function setIdPergunta($idPergunta) {
		$this->idPergunta = $idPergunta;
	}
}
?>