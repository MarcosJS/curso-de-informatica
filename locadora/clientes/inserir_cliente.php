<?php
	//conectando ao banco de dados através do 'require'
    require '../conexao.php';
	mysqli_query($conexao, "SET NAMES 'UTF8';");
	
	//recebendo e tratando os dados
	$nome = $_POST['nome'];
	$sobrenome = $_POST['sobrenome'];
	$telefone = $_POST['telefone'];
	$endereco = $_POST['endereco'];
	$email = $_POST['email'];
	$senha = $_POST['senha'];
	$status = $_POST['status'];
	$nivel = $_POST['nivel'];
	
	//consulta no data base para validação dos dados
	$result = mysqli_query($conexao,"SELECT * FROM cliente WHERE email='$email'");
	
	//estrutura de decisão usada na validação de dados
	if (empty($nome) || empty($sobrenome) || empty($telefone) || empty($endereco) || empty($email) || empty($senha)){
		header('location: cadastro.php?erro_cad=cadincompleto');
		exit;
	} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		header('location: cadastro.php?erro_cad=emailinvalido');
		exit;
	} elseif (strlen($senha)< 8) {
		header('location: cadastro.php?erro_cad=senhaincompleta');
		exit;
	} elseif (mysqli_num_rows($result)>=1) {
		header('location: cadastro.php?erro_cad=emailutilizado');
		exit;
	} 
	//inserção dos dados no data base caso eles passem na validação
	  else {
		$sql = "INSERT INTO cliente (nome, sobrenome, telefone, endereco, email, senha, status, nivel) VALUES ('$nome', '$sobrenome', '$telefone', '$endereco', '$email', '$senha', '$status', '$nivel')";
		mysqli_query($conexao, $sql) or die('Error: '.mysqli_error($conexao));
		header('location: ../index.php');
		exit;
	}
?>