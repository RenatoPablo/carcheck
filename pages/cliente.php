<?php
session_start();
if(!isset($_SESSION) OR $_SESSION['logado'] != true):
    header("location: ../config/sair.php");		
else:
    $permissao = $_SESSION['permissaoUsuario'];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styleCadastro.css">
    <link href="../fontawesome/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/cadastrar-cliente.css">
    <link rel="stylesheet" href="../css/popup-not.css">
    <link rel="stylesheet" href="../css/popup-cadastro.css">
    <link rel="stylesheet" href="../css/padraoformularios.css">

    <!-- uso temporario -->
    <link rel="stylesheet" href="../css/forma-pagamento.css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Cadastro Cliente</title>
</head>
<body>

<?php include '../includes/header-funci.php'; ?>

<!-- Container dos dois formulários -->


<div class="container mt-4">
    <h2 class="text-center">Gerenciamento de Itens</h2>

    <!-- Botão para abrir o modal -->
    <button id="btnAbrirModalCadastro" class="btn-cadastrar">Cadastrar Novo Item</button>

    <!-- Campo de busca -->
    <div class="search-bar mb-3">
        <input type="text" id="inputBusca" placeholder="Buscar item..." class="form-control">
        <span class="icon-search"><i class="fa fa-search"></i></span>
    </div>

    <!-- Modal para cadastro de item -->
    <div id="modalCadastro" class="modal-forma-pagamento">
        <div class="modal-content-forma">
            <span class="modal-close">&times;</span>
            <h2>Cadastrar Novo Item</h2>
            
            
            <!-- -- area para adicionar formulario cadastro -->
            <div class="container-formularios" style="display: flex; justify-content: center; gap: 50px;">
            <!-- Formulário de Dados Pessoais -->
            <form action="../config/crud-cliente/create.php" method="POST" enctype="multipart/form-data">
                <div class="form-card">
                    <h2>Dados Pessoais</h2>

                    <!-- Upload de foto -->
                    <div class="input-container" style="grid-column: span 2;">
                        <label for="foto" class="custom-file-upload">SELECIONE UMA FOTO</label>
                        <input type="file" id="foto" name="foto" accept="image/*" onchange="previewImage(event)">
                        <div class="image-preview" id="imagePreview">
                            <span>Imagem Pendente</span>
                        </div>
                    </div>

                    <!-- Seleção de Pessoa Física ou Jurídica -->
                    <div class="input-container" style="grid-column: span 2;">
                        <label class="radio-button">
                            <input type="radio" name="tipo_pessoa" value="fisica" onclick="showFields('fisica')">
                            <span class="radio"></span> Pessoa Física
                        </label>
                        <label class="radio-button">
                            <input type="radio" name="tipo_pessoa" value="juridica" onclick="showFields('juridica')">
                            <span class="radio"></span> Pessoa Jurídica
                        </label>
                    </div>

                    <!-- Campos de Dados Pessoais organizados em duas colunas -->
                    <div class="dados-pessoais">
                        <div class="input-container">
                            <label for="nome">Nome Completo:</label>
                            <input id="nome" name="nome" placeholder="Digite seu Nome" type="text" class="input">
                        </div>
                        <div class="input-container">
                            <label for="genero">Gênero:</label>
                            <select id="genero" name="genero" class="escolha-genero" aria-label="selecione">
                                <option selected="">Selecione..</option>
                                <option value="1">Masculino</option>
                                <option value="2">Feminino</option>
                                <option value="3">Outro</option>
                            </select>
                        </div>
                        <div class="input-container">
                            <label for="telefone">Telefone:</label>
                            <input id="telefone" name="telefone" maxlength="15" placeholder="(00) 00000-0000" oninput="mascaraTelefone(this)" type="text" class="input">
                        </div>
                        <div class="input-container">
                            <label for="email">Email:</label>
                            <input id="email" name="email" placeholder="Digite seu email" type="email" class="input">
                        </div>
                        <div class="input-container">
                            <label for="datadenascimento">Data de Nascimento:</label>
                            <input id="datadenascimento" name="datadenascimento" placeholder="Digite sua Data de Nascimento" type="date" class="input">
                        </div>
                        <div class="input-container">
                            <label for="senha">Senha:</label>
                            <input id="senha" name="senha" placeholder="Insira uma Senha" type="password" class="input">
                        </div>
                        <div class="input-container">
                            <label for="confirmarsenha">Confirmar Senha:</label>
                            <input id="confirmarsenha" name="confirmarsenha" placeholder="Confirme sua senha" type="password" class="input">
                        </div>

                        <!-- Campos adicionais para Pessoa Física e Jurídica -->
                        <div id="campos-dinamicos" class="especifico">
                            <!-- Inicialmente ocultos e controlados por JavaScript -->
                        </div>

                        <script>
                            // <!-- Função para mostrar os campos específicos de Pessoa Física ou Jurídica -->
                            function showFields(tipo) {
                                const camposDinamicos = document.getElementById('campos-dinamicos');
                                camposDinamicos.innerHTML = ''; // Limpa os campos dinâmicos
                            
                                if (tipo === 'fisica') {
                                    camposDinamicos.innerHTML = `
                                        <div class="input-container">
                                            <label for="cpf">CPF:</label>
                                            <input id="cpf" name="cpf" maxlength="14" placeholder="000.000.000-00" oninput="mascaraCPF(this)" type="text" class="input">
                                        </div>
                                        <div class="input-container">
                                            <label for="rg">RG:</label>
                                            <input id="rg" name="rg" maxlength="13" placeholder="00.000.000-00" oninput="mascaraRG(this)" type="text" class="input">
                                        </div>
                                    `;
                                } else if (tipo === 'juridica') {
                                    camposDinamicos.innerHTML = `
                                        <div class="input-container">
                                            <label for="cnpj">CNPJ:</label>
                                            <input id="cnpj" name="cnpj" maxlength="18" placeholder="00.000.000/0000-00" oninput="mascaraCNPJ(this)" type="text" class="input">
                                        </div>
                                        <div class="input-container">
                                            <label for="razao-social">Razão Social:</label>
                                            <input id="razao-social" name="razao-social" placeholder="Digite sua Razão Social" type="text" class="input">
                                        </div>
                                        <div class="input-container">
                                            <label for="nome-fantasia">Nome Fantasia:</label>
                                            <input id="nome-fantasia" name="nome-fantasia" placeholder="Digite seu Nome Fantasia" type="text" class="input">
                                        </div>
                                    `;
                                }
                            
                                // Aplicar o estilo grid
                                camposDinamicos.style.display = 'grid';
                                camposDinamicos.style.gridTemplateColumns = '1fr 1fr'; // Duas colunas
                                camposDinamicos.style.gap = '20px'; // Espaço entre os campos
                            }
                        </script>
                    </div> <!-- Fechamento da div .dados-pessoais -->

                    
                </div>
            
                                                        
            
                <div class="form-card">
                    <h2>Endereço</h2>
                    <div class="endereco">
                        <div class="input-container">
                            <label for="cep">CEP:</label>
                            <input id="cep" name="cep" placeholder="Digite seu CEP" type="text" class="input" onblur="buscarCep()">
                        </div>
                        <div class="input-container">
                            <label for="estado">Estado:</label>
                            <input id="estado" name="estado" placeholder="Estado" class="input">
                        </div>
                        <div class="input-container">
                            <label for="cidade">Cidade:</label>
                            <input id="cidade" name="cidade" placeholder="Cidade" class="input">
                        </div>
                        <div class="input-container">
                            <label for="rua">Rua:</label>
                            <input id="rua" name="rua" placeholder="Digite sua Rua" type="text" class="input">
                        </div>
                        <div class="input-container">
                            <label for="numero">Numero:</label>
                            <input id="numero" name="numero" placeholder="Digite seu Numero" type="text" class="input">
                        </div>
                        <div class="input-container">
                            <label for="bairro">Bairro:</label>
                            <input id="bairro" name="bairro" placeholder="Digite seu Bairro" type="text" class="input">
                        </div>
                        <div class="input-container">
                            <label for="complemento">Complemento:</label>
                            <input id="complemento" name="complemento" placeholder="Digite seu Complemento" type="text" class="input">
                        </div>
                        <div class="input-container">
                            <label for="ponto_ref">Ponto de Referência:</label>
                            <input id="ponto_ref" name="ponto_ref" placeholder="Digite seu Ponto de Referência" type="text" class="input">
                        </div>
                    </div>
                    <button class="botao-submit" type="submit">ENVIAR</button>
                </div>
            </form>
        </div>


        </div>
    </div>

    


    <!-- Lista de itens -->
    <div class="mt-4">
        <h2 class="text-center">Lista de Itens</h2>
        <table class="table-list">
            <thead>
                <tr>
                    <th>Nome do Item</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody id="gridResultadoBusca">
                <!-- Os resultados da grid aparecerão aqui -->
            </tbody>
        </table>
    </div>
