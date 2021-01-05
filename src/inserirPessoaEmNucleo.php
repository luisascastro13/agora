<?php

session_start();

		$bd = new PDO('mysql:host=localhost;dbname=agora', 'useragora', '');

		if (!$bd) {
		    exit;
		}

		else {
			
			try{

				//insere novo nome de pessoa no nucleo

				$bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$bd->beginTransaction();
					$comando = $bd->prepare('insert into usuarios_frequentam_nucleo (id_nucleo, nome_usuario) values (:id_nucleo, :nome_usuario)');

					$comando->execute(['id_nucleo' => $_SESSION['id_nucleo'], 'nome_usuario' => $_POST['nome']]);

					$bd->commit();

					echo 'inserido.';

				// header('Location: painel.php');
			}
			
			catch(Exception $e){
				echo $e->getMessage();
				print_r($e->getTrace());
				$bd->rollback();
			}


		}


?>