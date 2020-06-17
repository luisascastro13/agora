<?php
		
	$login = $_REQUEST['login'];
	$senha = $_REQUEST['senha'];	

	$resultado = file_get_contents("https://moodle.canoas.ifrs.edu.br/login/token.php?service=moodle_mobile_app&username=$login&password=$senha"); //pega o token da url a partir dos valores que o usuario inseriu como login e senha e salva na variavel como json

	$resultado_final = json_decode($resultado); //transforma o resultado mostrado em objeto de php

	if(property_exists($resultado_final, "token")){

		session_start();

		$token = ($resultado_final->token); //salva o token em uma variavel		

		$resultado2 = file_get_contents("https://moodle.canoas.ifrs.edu.br/webservice/rest/server.php?wstoken=$token&wsfunction=core_webservice_get_site_info&moodlewsrestformat=json"); //pega todas informacoes do usuario dono do token e salva na variavel

		$resultado2_final = json_decode($resultado2); //pega todo o valor e torna um objeto de php

		//print_r($resultado2_final->fullname); //mostra o nome completo do usuario

		$_SESSION['nomecompleto'] = $resultado2_final->fullname;
		$_SESSION['userid'] = $resultado2_final->userid;
		$_SESSION['urlfoto'] = $resultado2_final->userpictureurl;

		echo '<a href="mostrar.php">MOSTRAR VALORES</a>';	
		echo '<br><a href="login.html">VOLTAR</a>';
	}

	else{
		echo "Usuário ou senha errado.";
		echo '<a href="login.html">VOLTAR</a>';
	}		
?>