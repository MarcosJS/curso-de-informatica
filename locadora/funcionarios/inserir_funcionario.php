<?php
    require '../conexao.php';
	mysqli_query($conexao, "SET NAMES 'UTF8';");
	@$nome = $_POST['nome'];
	@$pai = $_POST['pai'];
	@$mae = $_POST['mae'];
	@$cpf = $_POST['cpf'];
	@$rg = $_POST['rg'];
	@$nascimento = $_POST['nascimento'];
	@$naturalidade = $_POST['naturalidade'];
	@$funcao = $_POST['funcao'];
	@$escolaridade = $_POST['escolaridade'];
	@$salario = $_POST['salario'];
	@$email = $_POST['email'];
	@$senha = $_POST['senha'];
	
	if (!empty($_POST)){
	$sql = "INSERT INTO usuario (nome, pai, mae, cpf, rg, nascimento, naturalidade, funcao, escolaridade, salario, email, senha) 
	VALUES ('$nome', '$pai', '$mae', '$cpf', '$rg', '$nascimento', '$naturalidade', '$funcao', '$escolaridade', '$salario', '$email', '$senha')";
	mysqli_query($conexao, $sql) or die('Error: '.mysqli_error($conexao));
	header('location: listar_funcionarios.php');
	exit;
	}// else {
		//echo "Error";
	//}
?>