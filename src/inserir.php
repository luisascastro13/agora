<?php

$nome = $_POST['nome'];
$data = $_POST['data'];


$link = mysqli_connect('localhost','useragora', '', 'agora');

if (!$link) {
	echo "errooooo";
    exit;
}

else {
mysqli_query($link, "INSERT INTO assembleia (nome, data) VALUES ('$nome','$data')");

header('Location: banco.php');
}

?>