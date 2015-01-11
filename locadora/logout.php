<?php
    session_start();
	if (!empty($_GET['sair']) && $_GET['sair']=="encerrar") {
		session_destroy();
		header('location: http://localhost/teste/locadora/index.php');
		exit;
	} else {
		header('location: http://localhost/teste/locadora/index.php');
		exit;
	}
?>