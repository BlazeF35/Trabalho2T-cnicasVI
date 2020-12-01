<?php

require_once('conexao.php');

if (isset($_POST['id_quarto']) && $_POST['id_quarto'] != "") {
	$id_quarto = $_POST['id_quarto'];
	$sql = " select ValorDiaria from quartos where id = " . $id_quarto .  "";
	$resultado = mysqli_query($conexao, $sql);
	$dados = mysqli_fetch_array($resultado);
	$ValorDiaria = $dados['ValorDiaria'];
}

if (isset($_POST['id_cliente']) && $_POST['id_cliente'] != "") {
	$id = $_POST['id'];
	$id_cliente = $_POST['id_cliente'];
	$data_entrada = $_POST['data_entrada'];
	$data_saida = $_POST['data_saida'];
	$diferenca = strtotime($data_saida) - strtotime($data_entrada);
	$dias = floor($diferenca / (60 * 60 * 24));

	$valor_reserva = $dias * $ValorDiaria;
	$status_reserva = $_POST['status_reserva'];
	$datahora_status = date('Y/m/d H:i');

	if ($id == "") {
		$sql = "insert into reservas (id_quarto, id_cliente, data_entrada, data_saida, valor_reserva, status_reserva, datahora_status )
				values ('$id_quarto', '$id_cliente', '$data_entrada', '$data_saida', '$valor_reserva', '$status_reserva', '$datahora_status')
			";
	} else {
		$sql = "update reservas set id_quarto = '$id_quarto', id_cliente = '$id_cliente', data_entrada = '$data_entrada', data_saida = '$data_saida', valor_reserva = '$valor_reserva', status_reserva = '$status_reserva', datahora_status = '$datahora_status'
					where id = " . $id;
	}

	$resultado = mysqli_query($conexao, $sql);

	if ($resultado && $id == "") {
		$_GET['msg'] = 'Informações salvas';
		$_POST = null;
	} elseif ($resultado && $id != "") {
		$_GET['msg'] = 'Informações alteras';
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
	<title>Reservas Serras de Minas</title>
	<meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" href="estilo.css">
</head>

<body>
	<?php include_once("direction.php"); ?>
	<h2 align=center>Reservas efetuadas:</h2>

	<table border=1 width=80% align=center>
		<tr>
			<td><label for="NumeroNaPorta">Número do quarto:</label></td>
			<td><label for="nomeCliente">Nome do cliente:</label></td>
			<td><label for="data_entrada">Data de Entrada:</label></td>
			<td><label for="data_saida">Data de Saída:</label></td>
			<td><label for="valor_reserva">Valor da Reserva:</label></td>
			<td><label for="status_reserva">Status da Reserva:</label></td>
			<td><label for="datahora_status">Data/Hora Status da Reserva:</label></td>
			<td><label for="acoes">Opções</label></td>
		</tr>

		<?php
		$sql = "select r.*, NumeroNaPorta, c.nomeCliente from reservas as r left join quartos as q on r.id_quarto = q.id left join clientes as c on r.id_cliente = c.id";
		$resultado = mysqli_query($conexao, $sql);

		while ($dados = mysqli_fetch_array($resultado)) {
			echo '<tr><td>' . $dados['NumeroNaPorta'] . '</td>
				  <td>' . $dados['nomeCliente'] . '</td>
				  <td>' . $dados['data_entrada'] . '</td>        
					<td>' . $dados['data_saida'] . '</td>
					<td>' . $dados['valor_reserva'] . '</td>
					<td>' . $dados['status_reserva'] . '</td>
					<td>' . $dados['datahora_status'] . '</td>
				  <td>
					<a href="cadastroReservas.php?id=' . $dados['id'] . '">Alterar</a>
				  </td></tr>';
		}

		mysqli_close($conexao);

		?>

	</table>
</body>

</html>