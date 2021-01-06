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


					// header('Location: painel.php');

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
							<td><a href='mostrarNucleo.php?idnuc=$id'>Ver Mais</a></td>
							<td style=''>{$linha['id']}</td>
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