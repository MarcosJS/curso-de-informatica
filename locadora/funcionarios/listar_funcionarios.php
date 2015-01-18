<?php
	session_start();	
	if (!isset($_SESSION['nivel']) || $_SESSION['nivel'] != 3) {
		echo "<br/><br/><br/><br/><p align='center'><b>Acesso negado!</b></p><p align='center'><a href='http://localhost/teste/locadora/index.php'><b>HOME PAGE</b></a></p>";
	} else {
	require '../conexao.php';
	mysqli_query($conexao, "SET NAMES 'UTF8';");//configurando codificação
	$listagem = mysqli_query($conexao, "SELECT * FROM usuario");
    $destino = "inserir_funcionario.php";
    $legenda = "Incluir";
	if (isset($_GET['matricula'])) {
		$matricula = $_GET['matricula'];
		$sql = "SELECT * FROM usuario WHERE matricula='$matricula'";
		$linhas = mysqli_query($conexao, $sql);
		$linha = mysqli_fetch_array($linhas);
		$destino = 'alterar_funcionario.php';
		$legenda = "Alterar";
		$oculto = "<input type='hidden' name='matricula' value='".$matricula."'/>";
	}
		
    include '../template_topo.php';	
?>
		<h3 align="center">FUNCIONÁRIOS</h3>
		<form action="<?= $destino; ?>" method="post">
			<?= @$oculto; ?>
			<fieldset>
				<legend><h4><?= $legenda ?></h4></legend>
			<table align="center" border="0" cellspacing="0" cellpadding="10">
				<tr height="25">
			<td>Nome: </td><td><input type="text" name="nome" value="<?= @$linha['nome'] ?>"/></td>
				</tr><tr height="25">
			<td>Nome do Pai: </td><td><input type="text" name="pai" value="<?= @$linha['pai'] ?>"/></td>
				</tr><tr height="25">
			<td>Nome da Mãe: </td><td><input type="text" name="mae" value="<?= @$linha['mae'] ?>"/></td>
				</tr><tr height="25">
			<td>CPF: </td><td><input type="text" name="cpf" value="<?= @$linha['cpf'] ?>"/></td>
				<tr height="25">
			<td>RG: </td><td><input type="text" name="rg" value="<?= @$linha['rg'] ?>"/></td>
				</tr><tr height="25">
			<td>Nascimento: </td><td><input type="text" name="nascimento" value="<?= @$linha['nascimento'] ?>"/></td>
				</tr><tr height="25">
			<td>Naturalidade: </td><td><input type="text" name="naturalidade" value="<?= @$linha['naturalidade'] ?>"/></td>
				</tr><tr height="25">
			<td>Função: </td><td><input type="text" name="funcao" value="<?= @$linha['funcao'] ?>"/></td>
				</tr><tr height="25">
			<td>Escolaridade: </td><td><input type="text" name="escolaridade" value="<?= @$linha['escolaridade'] ?>"/></td>
				</tr><tr height="25">
			<td>Salário: </td><td><input type="text" name="salario" value="<?= @$linha['salario'] ?>"/></td>
				</tr><tr height="25">
			<td>E-mail: </td><td><input type="text" name="email" value="<?= @$linha['email'] ?>"/></td>
				</tr><tr height="25">
			<td>Senha: </td><td><input type="password" name="senha" value="<?= @$linha['senha'] ?>"/></td>
			<input type="hidden" name="nivel" value="2" />
				</tr>
			</table>
			<p align="center"><input type="submit" value="Enviar"/></p>
			</fieldset>
		</form>
		<br /><br />
		<h3 align="center">FUNCIONÁRIOS CADASTRADOS</h3>
		<hr width="1000"/>
		
		<table border="0" cellspacing="0" cellpadding="7" align="center" width="1000">
			<tr>
				<th></th>
				<th>Matrícula</th>
				<th>Nome</th>
				<th>CPF</th>
				<th>Função</th>
			</tr>
		<?php
			while ($linha = mysqli_fetch_array($listagem)) {
		?>
			<tr height="25">
				<td align="center"><a href="listar_funcionarios.php?matricula=<?= $linha['matricula']; ?>"><font color="green">ALTERAR</font></a></td>
				<td align="center"><?= $linha['matricula'];?></td>
				<td align="center"><?= $linha['nome'];?></td>
				<td align="center"><?= $linha['cpf']; ?></td>
				<td align="center"><?= $linha['funcao'];?></td>
				<td align="center"><a href="excluir_funcionario.php?matricula=<?= $linha['matricula']; ?>"><font color="red">EXCLUIR</font></a></td>
			</tr>
			<tr><td></td><td><hr /></td><td><hr /></td><td><hr /></td><td><hr /></td><td><hr /></td></tr>
		<?php
			}
		?>
		</table>

<?php
	include '../template_rodape.php';
}
?>