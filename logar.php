<?php   

require 'conecta.php';

function tratarCamposFormulario($campo)
{
    return htmlspecialchars(stripslashes(trim($campo)));
}

//VE

//verificar se veio pelo metodo POST e tratar os campos recebidos
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {
        //RECEBENDO OS DOIS CAMPOS DA TELA
        $email = tratarCamposFormulario($_POST['email']); //EMAIL
        $senha = tratarCamposFormulario($_POST['senha']); //SENHA

        //CONSULTANDO OS DADOS A BASE DE DADOS COM EMAIL APENAS
        //$conn esta no conecta.php
        $statement = $conn->prepare('SELECT email, senha FROM cadastro WHERE email = :email');
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $exec = $statement->execute();
        $arrDadoUsuario = $statement->fetch(PDO::FETCH_ASSOC); // RESULTADO DO BANCO DE DADOS
        
        if(!$arrDadoUsuario){ //VERIFICA SE OS DADOS DE EMAIL ESTA INCORRETO
            $resposta = "<h1>Usuário ou senha incorretos!</h1> - EMAIL";
        }else if(!password_verify($senha, $arrDadoUsuario['senha'])){ //VERIFICA SE A SENHA INFORMADA ESTA INCORRETA
            $resposta = "<h1>Usuário ou senha incorretos!</h1> - SENHA";
        } else{
            $resposta = "<h1>Usuário logado com sucesso!</h1>"; // LOGADO COM SUCESSO
        }
    }catch(Exception $e){
        $resposta = "<h1>Erro! TIPO DE ERRO {$e->getMessage()}</h1>";
    }

} else {
    $resposta = "<h1>Erro! so aceito requisição via post!</h1>";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resposta Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="alert alert-success" role="alert">
            <h2><?php echo $resposta; ?></h2>
        </div>
    </div>
</body>

</html>