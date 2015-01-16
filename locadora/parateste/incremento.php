<?php
			if (!empty($_GET['cin'])){
				echo 'incrementado 50 linhas no banco de dados';
			} elseif (!empty($_GET['cem'])) {
				echo 'incrementado 100 linhas no banco de dados';
			}
			include 'conexao.php';
			mysqli_query($conexao, "SET NAMES 'UTF8';");
			$sql = "SELECT cod_filme FROM filme ORDER BY cod_filme DESC LIMIT 0, 1";
			$atual = mysqli_query($conexao, $sql);
			$atual = mysqli_fetch_array($atual);
			$titulo = "Qualquer nome".$atual['cod_filme'];
			$sinopse = "Coloquei esta frase só pra incluir algo no campo 'sinopse'".$atual['cod_filme'];
			$sinopse = mysqli_escape_string($conexao, $sinopse);
			$quantidade = "1".$atual['cod_filme'];
			$trailer = "www.site.com".$atual['cod_filme'];
			
			if (isset($_POST)){			
				if (!empty($_POST['100'])){
					for ($i=0; $i < 100; $i++) { 
						$atual++;
						$sql = "INSERT INTO filme (titulo, sinopse, quantidade, trailer) VALUES ('$titulo', '$sinopse', '$quantidade', '$trailer')";
						mysqli_query($conexao, $sql) or die('Error: '.mysqli_error($conexao));
						
					}
					echo 'incrementado 100 linhas no banco de dados';
					header("Location: incremento.php?cem=100");		
				} elseif (!empty($_POST['50'])) {
					for ($i=0; $i < 50; $i++) { 
						$atual++;
						$sql = "INSERT INTO filme (titulo, sinopse, quantidade, trailer) VALUES ('$titulo', '$sinopse', '$quantidade', '$trailer')";
						mysqli_query($conexao, $sql) or die('Error: '.mysqli_error($conexao));
						
					}
					
					header("Location: incremento.php?cin=50");
				}
			}
			mysqli_close($conexao);
?>
<html>
	<head>
		<title>Incrementado o banco de dados</title>
	</head>
	<body>
		<p align="center"><b><?php echo "O utltimo codigo da tabela e: ".$atual['cod_filme']; ?></b></p>
		<form action="incremento.php" method="post">
			<fieldset width="50">
				<legend><h4>Incrementar o banco de dados em 100 linhas?</h4></legend>
				<input type="hidden" name="100" value="100"/>
				<p align="center"><input type="submit" value="Incrementar"/></p>
			</fieldset>
		</form>
		
		<form action="incremento.php" method="post">
			<fieldset>
				<legend><h4>Incrementar o banco de dados em 50 linhas?</h4></legend>
				<input type="hidden" name="50" value="50"/>
				<p align="center"><input type="submit" value="Incrementar"/></p>
			</fieldset>
		</form>
		
	</body>
</html>