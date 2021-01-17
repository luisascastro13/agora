<?php
class Conexao extends PDO{
	public function __construct() {
    	$dsn = 'mysql:dbname=' . 'agora' . ';host=' . 'localhost';
    	$user = 'useragora';
    	$pw = '';
    try {
       	parent::__construct($dsn, $user, $pw);
        $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();;
    }
}

	public static function consultarTabela($sql, $param) {
		$conn = new Conexao();
		
		if(!$conn) {
			    echo "Error: Unable to connect to MySQL." . PHP_EOL;
			    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
			    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
			    exit;
		}
		else{
			try{
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$conn->beginTransaction();

				$comando = $conn->prepare($sql);

				$comando->execute($param);

				$conn->commit();

				$resultado = $comando->fetchAll();

				return $resultado;

			}catch(Exception $e){
				echo $e->getMessage();
				print_r($e->getTrace());
				$conn->rollback();
			}
		}
	}

	public function atualizarTabela($sql, $param){
		$conn = new Conexao();

		if(!$conn) {
			    echo "Error: Unable to connect to MySQL." . PHP_EOL;
			    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
			    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
			    exit;
		}
		else{
			try{

				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$conn->beginTransaction();

				$comando = $conn->prepare($sql);
				$comando->execute($param);

				$id = $conn->lastInsertId();

				$conn->commit();

				return $id;	

			}catch(Exception $e){
				$erro= $e->getMessage();
				// $erro = $conn->errorInfo();
				// array_push($erro, $conn->errorInfo());
				$conn->rollback();
				return $erro;
			}
		}
	}
}
?>