<?php

  require_once('conexao.php');

  $nomeCliente = '';
  $documento = '';
  $DataNascimento = '';
  $cidade = '';
  $estado = '';
  $id = '';

  if (isset($_GET['id']) && $_GET['id'] != "") {
    $sql = "select * from pousada where id = " . $_GET['id'];
    $resultado = mysqli_query($conexao, $sql);
    if ($resultado) {
      $dados = mysqli_fetch_array($resultado);
      $nomeCliente = $dados['nomeCliente'];
      $documento = $dados['documento'];
      $DataNascimento = $dados['DataNascimento'];
      $cidade = $dados['cidade'];
      $estado = $dados['estado'];
      $id = $dados['id'];
    }
  }

  ?>


  <!DOCTYPE html>
  <html lang="pt-br">

  <head>
    <title>Cadastro clientes Serrras Sul</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="estilo.css">
  </head>

  <body>
    <?php include_once("direction.php"); ?>

    <div width=50% align=center>
      <form class="Pousada" method="post" action="clientes.php" align=left>
        
        <h1>Bem vindo ao cadastro de Clientes</h1>

        <input type="hidden" name="id" value="<?php echo $id; ?>">

        <div class="field">
          <label for="nomeCliente">Nome do Cliente:</label>
          <input type="text" id="nomeCliente" name="nomeCliente" value="<?php echo $nomeCliente; ?>" placeholder="Nome do Cliente*" required>
        </div>

        <div class="field">
          <label for="documento">Documento:</label>
          <input type="text" id="documento" name="documento" value="<?php echo $documento; ?>" placeholder="Digite o numero do documento*">
        </div>

        <div class="field">
          <label for="DataNascimento">Data de Nascimento:</label>
          <input type="date" id="DataNascimento" name="DataNascimento" value="<?php echo $DataNascimento; ?>" placeholder="Data de nascimento*" required>
        </div>
        <div class="field">
          <label for="cidade">Cidade:</label>
          <input type="text" id="cidade" name="cidade" value="<?php echo $cidade; ?>" placeholder="Cidade*">
        </div>
        <div class="field">
          <label for="estado">Estado:</label>
          <input type="text" id="estado" name="estado" value="<?php echo $estado; ?>" placeholder="Estado*">
        </div>

        <input type="submit" name="clientes" value="Enviar">

      </form>
    </div>
  </body>

  </html>
