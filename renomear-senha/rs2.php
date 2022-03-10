<?php
    use Davi\EnviaEmail;
    use Davi\Captcha;

    require_once __DIR__."/../vendor/autoload.php";
    
    session_start();

    //Verifica se o usuario passou pela primeira etapa
    if($_SESSION["sessaoTrocarSenha"] != session_id())
        header("Location: ../login.php");
    else {
        // Envia e-mail 
       if($_SESSION["emailEnviado"] != true){
            $_SESSION["numVerificacao"] = md5(rand(1,1000));
            
            $menssagem = "
                Copie e cole esse código para realizar a troca de senha: ".$_SESSION["numVerificacao"];

            $email = new EnviaEmail();
            $email->setEmail($_SESSION["email"]);
            $email->setTitle("Troca de senha");
            $email->setText($menssagem);
            $email->envia();
        
            $_SESSION["emailEnviado"] = true;
        }
    }

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="davimm96">
    <meta name="description" content="Página para recuperar senha">
    <meta name="robots" content="noindex, nofolow, noarchive">
    <link rel="stylesheet" href="../css/acesso.css">
    <link rel="stylesheet" href="../css/aguarde.css">
    <script src="../js/aguarde.js"></script>
    <script src='../js/tecla.js'></script>
    <title>Mudar senha</title>
</head>
<body>
<main>
    <article class="pai">
        <header class="formularioAcesso">
            <form method="post" id="userForm" action="verifica-codigo.php">
                <p>Digite o código que enviamos para o seu E-mail</p> 
                <input type="text" name="codigo" required focus><br>
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
<main>
<script src="https://www.google.com/recaptcha/api.js?render=6LcznqEeAAAAAAnWTr6yRbLTLr14fzR66X3mC1fF"></script>
<script>
document.addEventListerner('keypress', function(e){
    if(e.key == 'Enter')
        document.querySelector('#ok').click()
})  

function onSubmit() {
    document.querySelector("#aguarde").style.display = 'flex'
    document.querySelector(".erroAcesso").style.display = 'none'
    grecaptcha.ready(function () {
        grecaptcha.execute('6LcznqEeAAAAAAnWTr6yRbLTLr14fzR66X3mC1fF', { action: 'verificaCodigo' }).then(function (token) {
        // Add your logic to submit to your backend server here.
        let form = document.getElementById('userForm')
        axios.post('verifica-codigo.php', new FormData(form))
            .then(res => {
                document.querySelector("#aguarde").style.display = 'none'
                document.querySelector(".erroAcesso").style.display = 'block'
                document.querySelector(".erroAcesso").innerHTML = res.data
                if(res.data == '')
                    window.location.href = "rs3.php"
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

