<?php

    require_once('PHPMailer/src/PHPMailer.php');
    require_once('PHPMailer/src/SMTP.php');
    require_once('PHPMailer/src/Exception.php');

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    $mail = new PHPMailer(TRUE);
    try{
        $mail->CharSet = 'UTF-8';
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'presencaescolar2021@gmail.com';
        $mail->Password = '2021@Presencaescolar';
        $mail->Port = 587;

        $mail->setFrom('presencaescolar2021@gmail.com');
        $mail->addAddress($destinatario);

        $mail->isHTML(true);

        //$enviarDadosResponsavel TRUE envia para responsável e FALSE envia para Aluno

        if($enviarDadosResponsavel){
            $mail->Subject = 'Acesso ao apliactivo como responsável';
            $mail->Body = '
            <div style="font-size: 1.2em; font-family: Arial, Helvetica, sans-serif;">
                <h2 style="text-align: center;">Olá, ' . $nome .'.</h2>
                <p>A sua inscrição na escola foi feita com sucesso.</p>
                <p>Utilize o aplicativo para ter acesso à presença e horário de seu dependente.</p>
                    
                <div style="margin-top: 50px;">
                    <p><b>Email:</b> ' . $email .'</p>
                    <p><b>Senha:</b> ' . $senhaEnviar .'</p>
                </div>
            </div>
            ';

        }else{
            $mail->Subject = 'Acesso ao apliactivo como aluno';
            $mail->Body = '
            <div style="font-size: 1.2em; font-family: Arial, Helvetica, sans-serif;">
                <h2 style="text-align: center;">Olá, ' .  $nomeResponsavel  .'.</h2>
                <p>A inscrição do(a) <b>'. $nome .'</b> foi feita com sucesso.</p>
                <p>Utilize o aplicativo para ter acesso à presença e horário de seu dependente.</p>
                    
                <div style="margin-top: 50px;">
                    <p><b>Matricula:</b> '. $matricula .'</p>
                    <p><b>Senha:</b> '. $senhaEnviar .'</p>
                </div>
            </div>
            
            ';
        }
        
    
        if(!$mail->send()) {
            $resposta = 7;
        } 


    }catch(Exception $ex){
        echo "Erro ao enviar email: {$mail->ErrorInfo}";
    }



?>