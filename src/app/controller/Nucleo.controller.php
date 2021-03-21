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

			if(strpos($idNucleo, "constraint")){
				header("Location: ../view/painel.php?id=&msg=1");	
			}

			//a partir do id (auto increment) retornado pela inserção, atualiza o id do objeto $nucleo com o respectivo valor.
			$nucleo->setId($idNucleo);		

			$id = NucleoDAO::inserirUsuarioEmNucleo($nucleo, $usuario);
			NucleoDAO::inserirUsuarioAdmEmNucleo($nucleo, $usuario);


			header("Location: ../view/visualizarNucleo.php?id=$idNucleo");

			break;

		case 'editarNomeNucleo':
			//edita o nome do nucleo e id
			$nucleo = new Nucleo($_POST['nome']);
			$nucleo->setId($_POST['id']);
			$idNucleo = $_POST['id'];


			//atualiza no banco o nucleo
			$erro = NucleoDAO::editarNucleo($nucleo);

			if(strpos($erro, "constraint")){
				header("Location: ../view/editarNucleo.php?id=$idNucleo&msg=2");
			}
			else{
				header("Location: ../view/visualizarNucleo.php?id=$idNucleo");
			}
	

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
			$login = $_POST['login'];

			// var_dump($_POST);
			
			//cria um nucleo
			$nucleo = new Nucleo($_POST['nomeNucleo']);
			$nucleo->setId($_POST['idNucleo']);
			$idNucleo = $_POST['idNucleo'];

			//verifica se o login já esta sendo utilizado por algum usuário
			$membros = NucleoDAO::listarMembros($nucleo);
			$loginDosMembros = array();

			foreach($membros as $membro){
				array_push($loginDosMembros, $membro[1]);				
			}
			
			if(in_array($login, $loginDosMembros)){
				header("Location: ../view/visualizarNucleo.php?id=$idNucleo&msg=2");
			}
			else{
				//pega o usuario que ja existe e altera o id, que antes era nulo, para id existente
				$usuarioNovo = new Usuario($_POST['login'], "nome", null, null);

				$usuarioNovo->addListaNucleo($nucleo, $idUsuarioNucleo);
				
				//atualiza o valor no banco
				$erro =	NucleoDAO::atribuirLoginAUsuario($idUsuarioNucleo, $usuarioNovo);

				if(strpos($erro, "constraint")){
					header("Location: ../view/visualizarNucleo.php?id=$idNucleo&msg=1");	

				}			
				else{
					header("Location: ../view/visualizarNucleo.php?id=$idNucleo");
				}
			}		
			break;		

		case 'eliminar':
			// 
			break;

		case 'addAdm':

			//cria o nucleo e adiciona nome e id
			$nucleo = new Nucleo($_POST['nome']);
			$nucleo->setId($_POST['id']);
			$idNucleo = $_POST['id'];

			// primeira coisa a se fazer é verificar se o login já não está na tabela

			//lista de todos membros do nucleo
			$membrosNucleo = NucleoDAO::listarMembros($nucleo);
			$usuariosAdm = array();
			foreach($membrosNucleo as $membro){
				if($membro[4] == 1){
					// se o membro for adm, insere o usuario em um array de adms
					array_push($usuariosAdm, $membro);
				}						
			}
			// cria novo usuario a partir dos valores da session do usuario logado
			$usuario = new Usuario($_POST['login'], "", null, null);

			// se o id do usuario logado estiver na lista de usuarios adm, setta a variavel pra trues
			if(in_array(intval($usuario->getLogin()), $usuariosAdm[0])){
			 	// usuario já é ADM
				header("Location: ../view/editarNucleo.php?id=$idNucleo&msg=1");	
			}
			else{
				// usuário não é ADM
				// atualiza tabela usuarios_frequentam_nucleo no banco com adm = 1
				$erro = NucleoDAO::inserirUsuarioAdmEmNucleo($nucleo, $usuario);

				if(strpos($erro, "constraint")){
					header("Location: ../view/editarNucleo.php?id=$idNucleo&msg=1");
				}			
				else{
					header("Location: ../view/editarNucleo.php?id=$idNucleo");
				}
			}
			break;

		case 'removerAdm':

			$idUsuario = $_POST['idUsuario'];
			$usuarioAdmRemovido = new Usuario($idUsuario, "", null, null);

			$idNucleo = $_POST['idNucleo'];
			$nucleo = new Nucleo("");
			$nucleo->setId($idNucleo);

			$erro = NucleoDAO::removerUsuarioAdmEmNucleo($nucleo, $usuarioAdmRemovido);

			if(isset($erro)){
				header("Location: ../view/visualizarNucleo.php?id=$idNucleo");
			}
			else{
				header("Location: ../view/visualizarNucleo.php?id=$idNucleo");
			}			
			break;

		case 'removerUsuario':
			$idNucleo = $_POST['idNucleo'];

			$idUsuarioNucleo = $_POST['idUFN'];
			$erro = NucleoDAO::removerUsuarioEmNucleo($idUsuarioNucleo);
			header("Location: ../view/visualizarNucleo.php?id=$idNucleo");
			break;

		case 'excluirNucleo':
			$nucleo = new Nucleo('');
			$nucleo->setId($_POST['idNucleoExcluido']);		

			NucleoDAO::deletarNucleo($nucleo);

			header("Location: ../view/painel.php");
			break;
	}
}
else{
	echo 'ops nao passou nenhum parametro na url pra eu saber se devo inserir, editar ou eliminar';
}



?>