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
						$comando = $bd->prepare('SELECT nome_usuario, id FROM usuarios_frequentam_nucleo where id_nucleo = :id order by nome_usuario');
						$comando->execute(['id'=>$_SESSION['id_nucleo']]);

						// echo $_SESSION['id_nucleo'];


					$bd->commit();

					if($comando){

						echo  "<table id='tabelinha'><tr>
						<th>Nome do usuário</th>						
						<th></th>
						</tr>";


						while($linha = $comando->fetch(PDO::FETCH_ASSOC)){

							$_SESSION['nome_usuario'] = $linha['nome_usuario'];
							$_SESSION['id_ufn'] = $linha['id'];

							
						echo "<tr>
						<td>{$linha['nome_usuario']}</td>
						<td><div class='dropdown'>
  <button class='btn btn-secondary dropdown-toggle' type='button' id='dropdownMenuButton' data-bs-toggle='dropdown' aria-expanded='false'>
    Ver mais
  </button>
  <ul class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
    <li><a class='dropdown-item' href='excluirUsuarioEmNucleo.php'>Excluir</a></li>
    <li><a class='dropdown-item' href='#'>Another action</a></li>
    <li><a class='dropdown-item' href='#'>Something else here</a></li>
  </ul>
</div>
						</td>
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