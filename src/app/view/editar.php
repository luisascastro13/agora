<?php
require_once '../dao/Nucleo.dao.php';
require_once '../model/Nucleo.class.php';

//busca o nucleo pelo id dele
$nucleo = NucleoDAO::buscarPorId($_GET['id']);

//como o resultado é um array, e um nucleo também é um array, preciso pegar somente o primeiro valor do array
$nucleoCerto = $nucleo[0];

//nome do nucleo e id do nucleo
$nome = $nucleoCerto['nome'];
$id = $nucleoCerto['id'];

//crio um novo objeto nucleo e settar os valores dele
$objNucleo = new Nucleo($nome);
$objNucleo->setId($id);
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

	    		<h1>Editar</h1>
	<a href="index.php">Voltar</a>

	<form action="../controller/Nucleo.controller.php?a=editarNomeNucleo" method="POST">
		<input type="hidden" name="id" value="<?=$id ?>" />
		<input name="nome" placeholder="Nome" value='<?=$nome ?>' />
		<input type="submit" value="Editar" />
	</form>

	<!-- NOVO USUARIO NA LISTA -->
	<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Inserir novo usuário</button>

	<!-- Modal -->
	<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

	<table>
		<tr>
			<th>Nome</th>
			<th colspan="2">Opções</th>
		</tr>

		<!-- listar todos usuarios do nucleo-->
		<?php 
		foreach (NucleoDAO::listarMembros($objNucleo) as $val)
			{ ?>
			<tr>
				<td><?= $val['nome_usuario'] ?></td>
				<td><a href="#">Editar</a></td>
				<td><a href="#" onclick="return confirm('Deseja excluir?')">Excluir</a></td>
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
</body>

</html>
