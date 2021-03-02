<?php

if(!isset($_SESSION)) 
    { 
        session_start(); 
    }

require('mostrarUsuariosNucleo.php');
require('mostrarReunioes.php');

echo '<a href="painel.php">PAINEL</a>';

$id_nucleo = $_GET['id_nucleo'];
echo '<br>CÓDIGO NÚCLEO: '.$id_nucleo;
// var_dump($_REQUEST);

echo '<br>Inserir novas pessoas ao núcleo:';
echo "<form method='post' action='inserirPessoaEmNucleo.php'>
			<input type='text' name='nome' placeholder='Nome da pessoa' required>
			<input type='submit' value='Inserir pessoa'>
			<input type='hidden' name='id_nucleo' value='$id_nucleo'>
		</form>";
	
echo 'Membros do núcleo:';
mostrarUsuariosNucleo($id_nucleo);


echo '<h1>Assembleias</h1>		
		<form method="post" action="inserirReuniao.php">
			<input type="text" name="nome" placeholder="Nome da reunião" required>
			<input type="datetime-local" name="data" placeholder="Data" required>
			<input type="submit" value="Criar nova reunião">
		</form>';
mostrarReunioes();

?>