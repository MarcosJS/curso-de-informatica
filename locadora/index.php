<?php
	// Iniciando a sessão
	session_start();
	
	// Chamando conexão e fazendo uma consulta no banco de dados para exibir uma lista de titulos na tela
	require 'conexao.php';
	mysqli_query($conexao, "SET NAMES 'UTF8';");
	$listagem = mysqli_query($conexao, "SELECT * FROM filme");
    
	// Inclusão do cabeçalho
	include 'template_topo.php';	
?>

<!-- Introduzi qualquer texto nesta pagina apenas por questões estéticas -->
<h1 align="center"><span>OS DEZ MAIS</span></h1>
<br/>
<!--rules="cols"-->
<table  border="0" cellspacing="10">
	<tr>
		<th>Código</th>
		<th>Filme</th>
		<th>Sinopse</th>
		<th>Trailer</th>
	</tr>
	
<?php
	// Iniciando a estrutura de repetição para montar a tabela
	while ($linha = mysqli_fetch_array($listagem)) {
?>

	<tr>
		<td align="center"><?= $linha['cod_filme']; ?></td>
		<td align="center" ><b><?php echo $linha['titulo'];?></b></td>
		<td align="justify" ><?= $linha['sinopse']; ?></td>
		<td align="center" ><a href="#"><?= $linha['trailer']; ?></a></td>
	</tr>

<?php
// Finalizando a estrutura de repetição
	}
?>

</table>

<?php
	// Inclusão do rodapé
	include 'template_rodape.php';
?>