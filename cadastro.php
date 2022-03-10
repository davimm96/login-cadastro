<?php
//axios <progress>

//Destroi a session
session_start();
session_destroy();
session_start();  
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" contet="davimm96">
    <meta name="description" content="Página de cadastro do sistema">
    <meta name="robots" content="index, follow, noarchive">
    <link rel="stylesheet" href="css/acesso.css">
    <link rel="stylesheet" href="css/aguarde.css">
    <script src="js/aguarde.js"></script>
    <script src="js/verSenha.js"></script>
    <script src="js/tecla.js"></script>
    <title>Cadastro</title>
</head>
<body>
<main>
    <article class="pai">
        <header class="formularioAcesso">
            <h1>Cadastro</h1>
            <form method="post" id="userForm" action="executarCadastro.php">
                <input type="text" name="nome" id="nome" placeholder="Nome" autofocus required><br>
                <input type="email" name="email" placeholder="E-mail" required><br>
                <input type="password" name="senha" id="senha" placeholder="Senha" class="senha" required>
                <div name="verSenha" id="verSenha" class="verSenha">👁️</div><br>
                <button class="g-recaptcha" data-sitekey="6LcznqEeAAAAAAnWTr6yRbLTLr14fzR66X3mC1fF"
                    data-callback='onSubmit' data-action='submit' id='ok'>Enviar</button>
            </form>
            <section class="opcoesAcesso">
                <cite>Já tem uma conta? <button><a href="login.php" title="Página para entrar no sistema">
                    Logar</a></button><cite>
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
</main>
<script src="https://www.google.com/recaptcha/api.js?render=6LcznqEeAAAAAAnWTr6yRbLTLr14fzR66X3mC1fF"></script>
<script>
//Mostra senha
verSenha()

//Ajax
function onSubmit() {
    document.querySelector("#aguarde").style.display = 'flex'
    document.querySelector(".erroAcesso").style.display = 'none' 
    grecaptcha.ready(function () {//chave
        grecaptcha.execute('6LcznqEeAAAAAAnWTr6yRbLTLr14fzR66X3mC1fF', { action: 'cadastro' }).then(function (token) {
            let form = document.getElementById('userForm')
            axios.post('executarCadastro.php', new FormData(form))//Documento chamado
                .then(res => {
                    document.querySelector("#aguarde").style.display = 'none'
                    document.querySelector(".erroAcesso").style.display = 'block' 
                    document.querySelector(".erroAcesso").innerHTML = res.data
                    if(res.data == '')//sucesso
                        window.location.href = "login.php"
                }).catch(err => {
                    console.log("erro")
                })
        });
    });
}
</script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</body>
</html>


        


