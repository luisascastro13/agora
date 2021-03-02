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
	$idNucleo = $nucleoCerto['id'];

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


############# CRIA CONEXAO E USUARIO LOGADO
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

   		<a href="visualizarNucleo.php?id=<?=$idNucleo?>" class="d-block">VOLTAR</a>

		<span class="display-4">Alterar nome do núcleo</span>
		<form method="post" class="input-group w-75" action="../controller/Nucleo.controller.php?a=editarNomeNucleo">
			<input type="text" name="nome" class="form-control" value="<?=$nucleoCerto['nome']?>">
			<input type="hidden" name="id" value="<?=$nucleoCerto['id']?>">
			<input type="submit" class="btn btn-warning" value="Alterar nome do núcleo">
		</form>

		<span class="display-3">Administradores</span>
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
		<button type="button" class="btn btn-primary" id="abrirModalNovoUsuarioAdm" onClick="abrirModalNovoUsuarioAdm()">Inserir novo usuário ADM</button>

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

		<!-- fecha o conteudo da pagina -->
		</div>

	<!-- fecha a row da tela toda -->
    </div>
<!-- fecha o container grandao da pagina     -->
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

<script src="https://code.jquery.com/jquery-1.9.1.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

<!-- MDB -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.2.0/mdb.min.js"
></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js"></script>

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
		  	window.location = 	"../index.php";	
		  }
		})		
	}
	function abrirModalNovoUsuarioAdm(){
		$("#novoUsuarioAdm").modal('show');
	}

	function removerUsuarioAdm(id){

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
		  	document.getElementById("idUsuario").value = id;	
			document.getElementById("theForm").submit();
		  }
		})	
						
	}


</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10">
</script>

</body>
</html>
<?php } ?>