<?php
    require '../conexao.php';
	@$matricula = $_GET['matricula'];
	$sql = "DELETE FROM usuario WHERE matricula='$matricula'";
	if (!empty($_GET)) {
		mysqli_query($conexao, $sql) or die("Error: ".mysqli_error($conexao));
		header('location: listar_funcionarios.php');
		exit;
	} else {
		echo "falha";
	}
?>