</div>

<!-- Modal para Update e Delete -->
<div class="modal fade" id="modalAcao" tabindex="-1" aria-labelledby="modalTituloAcao" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content"> <!-- Estrutura correta do modal Bootstrap -->
            <div class="modal-header">
                <h5 class="modal-title" id="modalTituloAcao">Ação</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="mensagemModalAcao"></p>
                
                -- area para formulario de cadastro

                    
                    -- area para formulario de delete
            </div>
        </div>
    </div>
</div>

<?php include '../includes/popup-padrao.php'; ?>

<script>

    function carregarItens() {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', '../config/forma-pagamento/read.php', true); // Corrigir o caminho conforme necessário
    xhr.onload = function () {
        if (xhr.status === 200) {
            try {
                const resultados = JSON.parse(xhr.responseText);
                atualizarGrid(resultados); // Exibe todos os resultados na grid
            } catch (error) {
                console.error("Erro ao processar os dados:", error);
            }
        } else {
            console.error("Erro na requisição: " + xhr.status);
        }
    };
    xhr.send();
}




// Exibir popup com base nas variáveis passadas do PHP
<?php if (isset($_GET['sucesso_fisica']) && $_GET['sucesso_fisica'] == 'true'): ?>
    Swal.fire({
        icon: 'success',
        title: 'Sucesso!',
        text: 'Cadastro de pessoa física realizado com sucesso!',
        confirmButtonText: 'OK'
    });
