<?php

require_once('db.class.php');

$usuario =  $_POST['usuario'];
$senha = $_POST['senha'];


$sql = "SELECT * FROM TB_USUARIOS WHERE USU_USUARIO = '$usuario' AND USU_SENHA = '$senha' ";

$objDb = new db(); //instacia da classe 
$link = $objDb->conecta_mysql(); // execução do mysql

//executando a consulta ao banco de dados(retorna false caso algum erro na consulta)
$resultado_id = mysqli_query($link, $sql);

if($resultado_id) {
$dados_usuario = mysqli_fetch_array($resultado_id);

var_dump($dados_usuario);   
} else { //este else é para testar se a configuração esta correta e não verifica se o usuario ou senha esta correto ou existe 
    echo "Erro na execução da consulta, entrar em contato com o admin do site";
}



//update - true/false
//insert - true/false
//select - false(caso exista algum problema)/(não havendo erro ->)resource(referencia para uma informação externa do php(objetos ou array por exemplo))
//delete - true/false

?>
