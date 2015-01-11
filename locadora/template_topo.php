<?php
	//session_start();
	require 'conexao.php';
	mysqli_query($conexao, "SET NAMES 'UTF8';");	
	$msg = '';
	if (!empty($_SESSION['msg'])) {
		if ($_SESSION['msg'] == "passinvalid") {
			$msg = '<table align="right"><tr><td><font size="2"color="#FA8F8F">Senha invalida!</font></td></tr></table>';
		} elseif ($_SESSION['msg'] == "usernoexist") {
			$msg = '<table align="right"><tr><td><font size="2"color="#FA8F8F">Usuario não existe!</font></td></tr></table>';
		} 
	} elseif (!empty($_SESSION['cadastrado']) && $_SESSION['cadastrado'] == "realizado") {
		$msg = '<table align="right"><tr><td><font size="2"color="#FFFFFF">Cadastro realizado com sucesso!</font></td></tr></table>';
		session_destroy();
	}
	
	$form = '<table align="right" cellpadding="0" cellspacing="2">
				<form action="http://localhost/teste/locadora/login.php" method="post">
					<tr><td><font color="#ffffff">E-mail </font></td><td><input type="text" name="email" /></td></tr>
					<tr><td><font color="#ffffff">Senha </font></td><td><input type="password" name="senha" /></td></tr>
					<tr><td><input type="submit" value="Entar" /></td><td>'.@$msg.'</td></tr>
					<tr><td colspan="2" align="center"><a href="http://localhost/teste/locadora/clientes/cadastro.php"><font color="#ffffff">Cadastre-se</font></td></tr>
				</form>
			</table>';
	if (!empty($_SESSION['nivel'])) {
		if ($_SESSION['nivel'] == "3") {
			$form = '<table align="right"><tr><td><font color="#ffffff">Administrador '.$_SESSION['nome'].' (<a href="http://localhost/teste/locadora/logout.php?sair=encerrar"><font color="#ffffff">Sair</font></a>)</font></td></tr></table>';
			//unset($msg_aceso);
		} elseif ($_SESSION['nivel'] == "2") {
			$form = '<table align="right"><tr><td><font color="#ffffff">Funcionário '.$_SESSION['nome'].' (<a href="http://localhost/teste/locadora/logout.php?sair=encerrar"><font color="#ffffff">Sair</font></a>)</font></td></tr></table>';
		} elseif ($_SESSION['nivel'] == "1") {
			$form = '<table align="right"><tr><td><font color="#ffffff">Cliente '.$_SESSION['nome'].' (<a href="http://localhost/teste/locadora/logout.php?sair=encerrar"><font color="#ffffff">Sair</font></a>)</font></td></tr></table>';
		}
	}
	
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="UTF-8">
		<title>Locadora</title>
		<meta name="viewport" content="width-device-width, inicial-scale=1, maximum-scale=1">
		<!-- essas duas proximas linha podem ocasionar erros no script -->
		<link href="css/bootstrap.min.css" rel="stylesheet"/>
		<link href="css/styles.css" rel="stylesheet"/>
	</head>
	<body>
<div class="wrapper">
	<div class="box">
		<div class="row">
			<div class="column col-sm-3" id="sidebar">
				<table width="100%" bgcolor="0A0028" border="0" cellspacing="0"><tr><td>
				<h3 align="center"><a class="logo"	href="http://localhost/teste/locadora/index.php" style="text-decoration: none"><span><font size="7" color="#ffffff">LOCADORA</font></span></a></h3>
				</td><td><?=$form; ?></td></tr>
				<tr bgcolor="#ffffff" height="50"><td><ul class="nav">
					<?php 
						if (isset($_SESSION['nivel']) && $_SESSION['nivel'] >= 1) {
							if ($_SESSION['nivel'] == 3) {
								echo '<li><a href="#">Filmes</a></li>
									  <li class="active"><a href="http://localhost/teste/locadora/filmes/listar_filmes.php">Gerênciar Filmes</a></li><!-- no lugar de listar_produtos.php no original é index.php -->
									  <li><a href="http://localhost/teste/locadora/clientes/painel.php">Perfil do Usuário</a></li>
									  <li><a href="#">Perfil do Funcionário</a></li>
									  <li><a href="http://localhost/teste/locadora/funcionarios/listar_funcionarios.php">Gerênciar Funcionários</a></li>';
							} elseif ($_SESSION['nivel'] == 2) {
								echo '<li><a href="#">Filmes</a></li>
									  <li class="active"><a href="http://localhost/teste/locadora/filmes/listar_filmes.php">Gerênciar Filmes</a></li><!-- no lugar de listar_produtos.php no original é index.php -->
									  <li><a href="#">Perfil do Funcionário</a></li>';
							} elseif ($_SESSION['nivel'] == 1) {
								echo '<li><a href="#">Filmes</a></li>
									  <li><a href="http://localhost/teste/locadora/clientes/painel.php">Perfil do Usuário</a></li>';
							} else {
								
								echo "ERRO!";
							}
						} 
					?>
				</ul></td>
				<td rowspan="2">
				
			</div>
			