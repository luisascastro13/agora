<?php
require_once '../model/Conexao.class.php';
require_once '../model/Usuario.class.php';

if(!ISSET($_SESSION)){
	session_start();
}

Class NucleoDAO{
	//lista todos nucleos do banco de dados
	public static function listarNucleo(){
		$conn = new Conexao();

		$sql = "SELECT * FROM NUCLEO";		
		$resultado = $conn->consultarTabela($sql, null);

		return $resultado;
	}

	// TALVEZ SEJA ÚTIL, POSTERIORMENTE, PASSAR O OBJETO $USUARIO COMO PARÂMETRO, A FIM DE QUE A FUNÇÃO POSSA SER REUTILIZADA;
	//lista os nucleos em que o usuario_logado está na lista de ativos
	public static function listarNucleoUsuarioParticipa(){
		$conn = new Conexao();
		$usuario = new Usuario($_SESSION['username'], $_SESSION['nomecompleto'], null, null);

		$sql = "SELECT nucleo.nome, nucleo.id FROM usuarios_frequentam_nucleo INNER JOIN nucleo ON nucleo.id = usuarios_frequentam_nucleo.id_nucleo WHERE ativo = '1' AND id_usuario = ? ";

		$resultado = $conn->consultarTabela($sql, [$usuario->getLogin()]);
		return $resultado;
	}

	public static function inserirNucleo($nucleo){
		$conn = new Conexao();

		$sql = "INSERT INTO NUCLEO (nome, descricao) VALUES (:nome, :descricao)";
		
		$id = $conn->atualizarTabela($sql, ['nome'=> $nucleo->getNome(), 'descricao' => $nucleo->getDescricao()]);
		return $id;
	}

	public static function deletarNucleo($nucleo){
		$conn = new Conexao();

		$sql = "DELETE FROM NUCLEO WHERE id = $nucleo->getId()";
		$conn->atualizarTabela($sql);
	}	

	### BUSCA NUCLEO POR ID
	public static function buscarPorId($id){
		$conn = new Conexao();

		$sql = "SELECT id, nome FROM NUCLEO WHERE id = ?";
		
		$resultado = $conn->consultarTabela($sql, [$id]);

		return $resultado;
	}

	public static function editarNucleo($nucleo){
		$conn = new Conexao();

		$sql = "UPDATE NUCLEO SET nome = ? WHERE id = ?";
		$erro = $conn->atualizarTabela($sql, [$nucleo->getNome(), $nucleo->getId()]);
		return $erro;
	}

	public static function listarMembros($nucleo){
		$conn = new Conexao();
		$sql = "SELECT nome_usuario, id_usuario, id, ativo, usuario_adm FROM usuarios_frequentam_nucleo where id_nucleo = ?";		
		$resultado = $conn->consultarTabela($sql, [$nucleo->getId()]);
		return $resultado;
	}

	public static function inserirUsuarioEmNucleo($nucleo, $usuario){
		$conn = new Conexao();
		$sql = "INSERT INTO usuarios_frequentam_nucleo (id_usuario, id_nucleo, nome_usuario, usuario_adm, ativo) values (?,?,?,?,?)";
		$id = $conn->atualizarTabela($sql, [$usuario->getLogin(), $nucleo->getId(), $usuario->getNome(), '0', '1']);
		return $id;	
	}

	public static function removerUsuarioEmNucleo($idUsuarioNucleo){
		$conn = new Conexao();
		$sql = "DELETE FROM usuarios_frequentam_nucleo where id = ?";
		$erro = $conn->atualizarTabela($sql, [$idUsuarioNucleo]);
		if(isset($erro)){
			return $erro;
		}
	}

	public static function atribuirLoginAUsuario($idUsuarioNucleo, $usuario){
		$conn = new Conexao();
		$sql = "UPDATE usuarios_frequentam_nucleo SET id_usuario = ? WHERE id = ?;";

		$erro = $conn->atualizarTabela($sql, [$usuario->getLogin(), $idUsuarioNucleo]);
		if(isset($erro)){
			return $erro;
		}
	}

	public static function inserirUsuarioAdmEmNucleo($nucleo, $usuario){
		$conn = new Conexao();
		$sql = "UPDATE usuarios_frequentam_nucleo set usuario_adm = 1 where id_usuario = ? and id_nucleo = ?";
		$erro = $conn->atualizarTabela($sql, [$usuario->getLogin(), $nucleo->getId()]);

		if(isset($erro)){
			return $erro;
		}		
	}

	public static function removerUsuarioAdmEmNucleo($nucleo, $usuario){
		$conn = new Conexao();
		$sql = "UPDATE usuarios_frequentam_nucleo SET usuario_adm = 0 where id_usuario = ? and id_nucleo = ?";

		$erro = $conn->atualizarTabela($sql, [$usuario->getLogin(), $nucleo->getId()]);
		if(isset($erro)){
			return $erro;
		}
	}

	public static function mostrarTodosNucleos(){
		$conn = new Conexao();
		$sql = "select * from nucleo";

		$res = $conn->consultarTabela($sql, null);
		return $res;
	}

	public static function mostrarTodosNucleosEmString(){
		$conn = new Conexao();
		$sql = "select * from nucleo";

		$res = $conn->consultarTabela($sql, null);
		$string = '';
		$string .='[';
		foreach ($res as $nucleo){
			$string .='"'.$nucleo['nome'].'",';			
		}
		$string.= ']';
		return $string;		
	}

	public static function mostrarIdPorNome($nome){
		$conn = new Conexao();
		$sql = "select id from nucleo where nome = ?";
		$res = $conn->consultarTabela($sql, [$nome]);
		return $res;
	}

}

?>