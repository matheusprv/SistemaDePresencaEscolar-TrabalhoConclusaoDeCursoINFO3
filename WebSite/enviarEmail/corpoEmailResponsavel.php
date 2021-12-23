<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acesso responsável</title>

    <style>
        body{
            margin: 45px 0 0 40px; 
            font-size: 1.2em;
            font-family: Arial, Helvetica, sans-serif;
        }
    </style>

</head>
<body>

    <div style="margin: 0 auto; width: 750px; font-size: 1.2em; font-family: Arial, Helvetica, sans-serif;">
        <h2 style="text-align: center;">Olá, <?php $nomeResponsavel ?>.</h2>
        <p>A sua inscrição na escola foi feita com sucesso.</p>
        <p>Utilize o aplicativo para ter acesso à presença e horário de seu dependente.</p>
            
        <div style="margin-top: 50px;">
            <p><b>Email:</b> <?php $email ?></p>
            <p><b>Senha:</b> <?php $senha ?></p>
        </div>
    </div>

    
    
</body>
</html>