<?php elseif (isset($_GET['sucesso_juridica']) && $_GET['sucesso_juridica'] == 'true'): ?>
    Swal.fire({
        icon: 'success',
        title: 'Sucesso!',
        text: 'Cadastro de pessoa jurídica realizado com sucesso!',
        confirmButtonText: 'OK'
    });
<?php elseif (isset($_GET['senha_incorreta']) && $_GET['senha_incorreta'] == 'true'): ?>
    Swal.fire({
        icon: 'error',
        title: 'Erro!',
        text: 'As senhas não coincidem. Tente novamente.',
        confirmButtonText: 'OK'
    });
<?php elseif (isset($_GET['verificar_campos']) && $_GET['verificar_campos'] == 'true'): ?>
    Swal.fire({
        icon: 'warning',
        title: 'Atenção!',
        text: 'Preencha todos os campos obrigatórios.',
        confirmButtonText: 'OK'
    });
<?php endif; ?>
</script>

<script src="../js/grid-crud.js"></script>
<script src="../js/buscarCep.js"></script>
<script src="../js/pop-cadastro.js"></script>
<script src="../js/valida-fisica-juridi.js"></script>
<script src="../js/mascaras.js"></script>

<script src="../js/foto.js" ></script>
<script src="../js/botao-voltar.js"></script>

</body>
</html>
<?php endif; ?>
