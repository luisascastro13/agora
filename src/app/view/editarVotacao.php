<?php
require_once ('../jpgraph/src/jpgraph.php');
require_once ('../jpgraph/src/jpgraph_pie.php');

require_once '../model/Reuniao.class.php';
require_once '../dao/Reuniao.dao.php';
require_once '../dao/Nucleo.dao.php';
require_once '../model/Nucleo.class.php';
require_once '../dao/Ata.dao.php';
require_once '../model/Ata.class.php';
require_once '../model/Conexao.class.php';
require_once '../dao/ListaPresenca.dao.php';
require_once '../dao/Alternativa.dao.php';
require_once '../dao/Pergunta.dao.php';

if(!ISSET($_SESSION)){
  session_start();
}

$usuario = new Usuario($_SESSION['username'], $_SESSION['nomecompleto'], null, null);


$idReuniao = $_GET['id'];
$objReuniao = ReuniaoDAO::buscarPorId($idReuniao);

$reuniao = ReuniaoDAO::buscarPorId($idReuniao);

?>


<!DOCTYPE html>
<html>
<?php include('template/head.php'); ?>
<body>
<!-- container grandao da pagina -->
<div class="container-fluid m-0 p-0">

	<!-- TELA TODA -->
    <div class="row p-0 m-0">

		<?php include('template/navbarPequenos.php'); ?>
		<?php include('template/navbarGrandes.php'); ?>	

        <!-- CONTEÚDO DA PÁGINA -->
	    <div id="pagina" class="container-fluid pl-md-4 pb-5 mb-4">

	    	<div>                
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">                  
                    <li class="breadcrumb-item"><a href="painel.php">Painel</a></li>
                    <li class="breadcrumb-item"><a href="visualizarReuniao.php?id=<?=$idReuniao?>">Reunião</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Editar Votação</li>
                  </ol>
                </nav>
            </div>


	    <p class="h4"><?=$reuniao->getNome(); ?><br></p>

	   	<div class="row">
	   	<p class="h5 mt-3">Nova Pergunta <br></p>

	   		<div class="col mt-3">
		    		<div class="input-group">
			    		<label class="input-group-text" for="inputGroupSelect01">Tipo de pergunta:</label>
				    	<select id="tiposelector">
				   			<option >Selecione...</option>
						   <option value='texto'>Texto</option>
						   <option value="multiplaescolha">Múltipla Escolha</option>
						</select>
					</div>
				</div>	   		
	   		

	   		<!-- EXEMPLO DE PERGUNTA TIPO TEXTO -->
	   		<form action="../controller/Votacao.controller.php?a=inserir" method="POST">
	   		<input type="hidden" name="tipoPergunta" value="texto">
	   		<input type="hidden" name="idVotacao" value="<?=$objReuniao->getIdVotacao()?>">
 			<div id="texto" class="tipo" style="display:none;">
				
		    	<div class="col-sm-6 col-lg-5 my-2">
				    <div class="card mb-3 w-100">
						<div class="card-header card-title ">
							<input name="titulo" id="tituloPerguntaTexto" required class="card-title form-control" placeholder="Qual deveria ser o nome do mascote do IFRS Canoas?">
						</div>
						<div class="card-body">			        
							<div class="d-grid gap-2 mt-1">
								<button type="submit" class="btn btn-warning btn-sm d-grid gap-2">Criar Pergunta</button>
							</div>     
						</div>
				    </div>
				</div>
			</div>
			</form>


			<!-- EXEMPLO DE PERGUNTA TIPO MULTIPLA ESCOLHA -->
			<form action="../controller/Votacao.controller.php?a=inserir" method="POST">
	   		<input type="hidden" name="tipoPergunta" value="multiplaescolha">
	   		<input type="hidden" name="idVotacao" value="<?=$objReuniao->getIdVotacao()?>">
			<div id="multiplaescolha" class="tipo" style="display:none">
				
		    	<div class="col-sm-6 col-lg-5 my-2">
		    		<div class="card mb-3 w-100">
						<div class="card-header card-title">
							<input name="titulo" required id="tituloPerguntaMultiplaEscolha" class="card-title form-control" placeholder="Qual a melhor cor para a camiseta da gincana?">
						</div>
						<div class="card-body">
					    	<div class="d-flex justify-content-between">
								<label class="fw-bold form-label">Alternativas:</label>
								<a class="btn btn-sm btn-outline-warning" id="addAlt" type="submit">Adicionar Alternativa</a>
							</div>

							<!-- SE SO TIVER DUAS ALTERNATIVAS, NAO PERMITIR EXCLUSAO -->
							<table class="table table-borderless table-sm" name="textosAlternativas">							
								<tbody class="row" id="alternativas">
									<tr class="table-light">
										<td class="col-11"><input type="text" name="op[]" class="form-control" placeholder="Azul" required></td>
										<td class="col-1">
											<a class="btn btn-sm btn-danger excluir" onclick="return removerAlt(this);">
												<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
													<path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
												</svg>
											</a>					

										</td>
									</tr>
									<tr class="table-light">
										<td class="col-11"><input type="text" name="op[]"  class="form-control" placeholder="Amarelo" required></td>
										<td class="col-1">

											<a class="btn btn-sm btn-danger excluir " onclick="return removerAlt(this);">
												<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
													<path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
												</svg>
											</a>					

										</td>
									</tr>

									<tr class="table-light">
										<td class="col-11"><input type="text" name="op[]"  class="form-control" placeholder="Verde" required></td>
										<td class="col-1">

											<a class="btn btn-sm btn-danger excluir" onclick="return removerAlt(this);">
												<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
													<path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
												</svg>
											</a>											

										</td>
									</tr>
																		
								</tbody>
							</table>

							<div class="d-grid gap-2 mt-2">
								<button onclick="return verificarAlternativas();" type="submit" class="btn btn-warning btn-sm d-grid gap-2">Criar Pergunta</button>
							</div>	
					  </div>
					</div>

			</div>
			</form>
	   		
	   	</div>
	   	<div class="row" >
	   		<p class="h5 mt-3">Perguntas: <br></p>

	   		<?php foreach(PerguntaDAO::mostrarPerguntasVotacao($reuniao->getIdVotacao()) as $perg){ ?>
	   		   	<div class="col-sm-6 my-2">
				    <div class="card p-3">
						<div class="card-body pb-1">
							<form method="POST" action="../controller/Votacao.controller.php?a=editar">
							<h5 class="card-title">
								<input name="enunciado" id="<?=$perg['id']?>" required class="form-control" value="<?=$perg['enunciado']?>">
							</h5>
						</div> 
						<div class="text-center">  
			    			<?php if($perg['tipo_pergunta'] == 2){
			    				echo "<div class='fw-bold'>Alternativas: </div>";
								foreach(AlternativaDAO::buscarAlternativasDePergunta($perg['id']) as $alt){ ?>
									<div><?=$alt['nome']?></div>
							<?php }
			                } ?>
			            </div>
			             	<input type="hidden" name="idPerg" value="<?=$perg['id']?>">
			            	<button type="submit" class="d-grid col-4 mx-auto btn btn-outline-info btn-sm">Salvar</button>
			            </form>         	
             		</div>
              	</div>
            <?php } ?>  







	   	</div>

		<!-- fecha o conteudo da pagina -->
		</div>

	<!-- fecha a row da tela toda -->
    </div>
