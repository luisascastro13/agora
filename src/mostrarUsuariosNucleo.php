<?php

function mostrarUsuariosNucleo(){


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
						$comando = $bd->prepare('SELECT nome_usuario FROM usuarios_frequentam_nucleo where id_nucleo = :id');
						$comando->execute(['id'=>$_SESSION['id_nucleo']]);

						// echo $_SESSION['id_nucleo'];


					$bd->commit();

					if($comando){

						echo  "<table id='tabelinha'><tr>
						<th>Nome do usuário</th>						
						<th></th>
						</tr>";


						while($linha = $comando->fetch(PDO::FETCH_ASSOC)){

							
						echo "<tr>
						<td>{$linha['nome_usuario']}</td>
						<td><a href='#'>Ver Mais</a></td>
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