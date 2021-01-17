<?php
require_once '../model/Conexao.class.php';

Class UsuarioDAO{
	public static function listarUsuario(){
		$conn = new Conexao();

		$sql = "SELECT * FROM USUARIO";
		// $resultado = Conexao::consultarTabela($sql, $conn, null);

		$resultado = $conn->consultarTabela($sql, null);

		return $resultado;
	}
	public static function inserirUsuario($usuario){
		$conn = new Conexao();

		$sql = "INSERT INTO USUARIO (login, nome) VALUES ($usuario->getLogin(), $usuario->getNome())";
		$conn->atualizarTabela($sql);
	}
	public static function deletarUsuario($usuario){
		$conn = new Conexao();

		$sql = "DELETE FROM USUARIO WHERE login = $usuario->getLogin()";
		$conn->atualizarTabela($sql);
	}

	public static function listarLogin(){
		$conn = new Conexao();
		$sql = "SELECT login FROM usuario";

		$resultado = $conn->consultarTabela($sql, null);
		return $resultado;
	}
}
?>