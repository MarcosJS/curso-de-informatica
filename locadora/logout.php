<?php
	// Iniciando a sessão 
    session_start();
	if (!empty($_GET['sair']) && $_GET['sair']=="encerrar") {
		
		// Destruindo a sessão para fazer logout
		session_destroy();
		header('location: http://localhost/teste/locadora/index.php');
		exit;
	} else {
		header('location: http://localhost/teste/locadora/index.php');
		exit;
	}
?>