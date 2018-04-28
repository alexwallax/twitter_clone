<?php
    
    session_start();

    //verificar se essa variavel USU_USUARIO "NÂO" existe se nao exisir encamionha par o index
    if (!isset($_SESSION['USU_USUARIO'])) {
    header('Location: index.php?erro=1');
    }

    require_once('db.class.php');    
    
    $id_usuario = $_SESSION['id_usuario'];
    
    $objDb = new db();
    $link = $objDb->conecta_mysql();

    $sql = " SELECT * FROM tweet ORDER BY data_inclusao DESC "; 

    echo $sql;
    
    //mysqli_query($link, $sql);
    
?>

