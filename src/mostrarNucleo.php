<?php

require('mostrarUsuariosNucleo.php');
require('mostrarReunioes.php');


session_start();

echo 'Inserir novas pessoas ao núcleo:';

echo "<form method='post' action='inserirPessoaEmNucleo.php'>
			<input type='text' name='nome' placeholder='Nome da pessoa' required>
			<input type='submit' value='Inserir pessoa'>
		</form>";

echo 'Membros do núcleo:';

mostrarUsuariosNucleo();

echo '<h1>Assembleias</h1>
		
		<form method="post" action="inserirReuniao.php">
			<input type="text" name="nome" placeholder="Nome da reunião" required>
			<input type="datetime-local" name="data" placeholder="Data" required>
			<input type="submit" value="Criar nova reunião">
		</form>';
		

mostrarReunioes();

?>