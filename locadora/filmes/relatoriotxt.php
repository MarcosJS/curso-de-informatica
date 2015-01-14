<?php
    // Chamando a conexão
    require '../conexao.php';
    mysqli_query($conexao, "SET NAMES 'UTF8';");
	
	// Função para converter strings
	function converte ($string) {
		return iconv("UTF-8", "ISO-8859-1", $string);
	}
	
    // Cabeçalho
    $arquivo = fopen('relatorios/rel_filme.txt', 'w');
	$texto = str_repeat('-', 118);
	$texto.= "\r\n";
	$texto.= str_pad(converte('Código'), 6, " ", STR_PAD_BOTH).' | ';
	$texto.= str_pad(converte('Título')	, 34, " ", STR_PAD_RIGHT).' | ';
	$texto.= str_pad('Sinopse', 46, " ", STR_PAD_RIGHT).' | ';
	$texto.= str_pad('Quantidade', 10, " ", STR_PAD_RIGHT).' | ';
	$texto.= str_pad('Categoria', 10, " ", STR_PAD_BOTH);
	$texto.= "\r\n";
	$texto.= str_repeat('-', 118);
	$texto.= "\r\n";
	fwrite($arquivo, $texto);
	
	// Consultando o banco de dados
	if (isset($_GET['codigo']) && $_GET['codigo'] <> "") {
		$codigo = $_GET['codigo'];
		$sql = "SELECT * FROM filme WHERE cod_filme='$codigo';";	
	} else {
		$sql = "SELECT * FROM filme;";
	}
	//$sql = "SELECT * FROM filme";
	$resultado = mysqli_query($conexao, $sql);
	// Escrevendo as linhas com os dados da tabela
	while($res = mysqli_fetch_array($resultado)) {
		$res['titulo'] = substr(converte($res['titulo']),0,34);	
		$res['sinopse'] = substr(converte($res['sinopse']),0,43);
		
		// Dados do relatorio
		$texto = str_pad($res['cod_filme'], 6, ' ', STR_PAD_BOTH).' | ';
		$texto.= str_pad($res['titulo'], 34, ' ', STR_PAD_RIGHT).' | ';
		$texto.= str_pad($res['sinopse']."...", 46, ' ', STR_PAD_RIGHT).' | ';
		$texto.= str_pad($res['quantidade'], 10, ' ', STR_PAD_LEFT).' | ';
		$texto.= str_pad(converte($res['categoria']), 10, ' ', STR_PAD_BOTH);
		$texto.= "\r\n";
		//$texto.= str_repeat('-', 122);
		//$texto.= "\r\n";
		fwrite($arquivo, $texto);
	}
	fclose($arquivo);
	header ('Location: relatorios/rel_filme.txt');
	//echo '<center>';
    //echo "Arquivo gerado com sucesso<br>";
    //echo "<a target=newwindow href='relatorios/rel_filme.txt'> Clique aqui para baixar</a>";
    //echo '</center>';
?>