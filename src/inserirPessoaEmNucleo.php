<?php

session_start();

		$bd = new PDO('mysql:host=localhost;dbname=agora', 'useragora', '');

		if (!$bd) {
		    exit;
		}

		else {
			try{

				var_dump($_POST);

				$idn = $_POST['id_nucleo'];

				//insere novo nome de pessoa no nucleo
				$bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$bd->beginTransaction();
					$comando = $bd->prepare('insert into usuarios_frequentam_nucleo (id_nucleo, nome_usuario) values (:id_nucleo, :nome_usuario)');

					//id_nucleo não pode estar vazio
					$comando->execute(['id_nucleo' => $_POST['id_nucleo'], 'nome_usuario' => $_POST['nome']]);

					$bd->commit();

					
				header("Location: mostrarNucleo.php?id_nucleo=$idn");
			}
			
			catch(Exception $e){
				echo $e->getMessage();
				print_r($e->getTrace());
				$bd->rollback();
			}


		}


?>