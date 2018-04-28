<?php

require_once('db.class.php');

//Variaveis que vão armazenar os dados digitados pelos usuarios
$usuario = $_POST['usuario'];
$email = $_POST['email'];
$senha = md5($_POST['senha']);

$objDb = new db();
$link = $objDb->conecta_mysql();

$usuario_existe = false;
$email_existe = false;

//verificar se o usuário já existe
$sql = " SELECT * FROM TB_USUARIOS WHERE USU_USUARIO = '$usuario'";
if($resultado_id = mysqli_query($link, $sql)){
    
    $dados_usuario = mysqli_fetch_array($resultado_id);
    
    if(isset($dados_usuario['USU_USUARIO'])) {
        $usuario_existe = true;
    } 
    
} else {
    echo "Erro ao tentar localizar o registro de usuário";
}
        
        

//verificar se o email já existe
$sql = " SELECT * FROM TB_USUARIOS WHERE USU_EMAIL = '$email'";
if($resultado_id = mysqli_query($link, $sql)){
    
    $dados_usuario = mysqli_fetch_array($resultado_id);
    
    if(isset($dados_usuario['USU_EMAIL'])) {
        $email_existe = true;
    } 
    
} else {
    echo "Erro ao tentar localizar o registro de email";
}
        

if ($usuario_existe || $email_existe) {
    
    $retorno_get = '';
    
    if($usuario_existe) {
        $retorno_get.="erro_usuario=1&";
    }
    
    if($email_existe) {
        $retorno_get.="erro_email=1&";
    }
    
    header('Location: inscrevase.php?'.$retorno_get);
    // die() - interrompe o processamento do script nesse ponto - tudo que estiver abaixo do die() e desconsiderado
    die();
}

//Variavel que vai t=receber a query de insert
$sql = " insert into TB_USUARIOS(USU_USUARIO, USU_EMAIL, USU_SENHA) values('$usuario', '$email', '$senha') ";

//Executar a query - primeiro parametro é a conexão e o segundo é o SQL(query)
if (mysqli_query($link, $sql)) {
    echo "Usuário registrado co sucesso";
} else {
    echo "Erro ao registrar o usuário";
}
?>
