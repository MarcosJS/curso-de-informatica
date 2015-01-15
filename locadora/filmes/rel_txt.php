<?php
	session_start();
	if (!isset($_SESSION['nivel']) || $_SESSION['nivel'] < 2) {
		echo "<br/><br/><br/><br/><p align='center'><b>Acesso negado!</b></p><p align='center'><a href='http://localhost/teste/locadora/index.php'><b>HOME PAGE</b></a></p>";
	} else {
    // Chamando a conexão
    require '../conexao.php';
    mysqli_query($conexao, "SET NAMES 'UTF8';");
	
	// Função para converter strings
	function converte ($string) {
		return iconv("UTF-8", "ISO-8859-1", $string);
	}
	
	date_default_timezone_set('America/Recife');
	$data = date('d:m:Y');
	$mesano = date('m-Y');
	$hora = date("H:i:s");
	
	// Cabeçalho
	$arquivo = fopen('relatorios/REL_FILME'.$mesano.'.txt', 'w');
	$texto = str_pad(converte('MJS LOCADORA LTDA'), 97, " ", STR_PAD_RIGHT);
	$texto.= str_pad('CNPJ: 488.890.0001/58', 0, " ", STR_PAD_LEFT)."\r\n";
	fwrite($arquivo, $texto);
	$texto = str_pad(converte('Rua Manoel Barros da Silva')	, 108, " ", STR_PAD_RIGHT);
	$texto.= str_pad($data, 0, "-", STR_PAD_LEFT)."\r\n";
	fwrite($arquivo, $texto);
	$texto = str_pad('atendimento@mjslocadora.com', 20, " ", STR_PAD_RIGHT);
	$texto.= str_pad(converte('RELATÓRIO DE FILMES'), 64, " ", STR_PAD_BOTH);
	$texto.= str_pad($hora, 27, " ", STR_PAD_LEFT)."\r\n";
	fwrite($arquivo, $texto);
	
    // Nomes dos campos
    $texto = str_repeat("-", 118);
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
		fwrite($arquivo, $texto);
	}
	$texto = str_repeat('-', 118)."\r\n";
	fwrite($arquivo, $texto);
	
	// Totais
	$texto = str_repeat("-", 118);
	$texto.= "\r\n".str_pad(converte('TOTAIS GERAIS'), 118, " ", STR_PAD_BOTH)."\r\n";
	$texto.= str_repeat("-", 118);
	$texto.= "\r\n";
	fwrite($arquivo, $texto);
	
	$texto = str_pad(str_pad(' ',   15, ' ', STR_PAD_RIGHT).converte('Tít.').'   '.'Est.'.' | '.str_pad(' ',   15, ' ', STR_PAD_RIGHT).converte('Tít.').'   '.'Est.'.' | '.str_pad(' ',   15, ' ', STR_PAD_RIGHT).converte('Tít.').'   '.'Est.'.' | ',118,' ',STR_PAD_BOTH)."\r\n";
	$texto.= str_pad(str_pad(converte('Ação:'),   15, ' ', STR_PAD_RIGHT).'0000'.'   '.'0000'.' | '.str_pad(converte('Terror:'),   15, ' ', STR_PAD_RIGHT).'0000'.'   '.'0000'.' | '.str_pad(converte('Romance:'),   15, ' ', STR_PAD_RIGHT).'0000'.'   '.'0000'.' | ',118,' ',STR_PAD_BOTH)."\r\n";
	fwrite($arquivo, $texto);
	$texto = str_pad(str_pad('Aventura:',   15, ' ', STR_PAD_RIGHT).'0000'.'   '.'0000'.' | '.str_pad(converte('Biografia:'),   15, ' ', STR_PAD_RIGHT).'0000'.'   '.'0000'.' | '.str_pad(converte('Policial:'),   15, ' ', STR_PAD_RIGHT).'0000'.'   '.'0000'.' | ',118,' ',STR_PAD_BOTH)."\r\n";
	fwrite($arquivo, $texto);
	$texto = str_pad(str_pad('Guerra:',   15, ' ', STR_PAD_RIGHT).'0000'.'   '.'0000'.' | '.str_pad(converte('Ficção:'),   15, ' ', STR_PAD_RIGHT).'0000'.'   '.'0000'.' | '.str_pad(converte('Séries:'),   15, ' ', STR_PAD_RIGHT).'0000'.'   '.'0000'.' | ',118,' ',STR_PAD_BOTH)."\r\n";
	fwrite($arquivo, $texto);
	$texto = str_pad(str_pad('Drama:',   15, ' ', STR_PAD_RIGHT).'0000'.'   '.'0000'.' | '.str_pad(converte('Suspense:'),   15, ' ', STR_PAD_RIGHT).'0000'.'   '.'0000'.' | '.str_pad(converte('B.Fatos Reais:'),   15, ' ', STR_PAD_RIGHT).'0000'.'   '.'0000'.' | ',118,' ',STR_PAD_BOTH)."\r\n";
	fwrite($arquivo, $texto);
	$texto = str_pad(str_pad(converte('Comédia:'),   15, ' ', STR_PAD_RIGHT).'0000'.'   '.'0000'.' | '.str_pad(converte('Romance:'),   15, ' ', STR_PAD_RIGHT).'0000'.'   '.'0000'.' | '.str_pad(converte(' '),   15, ' ', STR_PAD_RIGHT).'    '.'   '.'    '.' | ',118,' ',STR_PAD_BOTH)."\r\n";
	$texto.= str_repeat('-', 118);
	$texto.= "\r\n";
	fwrite($arquivo, $texto);
	
	$texto = str_repeat("-", 118);
	$texto.= "\r\n".str_pad(str_pad(converte('Títulos:'), 29, " ", STR_PAD_BOTH).str_pad(converte('Categorias:'), 29, " ", STR_PAD_BOTH).str_pad(converte('Estoque:'), 29, " ", STR_PAD_BOTH),118,' ',STR_PAD_BOTH)."\r\n";
	$texto.= str_repeat("-", 118);
	fwrite($arquivo, $texto);
	
	// Fechando arquivo
	fclose($arquivo);
	header ('Location: relatorios/REL_FILME'.$mesano.'.txt');
    }
?>