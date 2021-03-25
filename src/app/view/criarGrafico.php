<?php // content="text/plain; charset=utf-8"
require_once ('../jpgraph/src/jpgraph.php');
require_once ('../jpgraph/src/jpgraph_pie.php');

require_once ('../dao/Pergunta.dao.php');

if(isset($_GET['idPerg'])){
$idPerg = $_GET['idPerg'];

$data = PerguntaDAO::verificarVotos($idPerg);
$arrayAlternativas = [];
$arrayVotos = [];

foreach(PerguntaDAO::verificarVotos($idPerg) as $val){

	$idVotacao = $val['id_votacao'];
	$titulo = $val['enunciado'];
	$alt = '"'.$val['texto'].'"';
	array_push($arrayAlternativas, $alt);
	array_push($arrayVotos, $val['quant']);
}

$graph = new PieGraph(300,350);
$graph->SetShadow(); 
$graph->title->Set($titulo); 
$p1 = new PiePlot($arrayVotos);
$p1->SetLegends($arrayAlternativas);
$graph->Add($p1);
$graph->Stroke();


// $myPath = "../view/votos/".$idVotacao;
// if (!is_dir($myPath)) {	
//     mkdir($myPath."\\"."$idPergunta".".jpg", 0777, true);
// }

// $path = $myPath."\\"."$idPergunta".".jpg";
// $graph->Stroke($path); 
}


?>
