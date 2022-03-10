<?php
    use Davi\Captcha;
    use Davi\Usuario;
    use Davi\Valida;

    require __DIR__."/../vendor/autoload.php";

    $executa = new Usuario();
    $valida = new Valida();
    
    
    session_start();
    //Reseta menssagem de sucesso
    $_SESSION["msgSucesso"] = "";
    //Se o usiario voltar para a página, destroi a sessão dele
    session_destroy();
    session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="davimm96">
    <meta name="description" content="Página para recuperar senha">
    <meta name="robots" content="index, follow, noarchive">
    <link rel="stylesheet" href="../css/acesso.css">
    <link rel="stylesheet" href="../css/aguarde.css">
    <script src="../js/aguarde.js"></script>
    <script src="../js/tecla.js"></script>
    <title>Mudar senha</title>
</head>
<body>
<main>
    <article class="pai">
        <header class="formularioAcesso">
            <p>Dígite o e-mail da sua conta, para receber o código de recuperação de senha</p>
            <form method="post" id="userForm" action="verifica-email.php">
                <input type="email" name="email" required focus><br>
                <button class="g-recaptcha" data-sitekey="6LcznqEeAAAAAAnWTr6yRbLTLr14fzR66X3mC1fF"
                data-callback='onSubmit' data-action='submit' name="enviar" id="ok">Enviar</button> 
            </form>
            <section class="opcoesAcesso">
                <cite><p>Já tem uma conta? <button><a href="../login.php">
                    Logar</a></button><p></cite>
                <cite><p>Não tem uma conta? <button><a href="../cadastro.php">
                    Cadastrar</a></button></p></cite>
            </section>
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
//Mostra a senha digitada
verSenha()

//Ajax
function onSubmit() {
    document.querySelector("#aguarde").style.display = 'flex'
    document.querySelector(".erroAcesso").style.display = 'none' 
    grecaptcha.ready(function () {
        grecaptcha.execute('6LcznqEeAAAAAAnWTr6yRbLTLr14fzR66X3mC1fF', { action: 'verificaEmail' }).then(function (token) {
        // Add your logic to submit to your backend server here.
        let form = document.getElementById('userForm')
        axios.post('verifica-email.php', new FormData(form))
            .then(res => {
                document.querySelector("#aguarde").style.display = 'none'
                document.querySelector(".erroAcesso").style.display = 'block' 
                document.querySelector(".erroAcesso").innerHTML = res.data
                if(res.data == '')
                    window.location.href = "rs2.php"
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
