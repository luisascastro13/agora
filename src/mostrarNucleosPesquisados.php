<html>

<head>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

</head>
<body>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">


</script>

</body>

</html>
<?php


function mostrarNucleosPesquisados(){

	$bd = new PDO('mysql:host=localhost;dbname=agora', 'useragora', '');

		if (!$bd) {
		    echo "Error: Unable to connect to MySQL." . PHP_EOL;
		    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
		    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
		    exit;
		}
		else {

			try{

				if (isset($_POST["nomePesquisado"])) {

					$bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$bd->beginTransaction();

					$nomePesquisado = $_POST["nomePesquisado"];

					$comando = $bd->prepare("SELECT nucleo.nome, nucleo.id FROM nucleo where nome like '%$nomePesquisado%'");
					$comando->execute([]);
					$bd->commit();

					$total = $comando->rowCount();				

					if($total > 0)
					{
						echo  "<table id='tabelinha'><tr>
						<th>Nome do núcleo</th>
						<th></th>
						</tr>";

						while($linha = $comando->fetch(PDO::FETCH_ASSOC)){

							$id = $linha['id'];
							
							echo "<tr>
							<td>{$linha['nome']}</td>
							<td><a href='mostrarNucleo.php?id_nucleo=$id'>Ver Mais</a></td>
							</tr>";

						}

						echo "</table>";							

					}
					else if($total == 0){
						echo "Não existem núcleos compatíveis com sua pesquisa. Sinto muito, tente novamente.";
					}						
				}
			}
	
			catch(Exception $e){
				echo $e->getMessage();
				print_r($e->getTrace());
				$bd->rollback();
			}		
		}
	
	}

?>