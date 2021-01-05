<?php

require('mostrarUsuariosNucleo.php');


session_start();

echo 'Inserir novas pessoas ao núcleo:';

echo "<form method='post' action='inserirPessoaEmNucleo.php'>
			<input type='text' name='nome' placeholder='Nome da pessoa' required>
			<input type='submit' value='Inserir pessoa'>
		</form>";

echo 'Membros do núcleo:';

mostrarUsuariosNucleo();


?>