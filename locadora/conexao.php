<?php
    $host = "localhost";
	$user = "root";
	$pass = "";
	$banco = "popcorntv";
	$conexao = mysqli_connect($host, $user, $pass, $banco);
	if (mysqli_connect_errno($conexao)) {
		mysqli_error($conexao);
	}	
?>