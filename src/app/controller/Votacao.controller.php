<?php 

require_once '../dao/Pergunta.dao.php';
require_once '../dao/Alternativa.dao.php';
require_once '../model/Alternativa.class.php';

$id_votacao = $_POST['idVotacao'];


	// QUAL TIPO DE PERGUNTA
	switch($_POST['tipoPergunta']){
		case 'texto':
			echo 'sou texto';

			// TIPO TEXTO ==> 1
			$tipo_pergunta = 1;
			$enunciado = $_POST['titulo'];

			$idPergunta = PerguntaDAO::criarPergunta($id_votacao, $enunciado, $tipo_pergunta);

			echo $idPergunta;
			break;

		case 'multiplaescolha':
			echo 'sou multipla escolha';

			// TIPO MULTIPLA ESCOLHA ==> 1
			$tipo_pergunta = 2;
			$enunciado = $_POST['titulo'];

			$idPergunta = PerguntaDAO::criarPergunta($id_votacao, $enunciado, $tipo_pergunta);

			foreach($_POST['op'] as $alt){
				$alternativa = new Alternativa($alt, $idPergunta);
				$idAlternativa = AlternativaDAO::criarAlternativa($alternativa);
				echo $idAlternativa;
		    }
			break;		
	}


?>