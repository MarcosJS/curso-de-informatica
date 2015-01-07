<?php
	require 'conexao.php';
	mysqli_query($conexao, "SET NAMES 'UTF8';");	
	$msg_erro = '';
	if (!empty($_GET['msg'])) {
		if ($_GET['msg'] == "passinvalid") {
			$msg_erro = '<table align="right"><tr><td><font size="2"color="#FA8F8F">Senha invalida!</font></td></tr></table>';
		} elseif ($_GET['msg'] == "usernoexist") {
			$msg_erro = '<table align="right"><tr><td><font size="2"color="#FA8F8F">Usuario não existe!</font></td></tr></table>';
		}
	}
	$form = '<table align="right" cellpadding="0" cellspacing="2">
				<form action="http://localhost/teste/locadora/login.php" method="post">
					<tr><td><font color="#ffffff">E-mail </font></td><td><input type="text" name="email" /></td></tr>
					<tr><td><font color="#ffffff">Senha </font></td><td><input type="password" name="senha" /></td></tr>
					<tr><td><input type="submit" value="Entar" /></td><td>'.@$msg_erro.'</td></tr>
					<tr><td colspan="2" align="center"><a href="http://localhost/teste/locadora/clientes/cadastro.php"><font color="#ffffff">Cadastre-se</font></td></tr>
				</form>
			</table>';
	if (!empty($_GET['nivel'])) {
		if ($_GET['nivel'] == "3") {
			$form = '<table align="right"><tr><td><font color="#ffffff">Administrador '.$_GET['nome'].' (<a href="#"><font color="#ffffff">Sair</font></a>)</font></td></tr></table>';
			
		} elseif ($_GET['nivel'] == "2") {
			$form = '<table align="right"><tr><td><font color="#ffffff">Funcionário '.$_GET["nome"].' (<a href="#"><font color="#ffffff">Sair</font></a>)</font></td></tr></table>';
		} elseif ($_GET['nivel'] == "1") {
			$form = '<table align="right"><tr><td><font color="#ffffff">Cliente '.$_GET["nome"].' (<a href="#"><font color="#ffffff">Sair</font></a>)</font></td></tr></table>';
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
					<li class="active"><a href="http://localhost/teste/locadora/filmes/listar_filmes.php">Filmes</a></li><!-- no lugar de listar_produtos.php no original é index.php -->
					<li><a href="http://localhost/teste/locadora/clientes/painel.php">Clientes</a></li>
					<li><a href="http://localhost/teste/locadora/funcionarios/listar_funcionarios.php">Funcionários</a></li>
				</ul></td>
				<td rowspan="2">
				
			</div>
			