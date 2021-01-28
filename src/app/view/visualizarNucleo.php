<?php
require_once '../dao/Nucleo.dao.php';
require_once '../model/Nucleo.class.php';
require_once '../dao/Reuniao.dao.php';
require_once '../model/Reuniao.class.php';

####### CRIA OBJETO NUCLEO ########

	//busca o nucleo pelo id dele
	$nucleo = NucleoDAO::buscarPorId($_GET['id']);

	//como o resultado é um array, e um nucleo também é um array, preciso pegar somente o primeiro valor do array
	$nucleoCerto = array_values($nucleo)[0];

	//nome do nucleo e id do nucleo
	$nome = $nucleoCerto['nome'];
	$id = $nucleoCerto['id'];

	//crio um novo objeto nucleo e settar os valores dele
	$objNucleo = new Nucleo($nome);
	$objNucleo->setId($id);

####### VERIFICA SE EXISTE MENSAGEM DE ERRO NA URL ########

	if(isset($_GET['msg'])){
		switch($_GET['msg']){
			case '1':
				echo '<script>alert("Opa! Login inválido!")</script>';
				break;
			case '2':
				echo '<script>alert("Opa! Este login já está em uso.")</script>';
				break;
			case '3':
				echo '<script>alert("Opa! Erro")';
				break;
		}		
	}

####### VERIFICA SE USUARIO_LOGADO É ADM DO NUCLEO #######

	//lista de todos membros do nucleo
	$membrosNucleo = NucleoDAO::listarMembros($objNucleo);

	$usuariosAdm = array();
	$login = $_SESSION['username'];
	$userAdm = false;

	foreach($membrosNucleo as $membro){
		if($membro[4] == 1){
			// imprime os ids dos usuarios adms
			// echo "Valor ". $membro[4]." no usuario: ". $membro[1]."<br>";
			
			// se o membro for adm, insere o usuario em um array de adms
			array_push($usuariosAdm, $membro);
			if($membro[1] == $login){
				$userAdm = true;
			}
		}						
	}	
	// echo 'todos membros do nucleo';
	// print("<pre>".print_r($membrosNucleo,true)."</pre>");


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

<!-- ######## ######## ######## -->
<!-- dispositivos pequenos -->
<!-- ######## ######## ######## -->
<!-- navbar em cima para pequenos -->
<nav class="navbarPequena navbar navbar-expand-lg navbar-light bg-primary mb-3 sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="#" style="max-width: 25%;">
            <img src="img/Loguinho.svg" style="max-width: 100%;">
        </a>
        <div class="dropdown">    
            <a class="btn shadow-none pr-0" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="https://moodle.canoas.ifrs.edu.br/pluginfile.php/32244/user/icon/boost/f1?rev=1351144" class="img-thumbnail rounded-circle border border-warning w-50 float-right" alt="Foto de perfil">
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                <li><a class="dropdown-item text-end" href="#">Configurações</a></li>
                <li><a class="dropdown-item text-end" href="#" onclick="sair();">Sair</a></li>
            </ul>
        </div>        
    </div>
</nav>
<!-- navbar bottom-fixed para pequenos -->
<div class="navbar fixed-bottom d-flex bg-info navbarPequena" role="group" aria-label="Ações do usuário" style="height: 10%;">
    <div class="input-group w-75 d-flex justify-content-between" id="menuBottomSM">
        
        <!-- painel -->
        <a class="nav-link active text-light" aria-current="page" href="painel.php">
            <svg xmlns="http://www.w3.org/2000/svg" width="1.5em"height="1.5em"fill="currentColor" class="bi bi-easel" viewBox="0 0 16 16">
              <path d="M8 0a.5.5 0 0 1 .473.337L9.046 2H14a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1h-1.85l1.323 3.837a.5.5 0 1 1-.946.326L11.092 11H8.5v3a.5.5 0 0 1-1 0v-3H4.908l-1.435 4.163a.5.5 0 1 1-.946-.326L3.85 11H2a1 1 0 0 1-1-1V3a1 1 0 0 1 1-1h4.954L7.527.337A.5.5 0 0 1 8 0zM2 3v7h12V3H2z"/>
            </svg>
        </a>
        <!-- nucleos -->
        <a class="nav-link active text-light" aria-current="page" href="#">
            <svg xmlns="http://www.w3.org/2000/svg" width="1.5em"height="1.5em"fill="currentColor" class="bi bi-people" viewBox="0 0 16 16">
              <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0zM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816zM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275zM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4z"/>
            </svg>
        </a>
        <!-- galeria -->
        <a class="nav-link active text-light" aria-current="page" href="#">
            <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" fill="currentColor" class="bi bi-files" viewBox="0 0 16 16">
                <path d="M13 0H6a2 2 0 0 0-2 2 2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h7a2 2 0 0 0 2-2 2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm0 13V4a2 2 0 0 0-2-2H5a1 1 0 0 1 1-1h7a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1zM3 4a1 1 0 0 1 1-1h7a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V4z"/>
            </svg>
        </a>
        <!-- buscar -->
        <a class="nav-link active text-light" aria-current="page" href="#">
            <svg xmlns="http://www.w3.org/2000/svg" width="1.5em"height="1.5em"fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
            </svg>
        </a>
    </div>        
    <!-- floating action button -->
    <a class="btn btn-lg btn-warning btn-floating position-absolute bottom-0 end-0 mb-4 mr-4" style="width: 56px; height: 56px;">
        <i class="bi bi-plus position-absolute top-50 start-50 translate-middle pb-2" style="font-size: 3.5em;"></i>
    </a>
