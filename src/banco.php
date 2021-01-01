<?php



$bd = new PDO('mysql:host=localhost;dbname=agora', 'useragora', '');

if (!$bd) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
else {

	try{
		$bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$bd->beginTransaction();
			$comando = $bd->prepare('SELECT * FROM reuniao');
			$comando->execute([]);
		$bd->commit();

		if($comando){
			echo  "<table id='tabelinha'><tr>
			<th>Nome da reunião</th>
			<th>Data</th>
			</tr>";

			while($linha = $comando->fetch(PDO::FETCH_ASSOC)){
				echo "<tr>
			<td><a href='saibamais.php'>{$linha['nome']}</a></td>
			<td><a>{$linha['data']}</a></td>

			</tr>";
			}
		}
		else{
		echo "Não existem assembleias";
		}
	}
	
	catch(Exception $e){
		echo $e->getMessage();
		print_r($e->getTrace());
		$bd->rollback();
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
		<input type="text" name="nome" placeholder="Nome da reunião" required>
		<input type="datetime-local" name="data" placeholder="Data" required>
		<input type="submit" value="Criar nova reunião">
	</form>
	

</body>	
</html>

