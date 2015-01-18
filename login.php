<?php
	// Iniciando a seção para guardar os valores da validação do login
	session_start();
	
	// Chamando a conexão com o banco de dados
	require 'conexao.php';
	mysqli_query($conexao, "SET NAMES 'UTF8';");
	
	// Recebendo os dados do formulário de login
	$email = $_POST['email'];
	$senha = $_POST['senha'];
	
	// Armazenando os dados do database
	$usuario = mysqli_query($conexao, "SELECT * FROM usuario WHERE email='$email' and senha='$senha'");
	$cliente = mysqli_query($conexao, "SELECT * FROM cliente WHERE email='$email' and senha='$senha'");
	$search_user = mysqli_query($conexao, "SELECT * FROM usuario WHERE email='$email'");
	$search_cliente = mysqli_query($conexao, "SELECT * FROM cliente WHERE email='$email'");
	$search_user = mysqli_fetch_array($search_user);
	$search_cliente = mysqli_fetch_array($search_cliente);
	
	// Confrontando os dados do formulário com os do database e armazanando os valores resultantes em sessões
	if (mysqli_num_rows($usuario) == 1 || mysqli_num_rows($cliente) == 1) {
		$usuario = mysqli_fetch_array($usuario);
		if ($usuario['nivel'] == 3) {
			header('location: http://localhost/teste/locadora/index.php');
			$_SESSION['nome'] = $usuario['nome'];
			$_SESSION['nivel'] = $usuario['nivel'];
			exit;
		} elseif ($usuario['nivel'] == 2) {
			header('location: http://localhost/teste/locadora/index.php');
			$_SESSION['nome'] = $usuario['nome'];
			$_SESSION['nivel'] = $usuario['nivel'];
			exit;
		} elseif (mysqli_num_rows($cliente) == 1) {
			$cliente = mysqli_fetch_array($cliente);
			header('location: http://localhost/teste/locadora/index.php');
			$_SESSION['nome'] = $cliente['nome'];
			$_SESSION['nivel'] = $cliente['nivel'];
			exit;
		}
	} elseif (($search_user['email'] == $email && $search_user['senha'] != $senha) || ($search_cliente['email'] == $email && $search_cliente['senha'] != $senha)) {
		header('location: http://localhost/teste/locadora/index.php');
		$_SESSION['msg'] = "passinvalid";
		exit;
	} else {
		header('location: http://localhost/teste/locadora/index.php');
		$_SESSION['msg'] = "usernoexist";
		exit;
	}
?>