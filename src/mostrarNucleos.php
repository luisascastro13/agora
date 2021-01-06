<?php

function mostrarNucleos(){


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

					// AQUI DEVE SER FEITO UM INSERT NA TABELA USUARIOS_FREQUENTAM_NUCLEO AINDA, PARA PODER MOSTRAR ALGUMA COISA NA TELA.


						$comando = $bd->prepare('SELECT nucleo.nome, usuarios_frequentam_nucleo.id_nucleo FROM nucleo inner join usuarios_frequentam_nucleo on nucleo.id = usuarios_frequentam_nucleo.id_nucleo where id_usuario = :id');

						$comando->execute(['id'=>$_SESSION['username']]);


					$bd->commit();

					if($comando){

						echo  "<table id='tabelinha'><tr>
						<th>Nome do núcleo</th>
						</tr>";


						while($linha = $comando->fetch(PDO::FETCH_ASSOC)){
						
							echo "<tr>
							<td>{$linha['nome']}</td>
							<td><a href='mostrarNucleo.php'>Ver Mais</a></td>
							</tr>";

							$_SESSION['id_nucleo'] = $linha['id_nucleo'];

						}

						echo "</table>";
					}
					else{
					echo "Não existem núcleos";
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