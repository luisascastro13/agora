<?php

require_once '../dao/Alternativa.dao.php';
require_once '../dao/Pergunta.dao.php';

$reuniao = ReuniaoDAO::buscarPorId($_GET['id']);
$idVotacao = $reuniao->getIdVotacao();

?>
<div>

	<div class="row">

	<!-- CARD PERGUNTA -->
	  <div class="col-sm-6 col-lg-4 my-2">
	    <div class="card ">
	      <div class="card-body">
	        <h5 class="card-title">Pergunta1</h5>
	        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
	        <a href="#" class="btn btn-primary">Go somewhere</a>
	      </div>
	    </div>
	  </div>

	  <?php 

	  foreach(PerguntaDAO::mostrarPerguntasVotacao($idVotacao) as $perg){
	  	echo $perg['enunciado'];
	  	if($perg['tipo_pergunta'] == 2)){
	  		foreach(AlternativaDAO::buscarAlternativasDePergunta($perg['id']) as $alt)
			{
				echo $alt;
			}
	  	}
	  }	  

	  ?>  


	</div>

</div>