<?php
    require '../conexao.php';
	mysqli_query($conexao, "SET NAMES 'UTF8';");
	@$titulo = $_POST['filme'];
	@$sinopse = $_POST['sinopse'];
	@$quantidade = $_POST['quantidade'];
	@$trailer = $_POST['trailer'];
	
	if (!empty($_POST)){
	$sql = "INSERT INTO filme (titulo, sinopse, quantidade, trailer) VALUES ('$titulo', '$sinopse', '$quantidade', '$trailer')";
	mysqli_query($conexao, $sql) or die('Error: '.mysqli_error($conexao));
	header('location: listar_filmes.php');
	exit;
	}// else {
		//echo "Error";
	//}
?>