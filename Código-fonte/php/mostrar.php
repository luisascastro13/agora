<?php

session_start();

	echo 'Nome completo: '.$_SESSION['nomecompleto'];
	echo '<br>IDUsuario: '.$_SESSION['userid'];
	echo '<br>Url da Foto do Usuário: '.$_SESSION['urlfoto'];

	echo '<br><a href="login.html">VOLTAR</a>';

?>