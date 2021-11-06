<?php   

require 'conecta.php';

function tratarCamposFormulario($campo)
{
    $campo = trim($campo); //limpa os caracteres em branco antes e depois do texto
    $campo = stripslashes($campo); //limpa as contra barras e barras evita um problema de invasao
    $campo = htmlspecialchars($campo); //limpa caracter especial html
    return $campo;
}

function verificarEmailJaCadastrado($conn, $email)
{
    $statement = $conn->prepare('SELECT email FROM cadastro WHERE email = :email');
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->execute();
    if ($statement->fetch(PDO::FETCH_ASSOC)) {
        throw new Exception('E-mail já cadastrado, tente outro e-mail!');
    }
}

function verificaPost(){
    if($_SERVER["REQUEST_METHOD"] !== "POST"){
        throw new Exception('Só aceito requisição via post!');
    }
}

function inserirDados($conn, $nome, $email, $senha)
{
    $statement = $conn->prepare('INSERT INTO cadastro (nome, email, senha) VALUES (:nome, :email, :senha)');
    $statement->bindParam(':nome', $nome, PDO::PARAM_STR);
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->bindParam(':senha', password_hash($senha, PASSWORD_BCRYPT), PDO::PARAM_STR);
    $statement->execute();
}

function registrarDadosUsuario($conn){
    try {
        verificaPost();
        $nome = tratarCamposFormulario($_POST['nome']);
        $email = tratarCamposFormulario($_POST['email']);
        $senha = tratarCamposFormulario($_POST['senha']);
        //verificacao do email cadastrado
        verificarEmailJaCadastrado($conn, $email);
        //SALVAR EM UM BASE DE DADOS
        //$conn esta no conecta.php
        inserirDados($conn, $nome, $email, $senha);
        return "<h1>{$nome} seu cadastro foi concluído com sucesso, verifique o seu e-mail {$email}</h1>";
    } catch (Exception $e) {
        return "<h1>Erro! {$e->getMessage()}</h1>";
    }
}

//START DO CODIGO
$resposta = registrarDadosUsuario($conn);

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