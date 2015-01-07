<?php
    require '../conexao.php';
	mysqli_query($conexao, "SET NAMES 'UTF8';");
	
	@$codigo = $_POST['codigo'];
	@$titulo = $_POST['filme'];
	@$sinopse = $_POST['sinopse'];
	@$quantidade = $_POST['quantidade'];
	@$trailer = $_POST['trailer'];
	
	if (!empty($_POST)){
	$sql = "UPDATE filme SET codigo='$codigo', titulo='$titulo', sinopse='$sinopse', quantidade='$quantidade', trailer='$trailer' WHERE codigo='$codigo'";
	mysqli_query($conexao, $sql) or die('Error: '.mysqli_error($conexao));
	header('location: listar_filmes.php');
	exit;
	}
?>