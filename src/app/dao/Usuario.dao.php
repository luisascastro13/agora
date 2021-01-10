<?php
require_once '../model/Conexao.class.php';

Class UsuarioDAO{
	public static function listarUsuario($conn){
		$sql = "SELECT * FROM USUARIO";
		$resultado = Conexao::consultarTabela($sql, $conn);
		return $resultado;
	}
	public static function inserirUsuario($conn, $usuario){
		$sql = "INSERT INTO USUARIO (login, nome) VALUES ($usuario->getLogin(), $usuario->getNome())";
		$conn->atualizarTabela($sql);
	}
	public static function deletarUsuario($conn, $usuario){
		$sql = "DELETE FROM USUARIO WHERE login = $usuario->getLogin()";
		$conn->atualizarTabela($sql);
	}
}
?>