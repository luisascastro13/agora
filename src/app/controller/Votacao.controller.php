<?php 

switch($_POST['tipoPergunta']){
	case 'texto':
		echo 'sou texto';

		$titulo = $_POST['titulo'];
		$descricao = $_POST['descricao'];

		echo "<br>$titulo: $descricao";
		break;

	case 'multiplaescolha':
		echo 'sou multipla escolha';

		$titulo = $_POST['titulo'];
		$alternativas = array();

		foreach($_POST['op'] as $value){
	      array_push($alternativas, $value);
	    }

	    echo "<br>$titulo: ";
	    foreach($alternativas as $op){
	    	echo "<br>$op";
	    }
		break;		
}

?>