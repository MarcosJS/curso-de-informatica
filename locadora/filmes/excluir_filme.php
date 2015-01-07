<?php
    require '../conexao.php';
	@$codigo = $_GET['codigo'];
	$sql = "DELETE FROM filme WHERE codigo='$codigo'";
	if (!empty($_GET)) {
		mysqli_query($conexao, $sql) or die("Error: ".mysqli_error($conexao));
		header('location: listar_filmes.php');
		exit;
	} else {
		echo "falha";
	}
?>