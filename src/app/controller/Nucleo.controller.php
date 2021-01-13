<?php 
require_once '../model/Nucleo.class.php';
require_once '../dao/Nucleo.dao.php';
require_once '../model/Conexao.class.php';
require_once '../model/Usuario.class.php';


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

			break;

		case 'editar':
		//edita o nome do nucleo
			$nucleo = new Nucleo($_POST['nome']);
			$nucleo->setId($_POST['id']);

		//insere no banco o novo nucleo
			NucleoDAO::editarNucleo($nucleo);

		echo 'lindja';
			break;

		case 'eliminar':
			break;
	}
}
else{
	echo 'ops nao passou nenhum parametro na url pra eu saber se devo inserir, editar ou eliminar';
}

header('Location: ../view/index.php');

?>