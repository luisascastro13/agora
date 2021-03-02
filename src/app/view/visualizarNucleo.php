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
	    <div id="pagina" class="container-fluid pl-md-4">

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

				<!-- Redireciona para a tela de edição administrar usuários ADM-->
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
		Swal.fire({
		  text: "Você tem certeza de que deseja excluir?",
		  icon: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Sim, quero excluir.',
		  cancelButtonText: 'Não, manter usuário.'
		}).then((result) => {
		  if (result.isConfirmed){
		  	Swal.fire('Excluído!', '', 'success');		
		  	document.getElementById("idUFN").value = idUFN;	
			document.getElementById("theForm").submit();
		  }
		})	

	}
	function abrirModalNovaReuniao(){
		$("#novaReuniao").modal('show');
	}

</script>



</body>
</html>

<?php } ?>