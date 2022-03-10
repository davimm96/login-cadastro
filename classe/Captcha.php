<?php
namespace Davi;

class Captcha {
    private $secret = '6LcznqEeAAAAAIDLAbN-TnThpwbqIND268DKTb3g';

    public function captchaExecute(){
        if (isset($_POST['g-recaptcha-response'])) {
            $url = 'https://www.google.com/recaptcha/api/siteverify';
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HEADER, false);
            
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        
            $data = array(
                'secret' => $this->secret,
                'response' => $_POST["g-recaptcha-response"]
            );
        
            $data = http_build_query($data) . "\n";
        
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        
            $data = curl_exec($curl);
            //echo curl_error($curl);
            curl_close($curl);
            $response = json_decode($data);
        
            /*echo "<pre>";
            print_r($response);
            echo "</pre>";*/
            
            if((int)$response->success === 1 && (float)$response->score >= 0.7) {
                return true;
                //proceed with form values
            } else {
                echo 'Erro';
                return false;
            }
        } else {
            echo 'Erro';
            return false;
        }    
    }
}
