<?php

$link = mysqli_connect('localhost','useragora', '', 'agora');

if (!$link) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
else {

$resultadoSelect = mysqli_query($link, "SELECT * FROM assembleia");

	if($resultadoSelect){
		echo "<table id='tabelinha'><tr>
			<th>Nome</th>
			<th>Data</th>
			</tr>";

		while($linha = mysqli_fetch_assoc($resultadoSelect)){
			echo "<tr>
			<td>{$linha['nome']}</td>
			<td>{$linha['data']}</td>
			</tr>";
		}
	}
	else{
		echo "Error";
	}
}
?>

<html>
<style>

	#tabelinha{
		border: 1px solid black;
		width: 70%;
	}
	th { 
		text-align: left;
		border-bottom: 1px solid black;
	}

</style>


<body>

	<form method="post" action="inserir.php">
		<input type="text" name="nome" placeholder="Nome" required>
		<input type="date" name="data" placeholder="Data" required>
		<input type="submit">
	</form>
	

</body>	
</html>

