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

####### VERIFICA SE USUARIO_LOGADO É ADM DO NUCLEO #######

	//lista de todos membros do nucleo
	$membrosNucleo = NucleoDAO::listarMembros($objNucleo);

	$usuariosAdm = array();
	$login = $_SESSION['username'];
	$userAdm = false;

	foreach($membrosNucleo as $membro){
		if($membro[4] == 1){
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

####### VERIFICA SE EXISTE MENSAGEM DE ERRO NA URL #######

	if(isset($_GET['msg'])){
		switch($_GET['msg']){
			case '1':
				echo '<script>alert("Opa! Login inválido.")</script>';
				break;					
		}		
	}

?>

<html>
<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<meta charset="UTF-8" />
</head>

<header>
	<a href="visualizarNucleo.php?id=<?=$nucleoCerto['id'] ?>">Voltar</a>
</header>

<body>

	<h1><?=$nucleoCerto['nome'];?></h1>

	<h3>1. ALTERAR NOME DO NÚCLEO</h3>
	<form method="post" action="../controller/Nucleo.controller.php?a=editarNomeNucleo">
		<input type="text" name="nome" value="<?=$nucleoCerto['nome']?>">
		<input type="hidden" name="id" value="<?=$nucleoCerto['id']?>">
		<input type="submit" value="Alterar nome do núcleo">
	</form>

	<h3>2. ADMINISTRADORES</h3>
	<!-- TABELA LISTAR ADMS -->
	<table id='minhaTabela'>
		<h4>Administradores do Núcleo</h4>
		<tr><th>Nome</th><th colspan="2">Opções</th></tr>

		<?php foreach ($usuariosAdm as $val){ ?>
				<tr>
					<!-- MOSTRA NOME E LOGIN DOS USUARIOS ADM -->
					<td><?= $val['nome_usuario'] ?></td>
					<td><?= $val['id_usuario'] ?></td>

					<!-- SE O NUCLEO TIVER UM UNICO ADM, NAO PODE EXCLUÍ-LO -->
					<?php if(count($usuariosAdm) > 1){ ?>
						<td><button type="submit" class="btn btn-outline-warning" onClick="removerUsuarioAdm(<?= $val['id_usuario']?>)">Excluir ADM</button></td>
					<?php } ?>
							
				</tr>
			</form>
		<?php } ?>
	</table>

	<!-- INSERIR NOVO ADM AO NUCLEO -->
	<button type="button" class="btn btn-secondary" id="abrirModalNovoUsuarioAdm" onClick="abrirModalNovoUsuarioAdm()">Inserir novo usuário ADM</button>

	<!-- Modal NOVO USUARIO ADM -->
	<div class="modal fade" id="novoUsuarioAdm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Inserir novo usuário ADM</h5>
	        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	      </div>
	      <div class="modal-body">

	      <!-- inserir membro -->
	      	<form method="post" action='../controller/Nucleo.controller.php?a=addAdm'>

	      		<label>Login:</label>
	      		<input type="text" name='login'>

	      		<input type="hidden" name="id" value="<?=$id ?>">
	      		<input type="hidden" name="nome" value="<?=$nome ?>">
	      		
		      </div>
		      <div class="modal-footer">	      
		        <input type='submit' class="btn btn-primary">
		    </form>
	      </div>
	    </div>
	  </div>
	</div>

	<!-- FORMULARIO INVISIVEL QUE PERMITE EXCLUSAO DE ADMS -->
	<form style="display: none" id='theForm' method="post" action="../controller/Nucleo.controller.php?a=removerAdm">
		<input id="idUsuario" name="idUsuario">
		<input name="idNucleo" value="<?=$nucleoCerto['id']; ?>">
		<input type="submit">
	</form>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
<script>
	function abrirModalNovoUsuarioAdm(){
		$("#novoUsuarioAdm").modal('show');
	}

	function removerUsuarioAdm(id){
		if(confirm('Deseja excluir? ID: ' + id)){
			document.getElementById("idUsuario").value = id;	
			document.getElementById("theForm").submit();			
		}					
	}
</script>


</body>

</html>