  <?php

  require_once('conexao.php');

  $id_quarto = '';
  $id_clientes = '';
  $data_entrada = '';
  $data_saida = '';
  $valor_reserva = '';
  $status_reserva = '';
  $id = '';

  if (isset($_GET['id']) && $_GET['id'] != "") {
    $sql = "select * from pousada where id = " . $_GET['id'];
    $resultado = mysqli_query($conexao, $sql);
    if ($resultado) {
      $dados = mysqli_fetch_array($resultado);
      $id_quarto = $dados['id_quarto'];
      $id_cliente = $dados['id_cliente'];
      $data_entrada = $dados['data_entrada'];
      $data_saida = $dados['data_saida'];
      $valor_reserva = $dados['valor_reserva'];
      $status_reserva = $dados['status_reserva'];
      $id = $dados['id'];
    }
  }

  ?>


  <!DOCTYPE html>
  <html lang="pt-br">

  <head>
    <title>Cadastro de Reservas</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="estilo.css">
  </head>

  <body>
    <?php include_once("direction.php"); ?>
    
    <div width=60% align=center>

      <form class="Pousada" method="post" action="reservas.php" align=left>

        <h1>Bem vindo ao Sistema da Pousada Serras de Minas</h1>

        <input type="hidden" name="id" value="<?= $id; ?>">

        <div class="field">
          <label for="id_quarto">Número do Quarto:</label>
          <select name="id_quarto" id="id_quarto">
            <?php
            $sql = "select id, NumeroNaPorta, ValorDiaria, status from quartos ";
            $resultado = mysqli_query($conexao, $sql);
            while ($dados = mysqli_fetch_array($resultado)) {
              if ($dados['status'] == 'livre' || $dados['status'] == 'Livre') {
                $NumeroNaPorta = $dados['NumeroNaPorta'];
                echo "<option value=" . $dados['id'] . ">" . $NumeroNaPorta . "</option>";
            ?>

            <?php
              }
            }
            ?>
          </select>
        </div>

        <div class="field">
          <label for="id_cliente">Nome do Cliente:</label>
          <select name="id_cliente" id="id_cliente">
            <?php
            $sql = "select id, nomeCliente from clientes ";
            $resultado = mysqli_query($conexao, $sql);
            while ($dados = mysqli_fetch_array($resultado)) {
              $nomeCliente = $dados['nomeCliente'];
              echo "<option value=" . $dados['id'] . ">" . $nomeCliente . "</option>";
            }
            ?>
          </select>
        </div>

        <div class="field">
          <label for="data_entrada">Data de Entrada:</label>
          <input type="date" id="data_entrada" name="data_entrada" value="<?= $data_entrada; ?>" placeholder="Digite a data de entrada*" required>
        </div>

        <div class="field">
          <label for="data_saida">Data de Saída:</label>
          <input type="date" id="data_saida" name="data_saida" value="<?= $data_saida; ?>" placeholder="Digite a data de saida*" required>
        </div>
        
        <div class="field">
          <label for="status_reserva">Status da Reserva:</label>
          <input type="text" id="status_reserva" name="status_reserva" value="<?= $status_reserva; ?>" placeholder="Digite status da reserva*" required>
        </div>

        <input type="submit" name="reservas" value="Enviar">
      </form>
    </div>
  </body>

  </html>
