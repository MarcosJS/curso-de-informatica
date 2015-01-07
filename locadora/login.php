<?php
	require 'conexao.php';
	mysqli_query($conexao, "SET NAMES 'UTF8';");
	
	$email = $_POST['email'];
	$senha = $_POST['senha'];
	$usuario = mysqli_query($conexao, "SELECT * FROM usuario WHERE email='$email' and senha='$senha'");
	$cliente = mysqli_query($conexao, "SELECT * FROM cliente WHERE email='$email' and senha='$senha'");
	$search_user = mysqli_query($conexao, "SELECT * FROM usuario WHERE email='$email'");
	$search_cliente = mysqli_query($conexao, "SELECT * FROM cliente WHERE email='$email'");
	$search_user = mysqli_fetch_array($search_user);
	$search_cliente = mysqli_fetch_array($search_cliente);
		
	if (mysqli_num_rows($usuario) == 1 || mysqli_num_rows($cliente) == 1) {
		$usuario = mysqli_fetch_array($usuario);
		if ($usuario['nivel'] == 3) {
			header('location: http://localhost/teste/locadora/template_topo.php?nivel=3&nome="'.$usuario["nome"].'"');
			exit;
		} elseif ($usuario['nivel'] == 2) {
			header('location: http://localhost/teste/locadora/template_topo.php?nivel=2&nome="'.$usuario["nome"].'"');
			exit;
		} elseif (mysqli_num_rows($cliente) == 1) {
			$cliente = mysqli_fetch_array($cliente);
			header('location: http://localhost/teste/locadora/template_topo.php?nivel=1&nome="'.$cliente["nome"].'"');
			exit;
		}
	} elseif (($search_user['email'] == $email && $search_user['senha'] != $senha) || ($search_cliente['email'] == $email && $search_cliente['senha'] != $senha)) {
		header('location: http://localhost/teste/locadora/template_topo.php?msg=passinvalid');
		exit;
	} else {
		header('location: http://localhost/teste/locadora/template_topo.php?msg=usernoexist');
		exit;
	}
?>