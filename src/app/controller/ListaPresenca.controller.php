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
			// var_dump($_POST);
			// echo "$idReuniao";

			if(isset($_POST['select'])){

				// echo 'nao sou nada1';
				$nomeMembro = $_POST['select'];
				$matricula = $_POST['matricula'];
				$usuarios = array();

				if($nomeMembro == $_SESSION['nomecompleto']){
					echo 'nao sou nada2';
					if($matricula == $_SESSION['username']){

						echo 'nao sou nada3';
						// echo 'sim, pode confimar sua presenca<br>';

						ListaPresencaDAO::atualizarMembroPresente($reuniao->getIdListapresenca(), $matricula);					
						
						header("Location: ../view/visualizarReuniao.php?id=$idReuniao");
					}
					else{
						echo 'matricula não coincide com o nome do usuario, tente novamente.';
						header("Location: ../view/confirmarPresenca.php?id=$idReuniao&msg=1");
					}				
				}
				else{
					// echo 'nao pode confirmar a presença de outra pessoa<br>';
					header("Location: ../view/confirmarPresenca.php?id=$idReuniao&msg=2");
				}
			}
			else if(isset($_POST['convidado'])) {
			
				$idListaPresenca = $reuniao->getIdListapresenca();

				$nomeMembro = $_POST['nomecompleto'];
				$matricula = $_POST['matricula'];

				var_dump(ListaPresencaDAO::adicionarConvidadoPresente($idListaPresenca, $nomeMembro, $matricula));

				// echo 'nao pode confirmar a presença de outra pessoa<br>';
				header("Location: ../view/confirmarPresenca.php?id=$idReuniao");

				 


			}				

			break;
	}
}
else {
	echo 'ops nao passou nenhum parametro na url pra eu saber se devo inserir, editar ou eliminar';
}

?>