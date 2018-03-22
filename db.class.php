<?php

class db {
  
    //host - endereço onde o MySQL esta instalado - No caso o proprio pc
    private $host = 'localhost';
    
    //usuario - usuarrio de conexão com o MySQL - pode criar usuarios para bd especifico ou co acesso especifico 
    private $usuario = 'root';
    
    //senha
    private $senha = '';
    
    //banco de dados - banco de dados onde serão criados as tabelas
    private $database = 'TB_TWITTER_CLONE';
    
    public function conecta_mysql() {
        //criar a conexão
        $con = mysqli_connect($this->host, $this->usuario, $this->senha, $this->database);
        
        //ajustar o charset de comunicação entre a aplicação e o banco de dados
        mysqli_set_charset($con, 'utf8');
        
        //verificar se houve erro de conexão
        if(mysqli_connect_errno()) {
            echo "Erro ao tentar se conectar com o BD MySQL: " . mysqli_connect_error();
        }
        return $con;
    }
    
}

?>
