<?php
	session_start();
	if (!isset($_SESSION['nivel']) || $_SESSION['nivel'] < 2) {
		echo "<br/><br/><br/><br/><p align='center'><b>Acesso negado!</b></p><p align='center'><a href='http://localhost/teste/locadora/index.php'><b>HOME PAGE</b></a></p>";
	} else {
    require '/fpdf/fpdf.php'; // Incluindo página da biblioteca
    require '../conexao.php';
	mysqli_query($conexao, "SET NAMES 'UTF8';");
	
	// Essa função converte caracteres especiais, com acentos
	function converte ($string) {
		return iconv("UTF-8", "ISO-8859-1", $string);
	}
	
	// Cria um documento no formato retrato, metrica de pontos e tamanho A4
	$pdf = new FPDF('P', 'pt', 'A4');
	
	$pdf->AddPage(); // Adiciona uma página
	// $pdf->Image('imagens/marca.png'); // Essa linha adcionaria uma imagem mas ainda não há
	
	// Endereco da empresa
	$pdf->SetFont('arial', '', 12);
	$pdf->Cell(0,20,"Rua Manoel Barros da Silva, s/n, Centro",0,1,'L');
	
	// Email para contato
	$pdf->SetFont('arial', '', 12);
	$pdf->Cell(70,20,"atendimento@mjslocadora.com",0,1,'L');
	
	// Agora é criado um espaçamento de 20 pontos
	$pdf->Ln(20);
	
	// Primeiro configuramos a fonte
	$pdf->SetFont('arial', 'B', 18);
	// Cada linha é colocada em uma fonte
	$pdf->Cell(0,5,converte("Relatório"),0,1,'C');
	// Agora é feita uma linha abaixo do Título 'Relatório'
	$pdf->Cell(0,5,"","B",1,'L');
	
	// Quando é enviada uma variavel pelo metodo get e ela não é vazia pega-se o registro solicitado, senão pega-se a lista completa
	if (isset($_GET['codigo']) && $_GET['codigo'] <> "") {
		$codigo = $_GET['codigo'];
		$sql = "SELECT * FROM filme WHERE cod_filme='$codigo';";	
	} else {
		$sql = "SELECT * FROM filme;";
	}
	
	// Agora recupera-se o registro ou a lista completa
	$listagem = mysqli_query($conexao, $sql);
	
	while ($linha = mysqli_fetch_array($listagem)) {
		// Código do filme
		$pdf->SetFont('arial','B',9);
		// Quando o texto tem ou pode ter acento utilizamos a função converte
		$pdf->Cell(70,15,converte("Código: "),0,0,'L');
		$pdf->SetFont('arial','',9);
		$pdf->Cell(0,15,$linha['cod_filme'],0,1,'L');
		
		// Título do filme
		$pdf->SetFont('arial','B',9);
		$pdf->Cell(70,15,"Filme: ",0,0,'L');
		$pdf->SetFont('arial','',9);
		$pdf->Cell(0,15,converte($linha['titulo']),0,1,'L');
		
		// Quantidade de DVDs
		$pdf->SetFont('arial','B',9);
		$pdf->Cell(70,15,"Quantidade: ",0,0,'L');
		$pdf->SetFont('arial','',9);
		$pdf->Cell(7,15,$linha['quantidade'],0,1,'L');
		
		// Sinopse do filme
		$pdf->SetFont('arial','B',9);
		$pdf->Cell(70,15,"Sinopse: ",0,0,'L');
		$pdf->SetFont('arial','',9);
		$pdf->MultiCell(0,15,converte($linha['sinopse']),0,'J');
		
		// Link para trailer do filme
		$pdf->SetFont('arial','B',9);
		$pdf->Cell(70,15,"Trailer: ",0,0,'L');
		$pdf->SetFont('arial','',9);
		$pdf->Cell(70,15,$linha['trailer'],0,1,'L');
		
		// Categoria
		$pdf->SetFont('arial','B',9);
		$pdf->Cell(70,15,"Categoria: ",0,0,'L');
		$pdf->SetFont('arial','',9);
		$pdf->Cell(0,15,converte($linha['categoria']),0,1,'L');
		
		$pdf->Ln(20);
	}
// Emissão
$pdf->Output('relatorio.pdf', 'I');
}
?>