<?php

require_once('conexao.php');

if (isset($_POST['nomeCliente']) && $_POST['nomeCliente'] != "") {

	$id = $_POST['id'];
	$nomeCliente = $_POST['nomeCliente'];
	$documento = $_POST['documento'];
	$DataNascimento = $_POST['DataNascimento'];
	$cidade = $_POST['cidade'];
	$estado = $_POST['estado'];

	if ($id == "") {
		$sql = "insert into pousada (nomeCliente, documento, DataNascimento, cidade, estado)
				values ('$nomeCliente', '$documento', '$DataNascimento', '$cidade', '$estado')
			";
	} else {
		$sql = "update pousada set nomeCliente = '$nomeCliente', documento = '$documento', DataNascimento = '$DataNascimento', cidade = '$cidade', estado = '$estado' 
					where id = " . $id;
	}

	$resultado = mysqli_query($conexao, $sql);

	if ($resultado && $id == "") {
		$_GET['msg'] = 'Cadastro realizado';
		$_POST = null;
	} elseif ($resultado && $id != "") {
		$_GET['msg'] = 'Cadastro alterado';
		$_POST = null;
	} elseif (!$resultado) {
		$_GET['msg'] = 'Por fovor ensira corretamente os dados';
	}
}

if (isset($_GET['msg']) && $_GET['msg'] != "") {
	echo $_GET['msg'];
}

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
	<title>pousada Pousada Serra Sul</title>
	<meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" href="estilo.css">
</head>

<body>
	<?php include_once("direction.php"); ?>
	
	<h2 align=center>Consulta de pousada Serra Sul:</h2>

	<table border=2 width=80% align=center>
		<tr>
			<td><label for="nomeCliente">Nome do Cliente:</label></td>
			<td><label for="documento">Documento de Identificação:</label></td>
			<td><label for="DataNascimento">Data de Nascimento:</label></td>
			<td><label for="cidade">Cidade:</label></td>
			<td><label for="estado">Estado:</label></td>
			<td><label for="acoes">Opções</label></td>
		</tr>


		<?php
		$sql = "select id, nomeCliente, documento, DataNascimento, cidade, estado from pousada ";
		$resultado = mysqli_query($conexao, $sql);

		while ($dados = mysqli_fetch_array($resultado)) {
			echo '<tr><td>' . $dados['nomeCliente'] . '</td>
				  <td>' . $dados['documento'] . '</td>
				  <td>' . $dados['DataNascimento'] . '</td>        
          <td>' . $dados['cidade'] . '</td>
          <td>' . $dados['estado'] . '</td>
				  <td>
					<a href="excluir_pousada.php?id=' . $dados['id'] . '">Excluir</a>
					<a href="cadastropousada.php?id=' . $dados['id'] . '">Alterar</a>
				  </td></tr>';
		}

		mysqli_close($conexao);

		?>

	</table>
</body>

</html>