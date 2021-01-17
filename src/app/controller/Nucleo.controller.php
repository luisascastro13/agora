<?php 
require_once '../model/Nucleo.class.php';
require_once '../dao/Nucleo.dao.php';
require_once '../model/Conexao.class.php';
require_once '../model/Usuario.class.php';
require_once '../dao/Usuario.dao.php';

$conn = new Conexao();
$usuario = new Usuario($_SESSION['username'], $_SESSION['nomecompleto'], null, null);

if(ISSET($_GET['a'])){

	switch($_GET['a']){
		case 'inserir':
			//cria o nucleo com nome e adiciona o usuario à lista de adms.
			$nucleo = new Nucleo($_POST['nome']);

			//adiciona o usuário da sessão como adm do objeto nucleo criado;
			$nucleo->addListaAdm($usuario);		

			//insere no banco o novo nucleo
			$idNucleo = NucleoDAO::inserirNucleo($nucleo);

			//a partir do id (auto increment) retornado pela inserção, atualiza o id do objeto $nucleo com o respectivo valor.
			$nucleo->setId($idNucleo);

			//insere na tabela usuarios_frequentam_nucleo no banco
			NucleoDAO::inserirUsuarioAdmEmNucleo($nucleo, $usuario);

			header('Location: ../view/painel.php');

			break;

		case 'editarNomeNucleo':
			//edita o nome do nucleo e id
			$nucleo = new Nucleo($_POST['nome']);
			$nucleo->setId($_POST['id']);

			//atualiza no banco o nucleo
			NucleoDAO::editarNucleo($nucleo);

			header('Location: ../view/painel.php');

			break;

		case 'inserirMembro':
			//cria o nucleo e adiciona nome e id
			$nucleo = new Nucleo($_POST['nome']);
			$nucleo->setId($_POST['id']);

			$idNucleo = $_POST['id'];

			//cria um usuario com os valores passados pelo form
			// SETTAR O NUCLEO EM USUARIO!!!!!!!!
			$usuarioNovo = new Usuario(null, $_POST['nomeMembro'], null, null);

			//insere o membro na lista do objeto listaMembro da classe nucleo
			$nucleo->addListaMembro($usuarioNovo);

			//atualiza a tabela usuarios_frequentam_nucleo no banco com o usuario passado
			$idUsuarioEmNucleo = NucleoDAO::inserirUsuarioEmNucleo($nucleo, $usuarioNovo);

			$usuarioNovo->addListaNucleo($idNucleo, $idUsuarioEmNucleo);

			header("Location: ../view/visualizarNucleo.php?id=$idNucleo");

			break;

		case 'atribuirLoginAUsuario':

		// IMPORTANTE!!!!!
		// Não houve necessidade de verificar se o valor inserido é um login válido
		// Porque o campo é chave estrangeira de Usuario
		// Portanto, se o valor informado não existir no banco, o próprio MySQL retorna erro.

				$idUsuarioNucleo = $_POST['idUsuarioNucleo'];

				var_dump($_POST);
				
				//cria um nucleo
				$nucleo = new Nucleo($_POST['nomeNucleo']);
				$nucleo->setId($_POST['idNucleo']);
				$idNucleo = $_POST['idNucleo'];

				//pega o usuario que ja existe e altera o id, que antes era nulo, para id existente
				$usuarioNovo = new Usuario($_POST['login'], "nome", null, null);

				$usuarioNovo->addListaNucleo($nucleo, $idUsuarioNucleo);
				
				//atualiza o valor no banco
				$erro =	NucleoDAO::atribuirLoginAUsuario($idUsuarioNucleo, $usuarioNovo);

				if(strpos($erro, "constraint")){
					header("Location: ../view/visualizarNucleo.php?id=$idNucleo&msg=1");			
				}else{
					header("Location: ../view/visualizarNucleo.php?id=$idNucleo");
				}			
			break;		

		case 'eliminar':
			// 
			break;

		}
}
else{
	echo 'ops nao passou nenhum parametro na url pra eu saber se devo inserir, editar ou eliminar';
}



?>