</div>

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
	                  	<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people" viewBox="0 0 16 16">
                          <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0zM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816zM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275zM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4z"/>
                        </svg>
                      Núcleos</a>
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
	    <div id="pagina" class="container-fluid pl-md-4 mt-2" >

	<!-- CABEÇALHO -->
	<header>
		<span class="display-5"><?=$nome ?></span>
	</header>	

	<!-- BOTÃO NOVO USUARIO NA LISTA -->
	<button type="button" class="btn btn-primary" id="abrirModalNovoUsuario" onClick="abrirModalNovoUsuario()">Inserir novo usuário</button>

	<!-- Modal NOVO USUARIO -->
	<div class="modal fade" id="novoUsuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Inserir novo usuário</h5>
	        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	      </div>
	      <div class="modal-body">

	      <!-- inserir membro -->
	      	<form method="post" action='../controller/Nucleo.controller.php?a=inserirMembro'>

	      		<label>Nome:</label>
	      		<input type="text" name="nomeMembro">

	      		<!-- esse id que está sendo passado é o id do nucleo atual -->
	      		<input type="hidden" name="id" value="<?=$id ?>">
	      		<!-- esse nome é o nome do nucleo atual-->
	      		<input input type="hidden" name="nome" value="<?=$nome ?>">

		      </div>
		      <div class="modal-footer">	      
		        <input type='submit' class="btn btn-primary">
		    </form>
	      </div>
	    </div>
	  </div>
	</div>

	<!-- TABELA LISTAR MEMBROS -->
	<table id='minhaTabela'>

		<tr>
			<th>Nome</th>
			<th colspan="2">Login</th>
		</tr>

		<?php foreach (NucleoDAO::listarMembros($objNucleo) as $val){ ?>
			<tr>
				<!-- MOSTRA NOME E LOGIN DO USUARIO -->
				<td><?= $val['nome_usuario'] ?></td>
				<td ><?= $val['id_usuario'] ?></td>
				<!-- <td style="display:none"><?=$val['id'] ?></td> -->

				<?php
				$idezinho = $val['id'];
				$nomeUsuario = $val['nome_usuario']; ?>

				<!-- MOSTRA QUEM É ADM DO NUCLEO -->
				<?php if($val['usuario_adm']==1) { ?>
						<td>(Administrador)</td>
				<?php } ?>				

				<!-- SE USUARIO LOGADO FOR ADM, EXCLUSAO DE MEMBROS que não sao adm-->
				<?php if($userAdm == true){ ?>				

					<?php if($val['usuario_adm']==0) { ?>					
						<td><button type="button" class="btn btn-outline-warning btn-sm" onClick="excluirUsuario(<?=$idezinho ?>)">Excluir</button></td>
					<?php } ?>	
										
				<?php } ?>

				<!-- SE O USUARIO DA LINHA NAO TIVER LOGIN, MOSTRAR BOTAO PARA ATRIBUIR LOGIN -->
				<?php if($val['id_usuario'] == null){ ?>
					<!-- SE USUARIO ESCOLHIDO NÃO TIVER LOGIN, MOSTRA ESSE BOTÃO -->
					<td><button type="button" class="btn btn-outline-warning btn-sm" onClick="abrirModalLogin(<?=$idezinho ?>)">Atribuir usuário</button></td>
				<?php } ?>

			</tr>
		<?php } ?>
	</table>

	<!-- Modal ATRIBUIR LOGIN-->
	<div class="modal fade" id="atribuirLoginModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Atribuir usuário a login existente</h5>
	        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	      </div>
	      <div class="modal-body">

	      <!-- atribuir usuario ao login-->
	      	<form method="post" action="../controller/Nucleo.controller.php?a=atribuirLoginAUsuario">

	      		<label>Login:</label>
	      		<input type="text" name="login">

	      		<input type="hidden" name="nomeNucleo" value="<?=$nucleoCerto['nome'] ?>">

	      		<input type="hidden" name="idNucleo" value="<?=$nucleoCerto['id'] ?>">
	      	      		
	      		<input id="inputIdUsuarioNucleo" type="hidden" name="idUsuarioNucleo" value="">

		      </div>
		      <div class="modal-footer">     
		        <input type='submit' id="visualizarDados" class="btn btn-primary">
		    </form>
	      </div>
	    </div>
	  </div>
	</div>

	<!-- Modal EDITAR USUARIO -->
	<div class="modal fade" id="editarUsuarioModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Editar Usuario</h5>
	        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	      </div>
	      <div class="modal-body">

	      <!-- atribuir usuario ao login-->
	      	<form method="post" action="../controller/Nucleo.controller.php?a=atribuirLoginAUsuario">

	      		<label>Login:</label>
	      		<input type="text" name="login">

	      		<input type="hidden" name="nomeNucleo" value="<?=$nucleoCerto['nome'] ?>">

	      		<input type="hidden" name="idNucleo" value="<?=$nucleoCerto['id'] ?>">
	      	      		
	      		<input id="inputIdUsuarioNucleo" type="hidden" name="idUsuarioNucleo" value="">

		      </div>
		      <div class="modal-footer">     
		        <input type='submit' id="visualizarDados" class="btn btn-primary">
		    </form>
	      </div>
	    </div>
	  </div>
	</div>

	<!-- FORMULARIO INVISIVEL QUE PERMITE EXCLUSAO DE USUARIOS -->
	<form style="display: none" id='theForm' method="post" action="../controller/Nucleo.controller.php?a=removerUsuario">
		<input id="idUFN" name="idUFN" value="">
		<input name="idNucleo" value="<?=$nucleoCerto['id'] ?>">		
		<input type="submit">
	</form>

	<!-- FUNCIONALIDADES VISÍVEIS SOMENTE PARA ADMS -->
	<?php if($userAdm == true){ ?>

		<!-- Redi<reciona para a tela de edição administrar usuários ADM-->
		<a class="btn btn-warning" href="editarNucleo.php?id=<?=$nucleoCerto['id'] ?>">Editar Núcleo</a>

		<!-- BOTÃO CRIAR REUNIÃO (abre modal Nova Reuniao) -->
		<button type="button" class="btn btn-primary" onClick="abrirModalNovaReuniao()">Criar Reunião</button>

	<?php } ?>	

	<!-- Modal NOVA REUNIÃO -->
	<div class="modal fade" id="novaReuniao" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Nova Reunião</h5>
	        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	      </div>
	      <div class="modal-body">
	     
	      	<form method="post" action="../controller/Reuniao.controller.php?a=inserir">

	      		<!-- INFORMACOES DA REUNIAO -->
	      		<!-- NOME DA REUNIAO -->
	      		<div class="input-group mb-3">
					<div class="input-group-prepend">
				    	<span class="input-group-text" id="basic-addon1">Nome da reunião: </span>
				  	</div>
					<input type="text" class="form-control" placeholder="Reunião mensal" aria-label="Username" aria-describedby="basic-addon1" name="nome" required>
				</div>

				<div class="input-group mb-3">
					<span class="input-group-text">Data e Horário</span>
					<input type="date" aria-label="Data" class="form-control" name="data" required>
					<input type="time" aria-label="Horário" class="form-control" name="horario" required>
				</div>

				<!-- Descricao -->
				<div class="input-group mb-3">
			  		<div class="input-group-prepend">
			   			<span class="input-group-text">Descrição</span>
			  		</div>
			  		<textarea class="form-control" name="descricao"></textarea>
				</div>

				<h5 id="exampleModalLabel">Documentos</h5>
				<!-- DOCUMENTOS QUE GOSTARIA DE CRIAR  -->
	      		<div class="form-check">
					<input class="form-check-input" name="ata" type="checkbox" value="" id="ata" <?php if (isset($ata)) echo "checked";?>>
				  	<label class="form-check-label" for="ata">Ata</label>
				</div>
				<div class="form-check">
				  	<input class="form-check-input" name="listaPresenca" type="checkbox" value="" id="listaPresenca" <?php if (isset($listaPresenca)) echo "checked";?>>
				  	<label class="form-check-label" for="listaPresenca">Lista de Presença</label>
				</div>
				<div class="form-check">
				  	<input class="form-check-input" name="votacao" type="checkbox" value="" id="votacao" <?php if (isset($votacao)) echo "checked";?>>
				  	<label class="form-check-label" for="votacao">Votação</label>
				</div>

				<!-- INPUTS INVISIVEIS PARA PASSAR ID DO NUCLEO -->
	      		<input type="hidden" name="nomeNucleo" value="<?=$nucleoCerto['nome'] ?>">
	      		<input type="hidden" name="idNucleo" value="<?=$nucleoCerto['id'] ?>">
	    
		      </div>
		      <div class="modal-footer">     
		        <input type='submit' id="novaReuniao" class="btn btn-primary" value="Criar Nova Reunião">
		    </form>

	      </div>
	    </div>
	  </div>
	</div>

	<!-- TABELA LISTAR REUNIÕES -->
	<table id='minhaTabelaReunioes'>
		<h3>Reuniões</h3>
		<tr>
			<th>Reunião</th>
			<th>Data</th>			
		</tr>

		<?php $reunioesNucleo = array(); ?>
			<tr>
			<?php foreach (ReuniaoDAO::listarReunioes() as $val){
				if($val[9] == $nucleoCerto['id']){
					array_push($reunioesNucleo, $val); 
					$data = date_create($val[3]);
					$dataFormatada = date_format($data, 'd/m/Y H:i');
					$idReuniao = $val[0];			
					?>

					<td><a href="visualizarReuniao.php?id=<?=$val[0] ?>"><?=$val[1] ?></a></td>
					<td><?=$dataFormatada ?></td>
				<?php } ?>
			</tr>
		<?php } ?>
	</table>

	    	


		<!-- fecha o conteudo da pagina -->
		</div>
	<!-- fecha a row da tela toda -->
    </div>

