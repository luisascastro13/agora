<?php 
Class Pergunta{
	protected $id, $titulo, $listaAlternativa;

	public function __construct($id, $titulo, $alternativa){
		$this->id = $id;
		$this->titulo = $titulo;
		$this->listaAlternativa.push($alternativa);
	}

	public function __destruct(){ }

	public function getId() {
	    return $this->id;
	}
	 
	public function setId($id) {
	    $this->id = $id;
	}

	public function getTitulo() {
	    return $this->titulo;
	}
	 
	public function setTitulo($titulo) {
	    $this->titulo = $titulo;
	}

	public function getListaAlternativa() {
	    return $this->listaAlternativa;
	}
	 
	public function addListaAlternativa($listaAlternativa) {
	    $this->listaAlternativa.push($listaAlternativa);
	}

	public function removeListaAlternativa($listaAlternativa) {
		unset($this->listaAlternativa[array_search($listaAlternativa,$this->listaAlternativa)]);
	}
}
?>