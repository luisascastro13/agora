<?php

session_start();

		$bd = new PDO('mysql:host=localhost;dbname=agora', 'useragora', '');

		if (!$bd) {
		    exit;
		}

		else {
			
			try{

				//insere novo nucleo

				$bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$bd->beginTransaction();
					$comando = $bd->prepare('delete from usuarios_frequentam_nucleo where id = :id_usuarios_frequentam_nucleo');

					$comando->execute(['id_usuarios_frequentam_nucleo' =>$_SESSION['id_ufn']]);		

					$bd->commit();

				header('Location: mostrarNucleo.php');
			}
			
			catch(Exception $e){
				echo $e->getMessage();
				print_r($e->getTrace());
				$bd->rollback();
			}


		}


?>

