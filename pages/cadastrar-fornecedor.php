<?php
    session_start();
    // print_r($_SESSION);
    if(!isset($_SESSION) OR $_SESSION['logado'] != true):
		header("location: ../config/sair.php");		
	else:
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../fontawesome/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/popup-not.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>Cadastro de Fornecedor</title>
    <style>
        .campos-forncedor{
            position: relative;
            top: 150px;
        }
    </style>
</head>
<body>
<?php include '../includes/header-funci.php'; ?>

        <form action="../config/processa-cadastro-fornecedor.php" method="POST">
            <div class="campos-forncedor">
                <div class="input-container">
                    <label for="nome_fantasia">Nome da empresa</label>
                    <input type="text" name="nome_fantasia" id="nome_fantasia" class="input">
                </div>
                <div class="input-container">
                    <label for="razao_social">Razão social</label>
                    <input type="text" name="razao_social" id="razao_social" class="input">
                </div>
                <div class="input-container">
                    <label for="ie">IE</label>
                    <input type="text" name="ie" id="ie" class="input">
                </div>
                <div class="input-container">
                    <label for="cnpj">CNPJ</label>
                    <input type="text" name="cnpj" id="cnpj" class="input">
                </div>
                <button type="submit">Enviar</button>
            </div>
        </form>

</body>
</html>
<?php endif; ?>