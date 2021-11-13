<?php 
require "Usuario.php";

class PF extends Usuario {

    protected $_cpf;

    /**
     * Reescrita do construtor original new PF($nome,$login,$senha,$email,$cpf)
     */
    public function __construct(string $nome, string $login, string $senha, string $email, string  $cpf ){
            $this->_nome = $nome;
            $this->_login = $login;
            $this->_senha = $senha;
            $this->_email = $email;
            $this->_cpf = $cpf;    
        }

    /**
     * Criacao de novo método exclusivo da classe PF
     */
    public function logarComCpf() : String{
        return "ESTOU NA CLASSE PF e o cpf é {$this->_cpf}";
    }
        
}

echo "<h1>TRABALHANDO COM HERANÇA - USUARIO PF </h1>";

$user = new PF("Rogerio Feliz", "testerogerio", md5("123456"), "testerogerio@gmail.com", "32165498710");
echo $user->logarComCpf();
echo "<br>";
echo $user->consultar();
echo "<br>";
echo $user->inserir();
echo "<br>";
echo $user->atualizar();
echo "<br>";
echo "<br>";

$user = new PF("Teste Feliz", "testeteste", md5("654987"), "testeteste@gmail.com", "99965498710");
echo $user->logarComCpf();
echo "<br>";
echo $user->consultar();
echo "<br>";
echo $user->inserir();
echo "<br>";
echo $user->atualizar();
echo "<br>";

?>