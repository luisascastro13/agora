<?php 
Class Alternativa{
	protected $id, $texto;

	public function __construct( $id, $texto){
		$this->id = $id;
		$this->texto = $texto;
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
}
?>