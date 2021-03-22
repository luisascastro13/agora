<?php

require_once '../model/Reuniao.class.php';
require_once '../dao/Reuniao.dao.php';
require_once '../dao/Nucleo.dao.php';
require_once '../model/Nucleo.class.php';
require_once '../dao/Ata.dao.php';
require_once '../model/Ata.class.php';
require_once '../model/Conexao.class.php';
require_once '../dao/ListaPresenca.dao.php';

if(!ISSET($_SESSION)){
  session_start();
}

$usuario = new Usuario($_SESSION['username'], $_SESSION['nomecompleto'], null, null);

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
	    <div id="pagina" class="container-fluid pl-md-4 pb-5">

	   	<div class="row">

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

	   		
			<div id="texto" class="tipo" style="display:none;">
				<!-- EXEMPLO DE PERGUNTA TIPO TEXTO -->
		    	<div class="col-sm-6 col-lg-4 my-2">
				    <div class="card" style="width: 30rem;">
						<div class="card-header card-title ">
							<input id="tituloPergunta" class="card-title form-control" placeholder="Qual deveria ser o nome do mascote do IFRS Canoas?">
						</div>
						<div class="card-body">			        
							<textarea onchange="save(this);" onkeyup="save(this);" class="card-text form-control text-muted" id="descricaoPergunta">Seja criativo! </textarea>
							<div class="d-grid gap-2 mt-1">
								<a href="#" class="btn btn-warning btn-sm d-grid gap-2">Criar Pergunta</a>
							</div>     
						</div>
				    </div>
				</div>
			</div>


			<div id="multiplaescolha" class="tipo" style="display:none">
				<!-- EXEMPLO DE PERGUNTA TIPO MULTIPLA ESCOLHA -->
		    	<div class="col-sm-6 col-lg-4 my-2">
				    <div class="card" style="width: 30rem;">

						<div class="card-header card-title">
							<input id="tituloPergunta" class="card-title form-control" placeholder="Qual a melhor cor para a camiseta da gincana?">
						</div>

						<div class="card-body">

							<div class="d-flex justify-content-between ">
								<label class="form-label">Alternativas:</label>
								<button class="btn btn-sm btn-outline-warning" type="submit">Adicionar Alternativa</button>
							</div>

							<!-- SE SO TIVER DUAS ALTERNATIVAS, NAO PERMITIR EXCLUSAO -->
							<table class="table table-borderless table-sm">							
								<tbody class="row">
									<tr class="table-light">
										<td class="col-11"><input type="text" class="form-control" placeholder="Azul"></td>
										<td class="col-1">

											<button class="btn btn-sm btn-danger">
												<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
													<path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
												</svg>
											</button>											

										</td>
									</tr>
									<tr class="table-light">
										<td class="col-11"><input type="text" class="form-control input-sm" placeholder="Verde"></td>
										<td class="col-1">

											<button class="btn btn-sm btn-danger">
												<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
													<path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
												</svg>
											</button>
											

										</td>
									</tr>
									<tr class="table-light">
										<td class="col-11"><input type="text" class="form-control" placeholder="Verde"></td>
										<td class="col-1">

											<button class="btn btn-sm btn-danger">
												<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
													<path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
												</svg>
											</button>
											

										</td>
									</tr>									
								</tbody>
							</table>

							<div class="d-grid gap-2 mt-2">
								<a href="#" class="btn btn-warning btn-sm d-grid gap-2">Criar Pergunta</a>
							</div>				      
						</div>

				    </div>
				</div>				

			</div>
	   		
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
	$(function() {
        $('#tiposelector').change(function(){
            $('.tipo').hide();
            $('#' + $(this).val()).show();
        });
    });
</script>

  <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>


</body>
</html>

