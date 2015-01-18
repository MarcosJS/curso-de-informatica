<?php
    require '../conexao.php';
	mysqli_query($conexao, "SET NAMES 'UTF8';");
	@$matricula = $_POST['matricula'];
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
	$sql = "UPDATE usuario SET 
	matricula='$matricula', nome='$nome', pai='$pai', mae='$mae', cpf='$cpf', rg='$rg', nascimento='$nascimento', naturalidade='$naturalidade', funcao='$funcao', escolaridade='$escolaridade', salario='$salario', email='$email', senha='$senha' 
	WHERE matricula='$matricula'";
	mysqli_query($conexao, $sql) or die('Error: '.mysqli_error($conexao));
	header('location: listar_funcionarios.php');
	exit;
	}
?>