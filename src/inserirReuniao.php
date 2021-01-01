<?php

// $nome = $_POST['nome'];
// $data = $_POST['data'];

$bd = new PDO('mysql:host=localhost;dbname=agora', 'useragora', '');

if (!$bd) {
    exit;
}

else {

	try{
		$bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$bd->beginTransaction();
			$comando = $bd->prepare('insert into reuniao (nome, data) values ( :nome, :data)');

			$comando->execute(['nome' =>$_POST['nome'], 'data' =>$_POST['data']]);

			$bd->commit();

		header('Location: banco.php');
	}
	
	catch(Exception $e){
		echo $e->getMessage();
		print_r($e->getTrace());
		$bd->rollback();
	}

}

?>