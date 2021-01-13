<?php
require_once '../model/Usuario.class.php';
require_once '../dao/Usuario.dao.php';

switch ($_GET['a']) {
	case 'inserir':
		$usuario = new Usuario();
		$usuario->setNome($_POST['nombre']);

		// RolesDAO::ingresarDato($r);
		break;
	case 'editar':
		$r = new Rol();
		$r->id = $_POST['id'];
		$r->nombre = $_POST['nombre'];

		// RolesDAO::editarDato($r);
		break;
	case 'eliminar':
		// Usuario::eliminarPorId($_GET['id']);
		break;
}

header('Location: ../view/');