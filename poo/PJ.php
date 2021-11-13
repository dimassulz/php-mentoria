<?php
require "Usuario.php";
class PJ extends Usuario {
    const MESSAGE = "Usuário PJ - MESSAGE"; //SEMPRE UTILIZAR LETRA MAIUSCULA
    protected $_cnpj;

    public function __construct(string $nome, string $login, string $senha, string $email, string  $cnpj ){
        $this->_nome = $nome;
        $this->_login = $login;
        $this->_senha = $senha;
        $this->_email = $email;
        $this->_cnpj = $cnpj;    
    }

    public function logarComCnpj() : String{
        return "ESTOU NA CLASSE PJ e o cnpj é {$this->_cnpj} mostrando o: ".self::MESSAGE;
    }
        
}
// http://localhost:8081/poo/PJ.php
echo "<h1>TRABALHANDO COM HERANÇA - ".PJ::MESSAGE." </h1>";

$user = new PJ("petrobras", "tes  tepetrobras", md5("123456"), "petrobras@gmail.com", "1081066700180");
echo $user->logarComCnpj();
echo "<br>";
echo $user->consultar();
echo "<br>";
echo $user->inserir();
echo "<br>";
echo $user->atualizar();
echo "<br>";
echo "<br>";

$user = new PJ("mcdonalds", "testemcdonalds", md5("654987"), "testemcdonalds@gmail.com", "1081066700180");
echo $user->logarComCnpj();
echo "<br>";
echo $user->consultar();
echo "<br>";
echo $user->inserir();
echo "<br>";
echo $user->atualizar();
echo "<br>";
