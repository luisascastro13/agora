<?php
require_once '../dao/Nucleo.dao.php';
require_once '../model/Nucleo.class.php';

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
				echo '<script>alert("Opa! Login inválido.")</script>';
				break;
			case '2':
				echo '<script>alert("Opa! Este login já está em uso.")</script>';
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
			// echo "<br>Valor ". $membro[4]." no usuario: ". $membro[1];
			
			// se o membro for adm, insere o usuario em um array de adms
			array_push($usuariosAdm, $membro);
			if($membro[1] == $login){
				$userAdm = true;
			}
		}						
	}

	
	// echo 'todos membros do nucleo';
	// print("<pre>".print_r($membrosNucleo,true)."</pre>");

?>

<html>
<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<meta charset="UTF-8" />
</head>
<body>

	<!-- CABEÇALHO -->
	<header>
		<h1>Núcleo:</h1>
		<h2><?=$nome ?></h2>
		<h1>Editar</h1>
		<a href="painel.php">Voltar</a>
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
				<td><?= $val['nome_usuario'] ?></td>
					<td ><?= $val['id_usuario'] ?></td>
					<!-- <td><?= $val['id'] ?></td> -->

					<?php
					$idezinho = $val['id'];
					$nomeUsuario = $val['nome_usuario'];
					?>

					<td>
						<?php if($userAdm == true){
							if($val['id_usuario'] == null){ ?>
							<!-- SE USUARIO ESCOLHIDO NÃO TIVER LOGIN, MOSTRA ESSE BOTÃO -->
								<button type="button" class="btn btn-outline-warning btn-sm" onClick="abrirModalLogin(<?=$idezinho ?>)">Atribuir usuário</button>
							<?php } ?>

							<!-- <td><a href="#" onclick="return confirm('Deseja excluir?')">Excluir</a></td> -->
						<?php } ?>						
					</td>				
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

	<?php if($userAdm == true){ ?>
		<a class="btn btn-warning" href="editarNucleo.php?id=<?=$nucleoCerto['id'] ?>">Editar Núcleo</a>
	<?php } ?>  	


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
<script>
	function abrirModalLogin(idUFN){
		$("#atribuirLoginModal").modal('show');
		document.getElementById("inputIdUsuarioNucleo").value = idUFN;
	}
	function abrirModalNovoUsuario(){
		$("#novoUsuario").modal('show');
	}
</script>

</body>

</html>
