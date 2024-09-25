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
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../css/home-cliente.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/card-itens.css">
    <title>CarCheck</title>
    <link href="../fontawesome/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/popup-not.css">
</head>
<body>
    
    <header>

        <!-- Sidebar -->
        <div class="sidebar">
            <a href="../pages/home-cliente.php">Home</a>
            <a href="../pages/cadastrar-funci.php">Cadastrar Funcionário</a>
            <a href="#clients">Clients</a>
            <a href="../config/sair.php">Sair</a>
        </div>

        <div class="container-header">
            
            <img src="../image/logo-carcheck.png" alt="Logo CarCheck" title="CarCheck">
            <h1>CarCheck</h1>
            
            
        </div>

        <div class="icons">
            <!-- Botão para mostrar a notificação -->
            <button onclick="showNotification()" class="icons-not">
            <i class="fa-solid fa-bell fa-2xl" style="color: #ffffff;"></i></button>

            <!-- Popup de notificação -->
            <div id="notification" class="notification">
                <span id="notification-text">Este é um alerta de notificação!</span>
                <span class="close-btn" onclick="closeNotification()">&times;</span>
            </div>

            <!-- <a href="pages/notificacao.html"><i class="fa-solid fa-bell fa-2xl" style="color: #ffffff;"></i></a> -->

            <a href="pages/home.html"><i class="fa-solid fa-house-chimney fa-2xl casa" style="color: #ffffff;"></i></a>
            <a href="perfil.php"><i class="fa-solid fa-user fa-2xl" style="color: #ffffff;"></i></a>
        </div>
        <input type="checkbox" id="checkbox" onclick="toggleSidebar()">
        <label for="checkbox" class="toggle">
            <div class="bar bar--top"></div>
            <div class="bar bar--middle"></div>
            <div class="bar bar--bottom"></div>
        </label>
        
        
    </header>

        <!--div que contem os itens do acesso rapido-->
        <div class="container-acesso-rapido"> 
            <h2 class="textoh2">ACESSO RÁPIDO</h2>
            <div class="container-acesso">
                
                <a href="">
                    <div class="card">
                        <img src="../image/carro.png" alt="Veículos" class="img-card-especifica">
                        <p class="heading">Veículos</p>
                    </div>
                </a>
                <a href="">
                    <div class="card">
                        <img src="../image/iconeServiços.png" alt="Serviços" class="img-card-acesso">
                        <p class="heading">Serviços</p>
                    </div>
                </a>

                <a href="">
                    <div class="card">
                        <img src="../image/iconeAgendamento.png" alt="Agendamento" class="img-card-acesso">
                        <p class="heading">Agendamento</p>
                    </div>
                </a>

                <a href="">
                    <div class="card">
                        <img src="../image/iconeAssociados.png" alt="Associados" class="img-card-acesso">
                        <p class="heading">Associados</p>
                    </div>
                </a>

                
            </div>
        </div>
    
    <script src="../js/script.js"></script>
    <script src="../js/popup-not.js"></script>
</body>
</html>
<?php endif; ?>