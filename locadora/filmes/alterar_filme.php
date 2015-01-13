<?php
	// Chamando a conexão com o banco de dados
    require '../conexao.php';
	mysqli_query($conexao, "SET NAMES 'UTF8';");// configurando codificação
	
	@$codigo = $_POST['codigo'];
	@$titulo = $_POST['filme'];
	@$sinopse = $_POST['sinopse'];
	@$quantidade = $_POST['quantidade'];
	@$trailer = $_POST['trailer'];
	
	if (!empty($_POST)){
	$sql = "UPDATE filme SET cod_filme='$codigo', titulo='$titulo', sinopse='$sinopse', quantidade='$quantidade', trailer='$trailer' WHERE cod_filme='$codigo'";
	mysqli_query($conexao, $sql) or die('Error: '.mysqli_error($conexao));
	header('location: listar_filmes.php');
	exit;
	}
?>