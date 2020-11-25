<?php
		
	$login = $_REQUEST['login'];
	$senha = $_REQUEST['senha'];	

	$tokenjson = file_get_contents("https://moodle.canoas.ifrs.edu.br/login/token.php?service=moodle_mobile_app&username=$login&password=$senha"); //pega o token da url a partir dos valores que o usuario inseriu como login e senha e salva na variavel como json

	$tokenphp = json_decode($tokenjson); //transforma o resultado mostrado em objeto de php

	if(property_exists($tokenphp, "token")){
		
		header('location:mostrar.php'); //direciona direto para a pagina "bemvindo.php"

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

		$link = mysqli_connect('localhost','useragora', '', 'agora');

		if (!$link) {
		    echo "Error: Unable to connect to MySQL." . PHP_EOL;
		    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
		    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
		    exit;
		}

		else {

			$query = mysqli_query($link, "select * from usuario where username = '$username'");

			$numrows = mysqli_num_rows($query);

			if($numrows==0){
				mysqli_query($link, "INSERT INTO usuario (nomecompleto, username) VALUES ('$nomecompleto','$username')");
				echo 'inseri';
			}	
		}
	}
	else{

		header('location:login.php?msg=1');
	}		
?>