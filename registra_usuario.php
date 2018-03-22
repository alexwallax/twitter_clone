<?php

require_once('db.class.php');

//Variaveis que vão armazenar os dados digitados pelos usuarios
$usuario = $_POST['usuario'];
$email = $_POST['email'];
$senha = $_POST['senha'];

$objDb = new db();
$link = $objDb->conecta_mysql();

//Variavel que vai t=receber a query de insert
$sql = " insert into TB_USUARIOS(USU_USUARIO, USU_EMAIL, USU_SENHA) values('$usuario', '$email', '$senha') ";

//Executar a query - primeiro parametro é a conexão e o segundo é o SQL(query)
if(mysqli_query($link, $sql)) {
    echo "Usuário registrado co sucesso";   
} else {
    echo "Erro ao registrar o usuário";
}


?>
