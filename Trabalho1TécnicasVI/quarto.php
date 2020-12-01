<?php

require_once('conexao.php');

if (isset($_POST['NumeroNaPorta']) && $_POST['NumeroNaPorta'] != "") {

	$id = $_POST['id'];
	$NumeroNaPorta = $_POST['NumeroNaPorta'];
	$TipoDoQuarto = $_POST['TipoDoQuarto'];
	$ValorDiaria = $_POST['valor_diaria'];
	$status = $_POST['status'];

	if ($id == "") {
		$sql = "insert into quartos (NumeroNaPorta, TipoDoQuarto, ValorDiaria, status)
				values ('$NumeroNaPorta', '$TipoDoQuarto', '$ValorDiaria', '$status')
			";
	} else {
		$sql = "update quartos set NumeroNaPorta = '$NumeroNaPorta', TipoDoQuarto = '$TipoDoQuarto', ValorDiaria = '$ValorDiaria', status = '$status'
					where id = " . $id;
	}

	$resultado = mysqli_query($conexao, $sql);

	if ($resultado && $id == "") {
		$_GET['msg'] = 'Informações completas';
		$_POST = null;
	} elseif ($resultado && $id != "") {
		$_GET['msg'] = 'Informações atualizadas';
		$_POST = null;
	} elseif (!$resultado) {
		$_GET['msg'] = 'Erro';
	}
}

if (isset($_GET['msg']) && $_GET['msg'] != "") {
	echo $_GET['msg'];
}

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
	<title>Quartos Serras de Minas</title>
	<meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" href="estilo.css">
</head>

<body>
	<?php include_once("direction.php"); ?>
	<h2 align=center>Quartos:</h2>

	<table border=2 width=80% align=center>
		<tr>
			<td><label for="NumeroNaPorta">Numero do Quarto:</label></td>
			<td><label for="TipoDoQuarto">Tipo do Quarto:</label></td>
			<td><label for="ValorDiaria">Valor da Diária:</label></td>
			<td><label for="status">Status:</label></td>
			<td><label for="acoes">Ações</label></td>
		</tr>


		<?php
		$sql = "select id, num_porta, TipoDoQuarto, ValorDiaria, status from quartos ";
		$resultado = mysqli_query($conexao, $sql);

		while ($dados = mysqli_fetch_array($resultado)) {
			echo '<tr><td>' . $dados['num_porta'] . '</td>
				  <td>' . $dados['TipoDoQuarto'] . '</td>
				  <td>' . $dados['ValorDiaria'] . '</td>        
				  <td>' . $dados['status'] . '</td>
				  <td>
					<a href="excluir.php?id=' . $dados['id'] . '">Excluir</a>
					<a href="cadastroQuartos.php?id=' . $dados['id'] . '">Alterar</a>
				  </td></tr>';
		}

		mysqli_close($conexao);

		?>

	</table>
</body>

</html>