<?php
require_once '../model/Nucleo.class.php';
require_once '../model/Conexao.class.php';
require_once '../model/Reuniao.class.php';
require_once '../dao/Reuniao.dao.php';
require_once '../model/Usuario.class.php';
require_once '../model/ListaPresenca.class.php';
require_once '../dao/ListaPresenca.dao.php';
require_once '../model/Ata.class.php';
require_once '../dao/Ata.dao.php';

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

			if(isset($_POST['listaPresenca'])){
				//cria lista de presenca pra essa reuniao
				$listaPresenca = new ListaPresenca();
				$listaPresenca->setDescricao("");
				$idListaPresenca = ListaPresencaDAO::criarListaPresenca($listaPresenca);

				$listaPresenca->setId($idListaPresenca);
				$reuniao->setIdListapresenca($idListaPresenca);
				$erro = ReuniaoDAO::atualizarReuniao($reuniao);

				var_dump($reuniao);
				echo "<br><br><br>";
				var_dump($idListaPresenca);
				echo "<br><br><br>";
				var_dump($listaPresenca);

				if($erro != 0){
					echo "Erro na Lista de Presença: ".$erro;
				}
			}
			if(isset($_POST['ata'])){
				//cria ata pra essa reuniao
				$ata = new Ata();
				$ata->setDescricao("");
				$idAta = AtaDAO::criarAta($ata);

				$ata->setId($idAta);
				$reuniao->setIdAta($idAta);
				$erro = ReuniaoDAO::atualizarReuniao($reuniao);				

				var_dump($reuniao);
				echo "<br><br><br>";
				var_dump($idAta);
				echo "<br><br><br>";
				var_dump($ata);

				if($erro != 0){
					echo "Erro na Ata: ".$erro;
				}
				
				
			}
			if(isset($_POST['votacao'])){
				//cria votacao pra essa reuniao
			}

			// header("Location: ../view/visualizarReuniao.php?id=$id");
			break;
		


	}
}




?>