<?php
	// Iniciando uma sessão
	session_start();
	
	// Incluindo o cabeçalho
	include '../template_topo.php';
	
	// Conteúdo da página
	echo "<h1 align='center'>PARABÉNS VOCÊ ESTA NO PAINEL!</h1>";
	echo "<hr width=1005/>";
	
	// Incluindo o rodapé
	include '../template_rodape.php';
?>