<!-- fecha o container grandao da pagina     -->
</div>

<!-- navbar bottom-fixed para pequenos -->
<div class="navbar fixed-bottom d-flex bg-info navbarPequena" role="group" aria-label="Ações do usuário" style="height: 10%;">

	<div class="input-group w-75 d-flex justify-content-between" id="menuBottomSM">
		
		<!-- painel -->
		<a class="nav-link active text-light" aria-current="page" href="painel.php">
	        <svg xmlns="http://www.w3.org/2000/svg" width="1.5em"height="1.5em"fill="currentColor" class="bi bi-easel" viewBox="0 0 16 16">
			  <path d="M8 0a.5.5 0 0 1 .473.337L9.046 2H14a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1h-1.85l1.323 3.837a.5.5 0 1 1-.946.326L11.092 11H8.5v3a.5.5 0 0 1-1 0v-3H4.908l-1.435 4.163a.5.5 0 1 1-.946-.326L3.85 11H2a1 1 0 0 1-1-1V3a1 1 0 0 1 1-1h4.954L7.527.337A.5.5 0 0 1 8 0zM2 3v7h12V3H2z"/>
			</svg>
		</a>

		<!-- nucleos -->
		<a class="nav-link active text-light" aria-current="page" href="#">
			<svg xmlns="http://www.w3.org/2000/svg" width="1.5em"height="1.5em"fill="currentColor" class="bi bi-people" viewBox="0 0 16 16">
			  <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0zM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816zM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275zM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4z"/>
			</svg>
		</a>

		<!-- galeria -->
		<a class="nav-link active text-light" aria-current="page" href="#">
			<svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" fill="currentColor" class="bi bi-files" viewBox="0 0 16 16">
				<path d="M13 0H6a2 2 0 0 0-2 2 2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h7a2 2 0 0 0 2-2 2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm0 13V4a2 2 0 0 0-2-2H5a1 1 0 0 1 1-1h7a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1zM3 4a1 1 0 0 1 1-1h7a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V4z"/>
			</svg>
		</a>

		<!-- buscar -->
		<a class="nav-link active text-light" aria-current="page" href="#">
			<svg xmlns="http://www.w3.org/2000/svg" width="1.5em"height="1.5em"fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
  				<path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
			</svg>
		</a>
	</div>	    


	<!-- floating action button -->
	<a class="btn btn-lg btn-warning btn-floating position-absolute bottom-0 end-0 mb-4 mr-4" style="width: 56px; height: 56px;">
		<i class="bi bi-plus position-absolute top-50 start-50 translate-middle pb-2" style="font-size: 3.5em;"></i>
	</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

<!-- MDB -->
<script
  type="text/javascript"
  src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.2.0/mdb.min.js"
></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
	
	 function sair(){
        Swal.fire({
          text: "Você tem certeza de que deseja sair?",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Sim, quero sair.',
          cancelButtonText: 'Não, voltar.'
        }).then((result) => {
          if (result.isConfirmed){
            window.location =   "../index.php";   
          }
        })      
    }
	function abrirModalLogin(idUFN){
		$("#atribuirLoginModal").modal('show');
		document.getElementById("inputIdUsuarioNucleo").value = idUFN;
	}

	function abrirModalNovoUsuario(){
		$("#novoUsuario").modal('show');
	}

	function excluirUsuario(idUFN){
		if(confirm('Deseja excluir?')){
			document.getElementById("idUFN").value = idUFN;	
			document.getElementById("theForm").submit();			
		}	
	}
	function abrirModalNovaReuniao(){
		$("#novaReuniao").modal('show');
	}



</script>



</body>
</html>

<?php } ?>