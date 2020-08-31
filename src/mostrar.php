<?php

session_start();

	echo 'Primeiro nome: '.$_SESSION['primeironome'];
	echo '<br>Nome completo: '.$_SESSION['nomecompleto'];
	echo '<br>IDUsuario: '.$_SESSION['userid'];
	echo '<br>Url da Foto do Usuário: '.$_SESSION['urlfoto'];

	echo '<br><a href="login.html">VOLTAR</a>';

?>