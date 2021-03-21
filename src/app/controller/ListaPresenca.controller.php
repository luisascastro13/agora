<?php
require_once '../model/Conexao.class.php';
require_once '../model/Usuario.class.php';
require_once '../model/Ata.class.php';
require_once '../dao/Ata.dao.php';
require_once '../dao/Reuniao.dao.php';
require_once '../dao/Usuario.dao.php';
require_once '../dao/ListaPresenca.dao.php';

if(!ISSET($_SESSION)){
	session_start();
}

$conn = new Conexao();
$usuario = new Usuario($_SESSION['username'], $_SESSION['nomecompleto'], null, null);

########## CRIA OBJETO REUNIAO ###########
$idReuniao = $_GET['idReuniao'];
$reuniao = ReuniaoDAO::buscarPorId($_GET['idReuniao']);

if(ISSET($_GET['a'])){
	switch($_GET['a']){
		case 'confirmarPresenca':
			var_dump($_POST);

			$nomeMembro = $_POST['select'];
			$matricula = $_POST['matricula'];
			$usuarios = array();

			foreach (UsuarioDAO::listarUsuario() as $membro){				
				if($membro['nome'] == $nomeMembro){					
					if($matricula == $membro['login']){
						echo "igual";
						// MUDAR A TABELA PRESENCA
						// ALTERAR PRESENTE PARA 1 CONFORME O NUMERO DO ID_USUARIO (MATRICULA)

						ListaPresencaDAO::atualizarMembroPresente($reuniao->getIdListapresenca(), $matricula);
					}
					else{
						echo 'diferente';

						// ENVIAR MENSAGEM DE ERRO PRO USUARIO NA PAGINA ANTERIOR
						// JA QUE A MATRICULA NAO É A MESMA À DO USUARIO
						// header();
					}
				}

			}

			break;
	}
}
else{
	echo 'ops nao passou nenhum parametro na url pra eu saber se devo inserir, editar ou eliminar';
}

?>