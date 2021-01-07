<?php
Class Responde{
	protected $id, $respostaTexto, $respostaPergunta, $usuario;

	public function __construct($id, $respostaTexto, $respostaPergunta, $usuario){
		$this->id = $id;
		$this->respostaTexto = $respostaTexto;
		$this->respostaPergunta = $respostaPergunta;
		$this->usuario = $usuario;
	}

	public function __destruct(){ }

	public function getId() {
	    return $this->id;
	}
	 
	public function setId($id) {
	    $this->id = $id;
	}

	public function getRespostaTexto() {
	    return $this->respostaTexto;
	}
	 
	public function setRespostaTexto($respostaTexto) {
	    $this->respostaTexto = $respostaTexto;
	}

	public function getRespostaPergunta() {
	    return $this->respostaPergunta;
	}
	 
	public function setRespostaPergunta($respostaPergunta) {
	    $this->respostaPergunta = $respostaPergunta;
	}

	public function getUsuario() {
	    return $this->usuario;
	}
	 
	public function setUsuario($usuario) {
	    $this->usuario = $usuario;
	}

}
?>