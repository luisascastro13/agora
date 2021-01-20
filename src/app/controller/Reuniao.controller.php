<?php
require_once '../model/Nucleo.class.php';
require_once '../model/Conexao.class.php';
require_once '../model/Reuniao.class.php';
require_once '../dao/Reuniao.dao.php';
require_once '../model/Usuario.class.php';

$conn = new Conexao();
$usuario = new Usuario($_SESSION['username'], $_SESSION['nomecompleto'], null, null);

if(ISSET($_GET['a'])){
	switch($_GET['a']){
		case 'inserir':	

			// Salva em variáveis os valores passados pelo formulário
			$nome = $_POST['nome'];
			$data = $_POST['data'];
			$horario = $_POST['horario'];
			$descricao = $_POST['descricao'];

			// Formata o horario para inserir no banco
			$datahora = $data." ".$horario.":00";

			// cria objeto reuniao com valores
			$reuniao = new Reuniao($nome, $datahora);
			$reuniao->setDescricao($descricao);

			// insere o administrador da reuniao como sendo o usuario logado
			$reuniao->setIdusuarioadm($_SESSION['username']);			

			// insere a reuniao no banco e puxa o id;
			$id = ReuniaoDAO::inserirReuniao($reuniao);

			// setta o id conforme o retornado pela funcao inserirReuniao()
			$reuniao->setCodigo($id);
			$reuniao->setIdNucleo($_POST['idNucleo']);

			$erro = ReuniaoDAO::atualizarReuniao($reuniao);			
			break;
		


	}
}




?>