<?php
	session_start();
	if (!isset($_SESSION['nivel']) || $_SESSION['nivel'] < 2) {
		echo "<br/><br/><br/><br/><p align='center'><b>Acesso negado!</b></p><p align='center'><a href='http://localhost/teste/locadora/index.php'><b>HOME PAGE</b></a></p>";
	} else {
	require '../conexao.php';
	mysqli_query($conexao, "SET NAMES 'UTF8';");//configurando codificação
	$listagem = mysqli_query($conexao, "SELECT * FROM filme");
    $destino = "inserir_filme.php";
    $legenda = "Incluir";
	if (isset($_GET['codigo'])) {
		$codigo = $_GET['codigo'];
		$sql = "SELECT * FROM filme WHERE cod_filme='$codigo'";
		$linhas = mysqli_query($conexao, $sql);
		$linha = mysqli_fetch_array($linhas);
		$destino = 'alterar_filme.php';
		$legenda = "Alterar";
		$oculto = "<input type='hidden' name='codigo' value='".$codigo."'/>";
	}
		
    include '../template_topo.php';	
?>
		<h3 align="center"><font face="verdana" color="#A0A0A0">FILMES</font></h3>
		<form action="<?= $destino; ?>" method="post">
			<?= @$oculto; ?>
			<fieldset>
				<legend><h4><?= $legenda ?></h4></legend>
			<table align="center" border="0" cellspacing="0" cellpadding="10">
				<tr height="75">
			<td>Filme: </td><td><input type="text" name="filme" value="<?= @$linha['titulo'] ?>"/></td>
				</tr><tr height="75">
			<td>Sinopse: </td><td><textarea name="sinopse"><?= @$linha['sinopse'] ?></textarea></td>
				</tr><tr height="75">
			<td>Quantidade: </td><td><input type="number" name="quantidade" value="<?= @$linha['quantidade'] ?>"/></td>
				</tr><tr height="75">
			<td>Trailer: </td><td><input type="text" name="trailer" value="<?= @$linha['trailer'] ?>"/></td>
				</tr><tr height="75">
			<td>Categoria: </td><td><input type="text" name="trailer" value="<?= @$linha['categoria'] ?>"/></td>
				</tr>
			</table>
			<p align="center"><input type="submit" value="Enviar"/></p>
			</fieldset>
		</form>
		<br /><br />
		<h3><font face="verdana" color="#A0A0A0">DVDS CADASTRADOS</font></h3>
		<hr width="100%"/>
		
		<table border="0" cellspacing="0" cellpadding="7" align="center" width="1000">
			<tr>
				<th></th>
				<th>Relatório</th>
				<th align="left">Filme</th>
				<th></th>
			</tr>
		<?php
			while ($linha = mysqli_fetch_array($listagem)) {
		?>
			<tr height="25">
				<td align="center"><a href="listar_filmes.php?codigo=<?= $linha['cod_filme']; ?>"><font color="green">ALTERAR</font></a></td>
				<td align="center">
					<a href="imprimir_filme.php?codigo=<?= $linha['cod_filme']; ?>" target="_blank"><font color="#A0A0A0">PDF</font></a>
					<font color="#A0A0A0">/</font>
					<a href="relatoriotxt.php?codigo=<?= $linha['cod_filme']; ?>" target="_blank"><font color="#A0A0A0">TXT</font></a>
				</td>
				<td><?php echo $linha['titulo'];?></td>
				<td align="center"><a href="excluir_filme.php?codigo=<?= $linha['cod_filme']; ?>"><font color="red">EXCLUIR</font></a></td>
			</tr>
		
		<?php
			}
		?>
		</table>
		<hr width="100%"/>
		<p align="center"><b>Imprimir listagens de filme em</b></p>
		<p align="center">
		<a href="imprimir_filme.php?codigo=<?= $linha['cod_filme']; ?>" target="_blank" style="text-decoration:none"><font color="#A0A0A0">PDF</font></a>
		<font color="#000000"><b>ou</b></font>
		<a href="relatoriotxt.php?codigo=<?= $linha['cod_filme']; ?>" target="_blank" style="text-decoration:none"><font color="#A0A0A0">TXT</font></a>
		</p>
		<br /><br /><br />
		


<?php
	include '../template_rodape.php';
	}
?>