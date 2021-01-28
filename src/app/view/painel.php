<?php
require_once '../dao/Usuario.dao.php';
require_once '../dao/Nucleo.dao.php';
require_once '../model/Usuario.class.php';

$conn =  new Conexao();

if (!$conn) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
else {
	// $_SESSION['conn'] = $conn;
	$usuario = new Usuario($_SESSION['username'], $_SESSION['nomecompleto'], null, null);
	
	// echo $usuario->getNome() . '<br>'. $usuario->getLogin();

	
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> -->

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

	    <!-- Font Awesome -->
	<link
	  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
	  rel="stylesheet"
	/>
	<!-- Google Fonts -->
	<link
	  href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
	  rel="stylesheet"
	/>
	<!-- MDB -->
	<link
	  href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.2.0/mdb.min.css"
	  rel="stylesheet"
	/>

	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Document</title>

	<style type="text/css">

		@import url("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css");

		/* até 768px ele esconde essas coisas */
		@media screen and (max-width: 768px) {
		   .navbarGrande{
		        display:none;
		   }
		}

		/* a partir de 769px ele mostra essas */
		@media screen and (min-width: 769px) {
		   .navbarPequena{
		        display:none !important;
		   }

		   #pagina{
		   	width: calc(100% - 180px);
		   }
		}

		.navbarGrande li{
		  margin-left: 1em;
		  padding-left: 0;
		}
		
	</style>
</head>
<body>

<!-- botao aciona navbar para grandes -->
<!-- <nav class="navbarGrande navbar navbar-light bg-info pr-0">
  <div class="container-fluid">   
  </div>
   <button class="navbar-toggler navbar-brand" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
       <i class="bi bi-list"></i>
    </button>    
</nav> -->

