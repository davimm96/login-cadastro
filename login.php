<?php
namespace Davi;
require __DIR__."/vendor/autoload.php";
//Captura menssagem de sucesso
$msgSucesso = $_SESSION["msgSucesso"];

//Destroi session
//session_destroy();
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="davimm96">
    <meta name="robots" content="index, follow, noarchive">
    <meta name="description" content="Faça login para entrar no sistema">
    <link rel="stylesheet" href="css/acesso.css">
    <link rel="stylesheet" href="css/aguarde.css">
    <script src="js/verSenha.js"></script>
    <script src="js/aguarde.js"></script>
    <script src="js/tecla.js"></script>
    <script src="https://accounts.google.com/gsi/client" async defer></script>
    <title>Login</title>
</head>
<body>
<main>
    <article class="pai">
        <header class="formularioAcesso">
            <h1>Entrar</h1>
            <div id="btnLG">
                <div id="g_id_onload"
                    data-client_id=<?=CLIENTID?>
                    data-login_uri=<?=LOGINURI?>
                    data-auto_prompt="false">
                </div>
                <div class="g_id_signin"
                    data-type="standard"
                    data-size="small"
                    data-theme="outline"
                    data-text="sign_in_with"
                    data-shape="rectangular"
                    data-logo_alignment="center">
                </div>
            </div>
            <form method="post" id="userForm" action="loginExecuta.php">
                <input type="email" name="email" placeholder="E-mail" autofocus required><br>
                <input type="password" name="senha" id="senha" placeholder="Senha" class="senha" required>
                <div name="verSenha" id="verSenha" class="verSenha">👁️</div><br>
                <button class="g-recaptcha" data-sitekey="6LcznqEeAAAAAAnWTr6yRbLTLr14fzR66X3mC1fF"
                    data-callback='onSubmit' data-action='submit' id="ok">Iniciar</button>
            </form>
            <section class="opcoesAcesso">
                <p><cite>Não tem uma conta? <button><a href="cadastro.php" 
                    title="Página para cadastrar-se no sistema">Cadastrar</a></button></cite></p>
                <p><cite>Esqueceu a senha? <button><a href="renomear-senha/rs1.php" 
                    title="Página para recuperar senha">Recurepar senha</a></button></cite></p>
            </section>
        </header>
        <!-- Menssagem de erro -->
        <footer>
            <section class="erroAcesso">
                <?php echo $msgSucesso;?>
            </section>
            <section id="aguarde">
                <div id="aniEspe">
                    <label>Aguarde</label>
                    <label id="b1">.</label>
                    <label id="b2">.</label>
                    <label id="b3">.</label>
                    <label id="b4">.</label>
                    <label id="b5">.</label>
                </div>
            </section>
        </footer>

    </article>
<main>
<script src="https://www.google.com/recaptcha/api.js?render=6LcznqEeAAAAAAnWTr6yRbLTLr14fzR66X3mC1fF"></script>
<script>
//Mostra a senha digitada
verSenha()

//Ajax
function onSubmit() {
    document.querySelector("#aguarde").style.display = 'flex'
    document.querySelector(".erroAcesso").style.display = 'none' 
    grecaptcha.ready(function () {
        grecaptcha.execute('6LcznqEeAAAAAAnWTr6yRbLTLr14fzR66X3mC1fF', { action: 'login' }).then(function (token) {
            let form = document.getElementById('userForm')
            console.log("teste")
            axios.post('loginExecuta.php', new FormData(form))//Documento chamado
                .then(res => {
                    document.querySelector("#aguarde").style.display = 'none'
                    document.querySelector(".erroAcesso").style.display = 'block' 
                    document.querySelector(".erroAcesso").innerHTML = res.data
                    console.log(res.data)
                    if(res.data == '')//Sucesso
                        window.location.href = "index.php"
                }).catch(err => {
                    console.log("erro")
                })
        })
    })
}
</script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</body>
</html>