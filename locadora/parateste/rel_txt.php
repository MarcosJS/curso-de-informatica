<?php
	// Chamando a conexão
    require 'conexao.php';
    mysqli_query($conexao, "SET NAMES 'UTF8';");
	
	// Função para converter strings
	function converte($string) {
		return iconv("UTF-8", "ISO-8859-1", $string);
	}
	// Funçao para o cabeçalho
	function relTopo($data,$hora,$titulo,$pagina) {
		global $texto, $arquivo;
		$texto = str_pad(converte('MJS LOCADORA LTDA'), 97, " ", STR_PAD_RIGHT).'CNPJ: 488.890.0001/58'."\r\n";
		fwrite($arquivo, $texto);
		$texto = str_pad("Rua Manoel Barros da Silva, s/n, Centro", 108, " ", STR_PAD_RIGHT).$data."\r\n";
		fwrite($arquivo, $texto);
		$texto = str_pad(converte('São Benedito do Sul-PE')	, 110, " ", STR_PAD_RIGHT).$hora."\r\n";
		fwrite($arquivo, $texto);
		$texto = str_pad('atendimento@mjslocadora.com', 20, " ", STR_PAD_RIGHT).str_pad(converte($titulo), 64, " ", STR_PAD_BOTH).str_pad("Pag.: ".$pagina, 27, " ", STR_PAD_LEFT)."\r\n";
		fwrite($arquivo, $texto);
	}
		// Função para os campos
	function relCampo() {
		global $texto, $arquivo;
		$texto = str_repeat("-", 118)."\r\n";
		$texto.= str_pad(converte('Código'), 6, " ", STR_PAD_BOTH).' | ';
		$texto.= str_pad(converte('Título')	, 34, " ", STR_PAD_RIGHT).' | ';
		$texto.= str_pad('Sinopse', 46, " ", STR_PAD_RIGHT).' | ';
		$texto.= str_pad('Quantidade', 10, " ", STR_PAD_RIGHT).' | ';
		$texto.= str_pad('Categoria', 10, " ", STR_PAD_BOTH);
		$texto.= "\r\n";
		$texto.= str_repeat('-', 118)."\r\n";
		fwrite($arquivo, $texto);
	}
	
	date_default_timezone_set('America/Recife');
	$dt = date('d:m:Y');
	$mesano = date('m-Y');
	$hr = date("H:i:s");
	$pg = 1;
	
	$arquivo = fopen('relatorios/REL_FILME'.$mesano.'.txt', 'w');
	
	relTopo($dt, $hr, "RELATÓRIO DE FILMES", $pg);
    
    relCampo();
	
	// Consultando o banco de dados
	if (isset($_GET['codigo']) && $_GET['codigo'] <> "") {
		$codigo = $_GET['codigo'];
		$sql = "SELECT * FROM filme WHERE cod_filme='$codigo';";	
	} else {
		$sql = "SELECT * FROM filme;";
	}
	
	$resultado = mysqli_query($conexao, $sql);
	
	// Escrevendo as linhas com os dados da tabela
	$ln = 0;
	while($res = mysqli_fetch_array($resultado)) {
			
		$res['titulo'] = substr(converte($res['titulo']),0,34);	
		$res['sinopse'] = substr(converte($res['sinopse']),0,43);
		
		// Dados do relatorio
		$texto = str_pad($res['cod_filme'], 6, ' ', STR_PAD_BOTH).' | ';
		$texto.= str_pad($res['titulo'], 34, ' ', STR_PAD_RIGHT).' | ';
		$texto.= str_pad($res['sinopse']."...", 46, ' ', STR_PAD_RIGHT).' | ';
		$texto.= str_pad($res['quantidade'], 10, ' ', STR_PAD_LEFT).' | ';
		$texto.= str_pad(converte($res['categoria']), 10, ' ', STR_PAD_BOTH)."\r\n";
		fwrite($arquivo, $texto);
		$ln++;
		if ($ln%69==0) {
			$pg++;
			relTopo($dt, $hr, "RELATÓRIO DE FILMES", $pg);
			relCampo();
		}
	}
	$texto = str_repeat('-', 118);
	fwrite($arquivo, $texto);
	
	// A variavel '$ln' é tratada mais uma vez aqui
	while ($ln%69!=0) {
		$texto = "\r\n";
		fwrite($arquivo, $texto);
		$ln++;
	}
	
	// Totais
	$pg++;
	relTopo($dt, $hr, "RELATÓRIO DE FILMES", $pg);
	$texto = str_repeat("-", 118);
	$texto.= "\r\n".str_pad(converte('TOTAIS GERAIS'.$ln), 118, " ", STR_PAD_BOTH)."\r\n";
	$texto.= str_repeat("-", 118)."\r\n";
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
	$texto.= str_repeat('-', 118)."\r\n";
	fwrite($arquivo, $texto);
	
	$texto = str_repeat("-", 118);
	$texto.= "\r\n".str_pad(str_pad(converte('Títulos:'), 29, " ", STR_PAD_BOTH).str_pad(converte('Categorias:'), 29, " ", STR_PAD_BOTH).str_pad(converte('Estoque:'), 29, " ", STR_PAD_BOTH),118,' ',STR_PAD_BOTH)."\r\n";
	$texto.= str_repeat("-", 118);
	fwrite($arquivo, $texto);
	
	// Fechando arquivo
	fclose($arquivo);
	header ('Location: relatorios/REL_FILME'.$mesano.'.txt');
?>