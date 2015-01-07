<?php
    require 'conexao.php';
	mysqli_query($conexao, "SET NAMES 'UTF8';");
	
	//if (isset($_post)) {
		$email = $_POST['email'];
		$senha = $_POST['senha'];
		$usuario = mysqli_query($conexao, "SELECT * FROM usuario WHERE email='$email' and senha='$senha'");
		$cliente = mysqli_query($conexao, "SELECT *  FROM cliente  WHERE email='$email' and senha='$senha'");
		$search_user = mysqli_query($conexao, "SELECT * FROM usuario, cliente WHERE email='$email'");
		echo mysqli_num_rows($usuario);
	
		echo "<html><head><body><br /><br /></body></head></html>";
		echo mysqli_num_rows($cliente);
?>
