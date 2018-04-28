<?php

session_start();

require_once('db.class.php');

$usuario = $_POST['usuario'];
md5($senha = $_POST['senha']);
//podemos recuperar apenas usuario e email poe ex - select usu_usuario, usu_email from ...
$sql = "SELECT USU_ID, USU_USUARIO, USU_EMAIL FROM TB_USUARIOS WHERE USU_USUARIO = '$usuario' AND USU_SENHA = '$senha' ";

$objDb = new db(); //instacia da classe 
$link = $objDb->conecta_mysql(); // execução do mysql
//executando a consulta ao banco de dados(retorna false caso algum erro na consulta)
$resultado_id = mysqli_query($link, $sql);

if ($resultado_id) {
    //mysql_fecth_array - recupera em formato de array o retorno da pesquisa do banco de dados
    $dados_usuario = mysqli_fetch_array($resultado_id);

    if (isset($dados_usuario['USU_USUARIO'])) {
        
        $_SESSION['id_usuario'] = $dados_usuario['USU_ID'];
        $_SESSION['USU_USUARIO'] = $dados_usuario['USU_USUARIO'];
        $_SESSION['USU_EMAIL'] = $dados_usuario['USU_EMAIL'];
        
        header('Location: home.php');
        
    } else {
        header('location: index.php?erro=1');
    }
} else { //este else é para testar se a configuração esta correta e não verifica se o usuario ou senha esta correto ou existe 
    echo "Erro na execução da consulta, entrar em contato com o admin do site";
}



//update - true/false
//insert - true/false
//select - false(caso exista algum problema)/(não havendo erro ->)resource(referencia para uma informação externa do php(objetos ou array por exemplo))
//delete - true/false
?>
