<?php

	session_start();


		$bd = new PDO('mysql:host=localhost;dbname=agora', 'useragora', '');

		if (!$bd) {
		    exit;
		}

		else {
			
			//quando o usuario criar uma reuniao, se torna administrador da mesma.

			try{
				 // var_dump($_POST);

				$bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$bd->beginTransaction();
					$comando = $bd->prepare('insert into reuniao (nome, data, id_usuarioadm, id_nucleo) values ( :nome, :data, :id_usuarioadm, :id_nucleo)');

					$comando->execute(['nome' =>$_POST['nome'], 'data' =>$_POST['data'], 'id_usuarioadm' => $_SESSION['username'], 'id_nucleo' =>$_SESSION['id_nucleo']]);

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