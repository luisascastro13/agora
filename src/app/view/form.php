<?php

require_once('../model/Usuario.class.php');

// faz a autenticacao do usuario. também insere o usuario no banco.
		
	$login = $_REQUEST['login'];
	$senha = $_REQUEST['senha'];	

	$tokenjson = file_get_contents("https://moodle.canoas.ifrs.edu.br/login/token.php?service=moodle_mobile_app&username=$login&password=$senha"); //pega o token da url a partir dos valores que o usuario inseriu como login e senha e salva na variavel como json

	$tokenphp = json_decode($tokenjson); //transforma o resultado mostrado em objeto de php

	//se o token existe, faz a conexão
	if(property_exists($tokenphp, "token")){
		
		// header('location:mostrar.php'); //direciona direto para a pagina "bemvindo.php"

		session_start();

		$token = ($tokenphp->token); //salva o token em uma variavel		

		$valoresjson= file_get_contents("https://moodle.canoas.ifrs.edu.br/webservice/rest/server.php?wstoken=$token&wsfunction=core_webservice_get_site_info&moodlewsrestformat=json"); //pega todas informacoes do usuario dono do token e salva na variavel

		$valoresphp = json_decode($valoresjson); //pega todo o valor e torna um objeto de php

		//print_r($valoresphp->fullname); //mostra o nome completo do usuario

		$_SESSION['primeironome'] = $valoresphp->firstname;
		$_SESSION['nomecompleto'] = $valoresphp->fullname;
		$_SESSION['userid'] = $valoresphp->userid;
		$_SESSION['urlfoto'] = $valoresphp->userpictureurl;
		$_SESSION['username'] = $valoresphp->username;

		$nomecompleto = $valoresphp->fullname;
		$username = $valoresphp->username;

		//faz a conexao com o banco
		$bd = new PDO('mysql:host=localhost;dbname=agora', 'useragora', '');

		if (!$bd) {
		    exit;
		}
		//se conexao com o banco tiver ok
		else {
			//verifica se o usuario ja existe no banco
			try{
				$bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$bd->beginTransaction();
					$comando = $bd->prepare('select * from usuario where login = :login');

				$res = $comando->execute(['login' => $_SESSION['username']]);

				$bd->commit();
						
				if ($res) {
					$record = $comando->fetchAll();

					//se o select retornar nenhuma linha, significa que o usuario nao esta cadastrado no banco. então o sistema faz a inserção de um novo usuário.
					if (count($record) == 0) {

						$bd->beginTransaction();
						$comando = $bd->prepare('insert into usuario (nome, login) values (:nome, :login)');

						$comando->execute(['nome' => $_SESSION['nomecompleto'], 'login'=>$_SESSION['username']]);

						$bd->commit();	
					}
				}
				header('Location: ../view/index.php');
			}
						
			//se houver algum erro na verificacao ou insercao de usuario no banco, gera uma exceção e desfaz as alteracoes no banco.
			catch(Exception $e){
				echo 'cheguei aqui';
				echo $e->getMessage();
				print_r($e->getTrace());
				$bd->rollback();
			}
		}
	}
	//se o token nao existe, manda mensagem de erro
	else{

		header('location: ../view/login.php?msg=1');
	}		
?>