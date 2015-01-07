<?php
	require '../conexao.php';
	mysqli_query($conexao, "SET NAMES 'UTF8';");//configurando codificação
	$listagem = mysqli_query($conexao, "SELECT * FROM cliente");
    $destino = "inserir_cliente.php";
    $legenda = "Cadastrar";
	
	//estrutura de decisão usada na alteração cadastral vinda do perfil do cliente
	if (!empty($_GET['cod_cliente'])) {
		$cod_cliente = $_GET['cod_cliente'];
		$sql = "SELECT * FROM cliente WHERE codigo='$cod_cliente'";
		$linhas = mysqli_query($conexao, $sql);
		$linha = mysqli_fetch_array($linhas);
		$destino = 'alterar_cadastro.php';
		$legenda = "Alterar";
		$oculto = "<input type='hidden' name='codigo' value='".$cod_cliente."'/>";
	
	//parte da estrutura de decisão usada para tratar erros na validação dos dados caso ela ocorra	
	} elseif (!empty($_GET['erro_cad']) && $_GET['erro_cad'] == "cadincompleto") {
		$msg= '<h4 align="center"><font color="#FA8F8F" face="arial">Por favor preencha todos os dados!</font></h4>';
	} elseif (!empty($_GET['erro_cad']) && $_GET['erro_cad'] == "emailinvalido") {
		$msg= '<font color="#FA8F8F" face="arial"><h4 align="center">Formato de e-mail invalido!</h4>
		       <p>Seu e-mail deve seguir modelos como estes:<br/> seuemail@servidor.com,<br/> seuemail@servidor.com.br, ...</font></p><br/>';
	} elseif (!empty($_GET['erro_cad']) && $_GET['erro_cad'] == "senhaincompleta") {
		$msg= '<h4 align="center"><font color="#FA8F8F" face="arial">Sua senha deve ter no minimo 8(oito) digitos!</font></h4>';
	} elseif (!empty($_GET['erro_cad']) && $_GET['erro_cad'] == "emailutilizado") {
		$msg= '<h4 align="center"><font color="#FA8F8F" face="arial">Já existe um usuário cadastrado com este e-mail!</font></h4>';
	}	
    
	//inclusão do cabeçalho
    include '../template_topo.php';	
?>
		<!-- corpo da pagina contendo um formulário HTML -->
		<h3 align="center"><font face="verdana" color="#A0A0A0">ÁREA DE CADASTRO</font></h3>
		<?= @$msg;?>
		<form action="<?= $destino; ?>" method="post">
			<?= @$oculto; ?>
			<fieldset>
				<legend><h4><?= $legenda ?></h4></legend>
			<table align="center" border="0" cellspacing="0" cellpadding="10">
				<tr height="75">
			<td>Nome: </td><td><input type="text" name="nome" value="<?= @$linha['nome'] ?>"/></td>
				</tr><tr height="75">
			<td>Sobrenome: </td><td><input type="text" name="sobrenome" value="<?= @$linha['sobrenome'] ?>"/></td>
				</tr><tr height="75">
			<td>Telefone: </td><td><input type="text" name="telefone" value="<?= @$linha['telefone'] ?>"/></td>
				</tr><tr height="75">
			<td>Endereço: </td><td><input type="text" name="endereco" value="<?= @$linha['endereco'] ?>"/></td>
				</tr><tr height="75">
			<td>E-mail: </td><td><input type="text" name="email" value="<?= @$linha['email'] ?>"/></td>
				</tr><tr height="75">
			<td>Senha: </td><td><input type="password" name="senha" value="<?= @$linha['senha'] ?>"/></td>
				</tr>
			</table>
			<input type='hidden' name='status' value="0"/>
			<input type='hidden' name='nivel' value="1"/>
			<p align="center"><input type="submit" value="Concluir Cadastro"/></p>
			</fieldset>
		</form>
		
		<hr width="999"/>

<!-- inclusão do rodape -->		
<?php
	include '../template_rodape.php';
?>