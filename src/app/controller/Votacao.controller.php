<?php
require_once ('../jpgraph/src/jpgraph.php');
require_once ('../jpgraph/src/jpgraph_pie.php');
require_once '../dao/Pergunta.dao.php';
require_once '../dao/Alternativa.dao.php';
require_once '../model/Alternativa.class.php';
require_once '../model/Usuario.class.php';

if(!ISSET($_SESSION)){
  session_start();
}
$usuario = new Usuario($_SESSION['username'], $_SESSION['nomecompleto'], null, null);

if(isset($_POST['idVotacao'])){
	$id_votacao = $_POST['idVotacao'];
}


if(isset($_GET['a'])){
	switch($_GET['a']){
		case 'inserir':
			// echo 'inserindo nova pergunta na votacao';

			// QUAL TIPO DE PERGUNTA
			switch($_POST['tipoPergunta']){
				case 'texto':
					// echo 'sou texto';

					// TIPO TEXTO ==> 1
					$tipo_pergunta = 1;
					$enunciado = $_POST['titulo'];

					$idPergunta = PerguntaDAO::criarPergunta($id_votacao, $enunciado, $tipo_pergunta);
					// echo $idPergunta;
					break;

				case 'multiplaescolha':
					// echo 'sou multipla escolha';

					// TIPO MULTIPLA ESCOLHA ==> 1
					$tipo_pergunta = 2;
					$enunciado = $_POST['titulo'];

					$idPergunta = PerguntaDAO::criarPergunta($id_votacao, $enunciado, $tipo_pergunta);

					foreach($_POST['op'] as $alt){
						$alternativa = new Alternativa($alt, $idPergunta);
						$idAlternativa = AlternativaDAO::criarAlternativa($alternativa);
						// echo $idAlternativa;
				    }
				    break;				

					
							
			}
			$ide = PerguntaDAO::qualReuniao($idPergunta);
					$id = $ide[0]['id_reuniao'];
					header("Location: ../view/editarVotacao.php?id=$id");
							
			break;

		case 'editar':

			$enunciado = $_POST['enunciado'];
			$idPergunta = $_POST['idPerg'];

			PerguntaDAO::atualizarEnunciado($idPergunta, $enunciado);
			
			$ide = PerguntaDAO::qualReuniao($idPergunta);
			$id = $ide[0]['id_reuniao'];

			header("Location: ../view/editarVotacao.php?id=$id");
			break;

		case 'votar':

			$idUsuario = $_SESSION['username'];
			$idPergunta = $_POST['idPerg'];

			if(isset($_POST['alternativa'])){
				$texto = $_POST['alternativa'];
			}
			if(isset($_POST['resposta'])){
				$texto = $_POST['resposta'];
			}	

			$idResposta = PerguntaDAO::votar($idUsuario, $idPergunta, $texto);

			// // settar o gráfico.
			// $data = PerguntaDAO::verificarVotos($idPergunta);
			// $arrayAlternativas = [];
			// $arrayVotos = [];

			// foreach(PerguntaDAO::verificarVotos($idPergunta) as $val){

			// 	$idVotacao = $val['id_votacao'];
			// 	$titulo = $val['enunciado'];
			// 	$alt = '"'.$val['texto'].'"';
			// 	array_push($arrayAlternativas, $alt);
			// 	array_push($arrayVotos, $val['quant']);
			// }

			// $myPath = "..\\view\\votos\\$idVotacao";

			// if (!is_dir($myPath)) {	
			//     mkdir($myPath, 777, true);
			// }
			
			// $path = $myPath."\\"."$idPergunta".".jpg";

			// $graph = new PieGraph(300,350);
			// $graph->SetShadow();			 
			// $graph->title->Set($titulo);			 
			// $p1 = new PiePlot($arrayVotos);
			// $p1->SetLegends($arrayAlternativas);
			// $graph->Add($p1);
			
			// $graph->Stroke($path); 
			
			$ide = PerguntaDAO::qualReuniao($idPergunta);
			$id = $ide[0]['id_reuniao'];
			header("Location: ../view/visualizarReuniao.php?id=$id");
			break;

	}
}


?>