<?php

function mostrarReunioes(){


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
						$comando = $bd->prepare('SELECT * FROM reuniao where id_nucleo = :id_nucleo');
						$comando->execute(['id_nucleo'=>$_SESSION['id_nucleo']]);
					$bd->commit();

					if($comando){

						echo  "<table id='tabelinha'><tr>
						<th>Nome da reunião</th>
						<th>Data</th>
						<th></th>
						</tr>";


						while($linha = $comando->fetch(PDO::FETCH_ASSOC)){

							$codigoreuniao = $linha['codigo'];

						echo "<tr>
						<td>{$linha['nome']}</td>
						<td>{$linha['data']}</td>
						<td><a href='reuniao.php?cod=$codigoreuniao'>Ver Mais</a></td>
						</tr>";

						}

						echo "</table>";
					}
					else{
					echo "Não existem reuniões";
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