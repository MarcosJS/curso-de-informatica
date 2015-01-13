<!-- Este script é o cabeçalho das páginas -->
<?php
	/* Esta primeira estrutura de decisão recebe e trata os valores vindos da página de login referentes
	 * à inconsistência dos enviados pelo formulário e a confirmação de cadastro do cliente */
	$msg = "";
	if (!empty($_SESSION['msg'])) {
		if ($_SESSION['msg'] == "passinvalid") {
			$msg = '<table align="right"><tr><td><font size="2"color="#FA8F8F">Senha invalida!</font></td></tr></table>';
			session_destroy();// A sessão é destruída para que a mensagem de erro não permaneca na página após uma atualização ou reenvio de dados
		} elseif ($_SESSION['msg'] == "usernoexist") {
			$msg = '<table align="right"><tr><td><font size="2"color="#FA8F8F">Usuario não existe!</font></td></tr></table>';
			session_destroy();
		}
	} elseif (!empty($_SESSION['cadastrado']) && $_SESSION['cadastrado'] == "realizado") {
		$msg = '<table align="right"><tr><td><font size="1"color="#FFFFFF">Cadastro realizado com sucesso!</font></td></tr></table>';
		session_destroy();
	}
	
	// Esta variável armazena o formulário que enviará os dados do usuário ao arquivo login.php
	$form = '<table align="right" cellpadding="0" cellspacing="2">
				<form action="http://localhost/teste/locadora/login.php" method="post">
					<tr><td><font color="#ffffff">E-mail </font></td><td><input type="text" name="email" /></td></tr>
					<tr><td><font color="#ffffff">Senha </font></td><td><input type="password" name="senha" /></td></tr>
					<tr><td><input type="submit" value="Entar" /></td><td>'.@$msg.'</td></tr>
					<tr><td colspan="2" align="center"><a href="http://localhost/teste/locadora/clientes/cadastro.php"><font color="#ffffff">Cadastre-se</font></td></tr>
				</form>
			</table>';
	
	/* Caso login.php valide os valores enviados no formuláio ele retorna um resultado que sera tratado pela seguinte
	 * estrutura de decisão que dependendo do nivel altera o valor da variavel $form para o tipo de usuario e nome do mesmo */ 
	if (!empty($_SESSION['nivel'])) {
		if ($_SESSION['nivel'] == "3") {
			$form = '<table align="right"><tr><td><font color="#ffffff">Administrador '.$_SESSION['nome'].' (<a href="http://localhost/teste/locadora/logout.php?sair=encerrar"><font color="#ffffff">Sair</font></a>)</font></td></tr></table>';
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
	</head>
	<body>
<div class="wrapper">
	<div class="box">
		<div class="row">
			<div class="column col-sm-3" id="sidebar">
				<table width="100%" bgcolor="0A0028" border="0" cellspacing="0"><tr><td>
				<h3 align="center"><a class="logo"	href="http://localhost/teste/locadora/index.php" style="text-decoration: none"><span><font size="7" color="#ffffff">MJS LOCADORA</font></span></a></h3>
				
				<!-- A variavel $form é inserida na tabela gerando o formulário com respectivas mensagens de erro ou exibindo o tipo e nome do usuário -->
				</td><td><?=$form; ?></td></tr>
				
				<!-- Estrutura de decisão que altera o design do menu -->
				<?php
					if (isset($_SESSION['nivel'])) {
						$bgcolor = 'bgcolor="#0A0028"';
					}
				?>
				<tr bgcolor="#ffffff" height="50"><td <?=@$bgcolor; ?>>
					
					<!-- O menu do site é limitado pelo tipo de usuário logado, este recurso é feito através da sessão que é gravada em login.php -->
					<?php 
						if (isset($_SESSION['nivel']) && $_SESSION['nivel'] >= 1) {
						$link1 = '<li><a href="#" style="text-decoration:none"><font size="2"color="#FFFFFF">FILMES</font></a></li>';
						$link2 = '<li><a href="http://localhost/teste/locadora/filmes/listar_filmes.php" style="text-decoration:none"><font size="2"color="#FFFFFF">GERÊNCIAR FILMES</font></a></a></li>';
						$link3 = '<li><a href="http://localhost/teste/locadora/clientes/painel.php" style="text-decoration:none"><font size="2"color="#FFFFFF">PERFIL DO USUÁRIO</font></a></a></li>';
						$link4 = '<li><a href="#" style="text-decoration:none"><font size="2"color="#FFFFFF">PERFIL DO FUNCIONÁRIO</font></a></a></li>';
						$link5 = '<li><a href="http://localhost/teste/locadora/funcionarios/listar_funcionarios.php" style="text-decoration:none"><font size="2"color="#FFFFFF">GERÊNCIAR FUNCIONÁRIOS</font></a></a></li>';
							if ($_SESSION['nivel'] == 3) {
								echo $link1;
								echo $link2;
								echo $link3;
								echo $link4;
								echo $link5;
							} elseif ($_SESSION['nivel'] == 2) {
								echo $link1;
								echo $link2;
								echo $link4;
							} elseif ($_SESSION['nivel'] == 1) {
								echo $link1;
								echo $link3;
							} else {
								echo "ERRO!";
							}
						} 
					?>
				</ul></td>
				<td rowspan="2">
				
			</div>
			