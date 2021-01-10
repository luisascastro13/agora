<?php
class Conexao{
	//aqui tinha o parametro $param pra caso exista parametros no sql, fazer a prevencao de sql injection
	public static function consultarTabela($sql, $conn) {
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

				//aqui tinha o parametro $param dentro do execute
				$comando->execute();

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

	public function atualizarTabela($sql){
		if(!$this) {
			    echo "Error: Unable to connect to MySQL." . PHP_EOL;
			    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
			    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
			    exit;
		}
		else{
			try{

				$this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$this->beginTransaction();

				$comando = $this->prepare($sql);
				$comando->execute();

				$this->commit();				
			}catch(Exception $e){
				echo $e->getMessage();
				print_r($e->getTrace());
				$this->rollback();
			}
		}


	}
}
?>