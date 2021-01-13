<?php
require_once '../model/Conexao.class.php';
require_once '../model/Usuario.class.php';

session_start();


Class NucleoDAO{
	//lista todos nucleos do banco de dados
	public static function listarNucleo(){
		$conn = new Conexao();

		$sql = "SELECT * FROM NUCLEO";		
		$resultado = $conn->consultarTabela($sql, $conn, null);

		return $resultado;
	}

	//lista os nucleos em que o usuario está na lista de ativos
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

	public static function inserirUsuarioAdmEmNucleo($nucleo, $usuario){
		$conn = new Conexao();

		$sql = "INSERT INTO usuarios_frequentam_nucleo (id_usuario, id_nucleo, nome_usuario, usuario_adm, ativo) values (?,?,?,?,?)";		

		$conn->atualizarTabela($sql, [$usuario->getLogin(), $nucleo->getId(), $usuario->getNome(), '1', '1']);		
	}

	public static function buscarPorId($id){
		$conn = new Conexao();

		$sql = "SELECT id, nome FROM NUCLEO WHERE id = ?";
		
		$resultado = $conn->consultarTabela($sql, [$id]);

		return $resultado;
	}

	public static function editarNucleo($nucleo){
		$conn = new Conexao();

		$sql = "UPDATE NUCLEO SET nome = ? WHERE id = ?";
		$conn->atualizarTabela($sql, [$nucleo->getNome(), $nucleo->getId()]);

	}

	public static function listarMembros($nucleo){
		$conn = new Conexao();

		$sql = "SELECT nome_usuario FROM usuarios_frequentam_nucleo where id_nucleo = ?";
		$resultado = $conn->consultarTabela($sql, [$nucleo->getId()]);

		return $resultado;
	}

	public static function inserirUsuarioEmNucleo($nucleo, $usuario){
		$conn = new Conexao();
		$sql = "INSERT INTO usuarios_frequentam_nucleo (id_usuario, id_nucleo, nome_usuario, usuario_adm, ativo) values (?,?,?,?,?)";
		$conn->atualizarTabela($sql, [$usuario->getLogin(), $nucleo->getId(), $usuario->getNome(), '0', '1']);	
	}

}

?>