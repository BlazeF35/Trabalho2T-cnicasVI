<?php

	require_once('conexao.php');
	
	$id = '';
	$NumeroNaPorta = '';
	$TipoDoQuarto = '';
	$ValorDiaria = '';
	
	if(isset($_GET['id']) && $_GET['id'] != ""){
		$sql = "select * from pousada where id = ".$_GET['id'];
		$resultado = mysqli_query($conexao, $sql);
		if($resultado){
			$dados = mysqli_fetch_array($resultado);
			$id = $dados['id'];
			$NumeroNaPorta = $dados['NúmeroNaPorta'];
			$TipoDoQuarto = $dados['TipoDoQuarto'];
			$ValorDiaria = $dados['ValorDiaria'];
		}
	}

?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Pousada Serra Sul</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="stilo.css">
</head>

<body>
    <?php include_once("direction.php"); ?>

    <div width=60% align=center>

    <form class="Pousada" method="post" action="clientes.php" align=center>

        <h1>Bem vindo ao cadastro de quartos</h1>
		
		<input type="hidden" id="id" value="<?php echo $id; ?>">
        
        <div class="field">
            <label for="id">Identificação do quarto</label>
            <input type="text" id="id" name="id" value="<?php echo $id; ?>" placeholder="*Por favor digite a ID*" required>
        </div>
        
        <div class="field">
            <label for="NumeroNaPorta">Número do quarto</label>
            <input type="text" id="NumeroNaPorta" name="NumeroNaPorta" value="<?php echo $NumeroNaPorta; ?>" placeholder="*Digite o número do quarto*">
        </div>

        <div class="field radiobox">
            <span>Tipo de quarto</span>
            <input type="radio" name="TipoDoQuarto" id="solteiro" value="solteiro" <?php if($TipoDoQuarto=='solteiro'){echo 'checked';} ?> ><label for="sim">Solteiro</label>
            <input type="radio" name="TipoDoQuarto" id="casal" value="casal" <?php if($TipoDoQuarto=='casal'){echo 'checked';} ?> ><label for="casal">Casal</label>
        </div>
 
        <div class="field">
            <label for="ValorDiaria">Valor da diária</label>
            <input type="text" id="ValorDiaria" name="ValorDiaria" value="<?php echo $ValorDiaria; ?>" placeholder="*Digite o valor da diária*" required>
        </div>        
 
        <input type="submit" name="Clientes" value="Enviar">

    </form>

</div>
</body>
</html>