<!-- fecha o container grandao da pagina     -->
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script type="text/javascript">
function save(fld) {
    const textAreaValue = fld.value;
    console.log(textAreaValue);
}
</script>

<script>

	// MOSTRA ESTRUTURA DE PERGUNTA CONFORME O TIPO SELECIONADO
	$(function() {
        $('#tiposelector').change(function(){
            $('.tipo').hide();
            $('#' + $(this).val()).show();
        });
    });

	// ADICIONA ALTERNATIVA
	$( "#addAlt" ).click(function() {
		$( "#alternativas" ).append('<tr class="table-light"><td class="col-11"><input type="text" name="op[]" class="form-control" required placeholder="Azul"></td><td class="col-1"><a class="btn btn-sm btn-danger excluir" onclick="return removerAlt(this);"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16"><path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/></svg></a></td></tr>' );
	});


	// REMOVER ALTERNATIVA
	function removerAlt(x){
		console.log('apagando');
		console.log(x);
		console.log(x.parentNode.parentNode);
    	x.parentNode.parentNode.remove();   		
	};


	// IMPEDE O ENVIO DO FORMULARIO SE NAO HOUVER NO MINIMO 2 ALTERNATIVAS
	function verificarAlternativas(){
		var rowCount = $('#alternativas tr').length;

		if(rowCount < 2){
			alert('Obrigatório ter no mínimo 2 alternativas para a pergunta.');
			return false;
		}
	}

    
</script>

  <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

</body>
</html>