<div class="container-fluid m-0 p-0">
	<!-- TELA TODA -->
    <div class="row p-0 m-0">

    	<!-- NAVBAR GRANDES -->
        <div class="bg-primary navbarGrande pr-0 col-2" style="width: 180px;">

            <div class=" vh-100 fixed " id="navbarTogglerDemo02">

	            <ul class="navbar-nav m-auto mb-2 mb-lg-0">

	            	<li><a href="#"><img src="img/Loguinho.svg" class="mt-3" style="max-width: 80%;"></a></li>

	                <li class="nav-item w-50 mt-4 mb-3">
	                  <img src="https://moodle.canoas.ifrs.edu.br/pluginfile.php/32244/user/icon/boost/f1?rev=1351144" class="img-thumbnail rounded-circle border border-warning" alt="Foto de perfil">
	                </li>

	                <li class="nav-item text-light fw-bold"><?=$_SESSION['primeironome']?></li>
	                <li class="nav-item text-light fw-bold"><?=$usuario->getLogin()?></li>

	                <li><hr class="text-dark w-75"></li>

	                <li class="nav-item mb-3">
	                  <a class="nav-link active text-warning border border-warning rounded-pill mr-5 py-1" aria-current="page" href="#">
	                    <i class="bi bi-plus"></i>
	                  Criar</a>
	                </li>

	                <li class="nav-item ">
	                  <a class="nav-link active text-light" aria-current="page" href="painel.php">
	                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-easel" viewBox="0 0 16 16">
						  <path d="M8 0a.5.5 0 0 1 .473.337L9.046 2H14a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1h-1.85l1.323 3.837a.5.5 0 1 1-.946.326L11.092 11H8.5v3a.5.5 0 0 1-1 0v-3H4.908l-1.435 4.163a.5.5 0 1 1-.946-.326L3.85 11H2a1 1 0 0 1-1-1V3a1 1 0 0 1 1-1h4.954L7.527.337A.5.5 0 0 1 8 0zM2 3v7h12V3H2z"/>
						</svg>
	                    Painel
	                </a>
	                </li>


	                <li class="nav-item ">
	                  <a class="nav-link active text-light" aria-current="page" href="#">
	                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" class="bi bi-chat-square-text" viewBox="0 0 16 16">
	                      <path d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1h-2.5a2 2 0 0 0-1.6.8L8 14.333 6.1 11.8a2 2 0 0 0-1.6-.8H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2.5a1 1 0 0 1 .8.4l1.9 2.533a1 1 0 0 0 1.6 0l1.9-2.533a1 1 0 0 1 .8-.4H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/><path d="M3 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 6a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 6zm0 2.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"/>
	                    </svg>
	                    Participar
	                </a>
	                </li>


	                <li class="nav-item">
	                  <a class="nav-link active text-light" aria-current="page" href="#">

	                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" class="bi bi-files" viewBox="0 0 16 16"><path d="M13 0H6a2 2 0 0 0-2 2 2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h7a2 2 0 0 0 2-2 2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm0 13V4a2 2 0 0 0-2-2H5a1 1 0 0 1 1-1h7a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1zM3 4a1 1 0 0 1 1-1h7a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V4z"/></svg>

	                  Galeria</a>
	                </li>

	                <li class="nav-item">
	                  <a class="nav-link active text-light" aria-current="page" href="#">
	                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16"><path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z"/><path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z"/></svg>

	                  Configurações</a>
	                </li>

	                <li class="nav-item ">
	                	<a class="nav-link active text-light" aria-current="page" onclick="sair();">
		                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
		                      <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/> <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
		                    </svg>
	                  Sair</a>
	                </li>         
            	</ul>      
            </div>
        <!-- fecha o navbar lateral para disp. grandes -->
        </div>

        <!-- CONTEÚDO DA PÁGINA -->
	    <div id="pagina" class="container-fluid pl-md-4">

	    	<!-- barra de busca -->
		    <div class="row">
		    	<div class="col-12 col-md-8 col-lg-5">
		    		<form class="form-block mt-5 mb-4 d-flex justify-content-between">
					    <input class="form-control mr-sm-2" type="search" placeholder="Buscar" aria-label="Search">
					    <button class="btn btn-outline-info my-sm-0" type="submit">Buscar</button>
				  	</form>
		    	</div>
		    </div>

		    <!-- Modal NOVO NUCLEO-->
			<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLabel">Inserir novo núcleo</h5>
			        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			      </div>
			      <div class="modal-body">

			      <!-- inserir novo nucleo-->
			      	<form method="post" action='../controller/Nucleo.controller.php?a=inserir'>

			      		<!-- inserir novo nucleo -->
			      		<label>Nome:</label>
			      		<input type="text" name="nome">

				      </div>
				      <div class="modal-footer">	      
				        <input type='submit' class="btn btn-primary">
				    </form>
			      </div>
			    </div>
			  </div>
			</div>

		    <!-- botões nucleo -->
		    <div class="row">
			    <div class="col-12 col-md-8 col-lg-5">		    		
		    		<div class="d-flex justify-content-between">	
		    			<!-- novo nucleo Button trigger modal -->    		
						<button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">Inserir novo núcleo</button>
						<a href="#" type="button" class="btn btn-primary btn-sm">Ver todos</a>
					</div>

					<div>
					<!-- listar todos nucleos que o usuario está na lista-->
					<?php $i=0;
					foreach (array_reverse(NucleoDAO::listarNucleoUsuarioParticipa()) as $val)
						{?>
						<tr class="">
							<td><a href="visualizarNucleo.php?id=<?=$val['id']?>" class="d-block btn btn-warning text-truncate text-left mt-1" ><?= $val['nome'] ?></a></td>
						</tr>
						<?php
						if (++$i >= 3)
   							break;
						} ?>
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

<!-- navbar bottom-fixed para pequenos -->
<div class="navbar fixed-bottom d-flex bg-info navbarPequena" role="group" aria-label="Ações do usuário" style="height: 10%;">
  <a class="btn btn-lg btn-warning btn-floating position-absolute bottom-0 end-0 mb-4 mr-4" style="width: 56px; height: 56px;">
    <i class="bi bi-plus position-absolute top-50 start-50 translate-middle pb-2" style="font-size: 3.5em;"></i>
  </a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

<!-- MDB -->
<script
  type="text/javascript"
  src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.2.0/mdb.min.js"
></script>

<script>
	
	function sair(){
		if(confirm('Deseja sair?')){
			window.location = 	"../index.php";		
		}
	}

</script>

</body>
</html>

<?php } ?>