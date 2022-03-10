<?php
//Verifica se o usuario passou pela segunda etapa
if($_SESSION["sessaoTrocarSenha"] != session_id()){
    header("Location: ../login.php");
    exit();
}      
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="davimm96">
    <meta name="description" content="Página para recuperar senha">
    <meta name="robots" content="noindex, nofollow, noarchive">
    <link rel="stylesheet" href="../css/acesso.css">
    <script src="../js/verSenha.js"></script>
    <link rel="stylesheet" href="../css/aguarde.css">
    <script src="../js/aguarde.js"></script>
    <script src='../js/tecla.js'></script>
    <title>Mudar senha</title>
</head>
<body>
<main>
    <article class="pai">
        <header class="formularioAcesso">
            <form method="post" id="userForm" action="muda-senha.php">
                <p>Digite a sua nova senha</p> 
                <input type="password" name="novaSenha" id="senha" placeholder="Senha" class="senha"
                    required otofocus>
                <div name="verSenha" id="verSenha" class="verSenha">👁️</div><br>
                <button class="g-recaptcha" data-sitekey="6LcznqEeAAAAAAnWTr6yRbLTLr14fzR66X3mC1fF"
                    data-callback='onSubmit' data-action='submit' name="enviar" id='ok'>Enviar</button> 
            </form>
        </header>
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
verSenha()
document.addEventListener('keypress', function(e){
    if(e.key == 'Enter')
        document.querySelector('#ok').click()
})

function onSubmit() {
    document.querySelector("#aguarde").style.display = 'flex'
    document.querySelector(".erroAcesso").style.display = 'none'
    grecaptcha.ready(function () {
        grecaptcha.execute('6LcznqEeAAAAAAnWTr6yRbLTLr14fzR66X3mC1fF', { action: 'mudaSenha' }).then(function (token) {
        let form = document.getElementById('userForm')
        axios.post('muda-senha.php', new FormData(form))
            .then(res => {
                document.querySelector("#aguarde").style.display = 'none'
                document.querySelector(".erroAcesso").style.display = 'block'
                document.querySelector(".erroAcesso").innerHTML = res.data
                if(res.data == '')
                    window.location.href = "../login.php"
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

