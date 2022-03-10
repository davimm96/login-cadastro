<?php
    namespace Davi;
    use PHPMailer;

    class EnviaEmail {
        private $email;
        private $title;
        private $text;

        function setEmail($email){
            $this->email = $email;
        }

        function setTitle($title){
            $this->title = $title;
        }

        function setText($text){
            $this->text = $text;
        }

        function getEmail(){
            return $this->email;
        }

        function getTitle(){
            return $this->title;
        }

        function getText(){
            return $this->text;
        }


        function envia(){
            //Create a new PHPMailer instance
            $mail = new PHPMailer();

            //Tell PHPMailer to use SMTP
            $mail->isSMTP();

            //Enable SMTP debugging
            //SMTP::DEBUG_OFF = off (for production use)
            //SMTP::DEBUG_CLIENT = client messages
            //SMTP::DEBUG_SERVER = client and server messages
            $mail->SMTPDebug = 0;

            //Set the hostname of the mail server
            $mail->Host = 'smtp.gmail.com';
            //Use `$mail->Host = gethostbyname('smtp.gmail.com');`
            //if your network does not support SMTP over IPv6,
            //though this may cause issues with TLS

            //Set the SMTP port number:
            // - 465 for SMTP with implicit TLS, a.k.a. RFC8314 SMTPS or
            // - 587 for SMTP+STARTTLS
            $mail->Port = 587;

            //Set the encryption mechanism to use:
            // - SMTPS (implicit TLS on port 465) or
            // - STARTTLS (explicit TLS on port 587)
            $mail->SMTPSecure = 'tls';

            //Whether to use SMTP authentication
            $mail->SMTPAuth = true;

            //Nome de usuário a ser usado para autenticação SMTP - use o endereço de e-mail completo para gmail
            $mail->Username = 'davimichaelsenm@gmail.com';

            //Password to use for SMTP authentication
            $mail->Password = SENHAEMAIL;

            //Defina de quem a mensagem deve ser enviada
            //Observe que com o gmail você só pode usar o endereço da sua conta (o mesmo que `Nome de usuário`)
            //ou aliases predefinidos que você configurou em sua conta.
            //Não use endereços enviados pelo usuário aqui
            $mail->setFrom(EMAIL, NOMEEMAIL);

            //Set an alternative reply-to address
            //This is a good place to put user-submitted addresses
            //$mail->addReplyTo('replyto@example.com', 'First Last');

            //Defina para quem a mensagem deve ser enviada
            $mail->addAddress($this->getEmail(), 'Suporte, Sistema de login e cadastro');

            //Set the subject line
            $mail->Subject = $this->getTitle();

            //Read an HTML message body from an external file, convert referenced images to embedded,
            //convert HTML into a basic plain-text alternative body
            //$mail->msgHTML(file_get_contents('contents.html'), __DIR__);
            $mail->msgHTML($this->getText());

            //Replace the plain text body with one created manually
            $mail->AltBody = 'This is a plain-text message body';

            //Attach an image file
            //$mail->addAttachment('images/phpmailer_mini.png');

            $mail->send();
            //send the message, check for errors
           // if (!$mail->send()) {
            //    echo 'Mailer Error: ' . $mail->ErrorInfo;
           // } else {
            //    echo 'Message sent!';
                //Section 2: IMAP
                //Uncomment these to save your message in the 'Sent Mail' folder.
                #if (save_mail($mail)) {
                #    echo "Message saved!";
                #}
           // } 
        }
    } 

?>