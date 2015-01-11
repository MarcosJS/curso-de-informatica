<?php
	session_start();
	//chamando conexão e fazendo uma consulta no banco de dados para exibir uma lista de titulos na tela
	setcookie("meucoockie", "este [e um coockie", time()+60*60*24*365, "/" );
	require 'conexao.php';
	mysqli_query($conexao, "SET NAMES 'UTF8';");
	$listagem = mysqli_query($conexao, "SELECT * FROM filme");
    include 'template_topo.php';	
	setcookie("teste_de_codificacao_coockie", "este é um teste de codificação do coockie", time()+60*60*24*365, "/" );
?>
<!-- introduzi qualquer texto aqui apenas por questões estéticas -->
<h3><font face="verdana" color="#A0A0A0">OS DEZ MAIS</font></h3>
<hr width="100%"/>

<table border rules="cols" border="1" bordercolor="#ffffff" cellspacing="0" cellpadding="7" align="center" width="1000">
	<tr>
		<th>Código</th>
		<th>Filme</th>
		<th>Sinopse</th>
		<th>Trailer</th>
	</tr>
<?php
	while ($linha = mysqli_fetch_array($listagem)) {
?>
	<tr height="75" bgcolor="#EBEBEB">
		<td><?= $linha['codigo']; ?></td>
		<td align="center" ><b><?php echo $linha['titulo'];?></b></td>
		<td align="justify" ><?= $linha['sinopse']; ?></td>
		<td align="center" ><a href="#"><?= $linha['trailer']; ?></a></td>
	</tr>

<?php
	}
?>
</table>
<hr width="100%"/>
<br /><br /><br />


<?php
	include 'template_rodape.php';
?>