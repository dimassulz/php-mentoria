<?php 
class Usuario {
    protected $_nome;
    protected $_login;
    protected $_senha;
    protected $_email;

    public function __construct(string $nome, string $login, string $senha,  string $email) {
        $this->_nome = $nome;
        $this->_login = $login;
        $this->_senha = $senha;
        $this->_email = $email;
    }

    public function logar(){
        return "ESTOU USANDO O METODO LOGAR e o usuario é {$this->_login} e a senha é {$this->_senha} e o e-mail é {$this->_email}";
    }

    public function inserir(){
        return "ESTOU USANDO O METODO INSERIR do(a) {$this->_nome}";
    }

    public function atualizar(){
        return "ESTOU USANDO O METODO ATUALIZAR do(a) {$this->_nome}";
    }

    public function consultar(){
        return "ESTOU USANDO O METODO CONSULTAR do(a) {$this->_nome}";
    }
        
}


?>