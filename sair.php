<?php

    session_start();
    
    //unset - elimina indices - USU_USUARIO e USU_EMAIL
    unset($_SESSION['USU_USUARIO']);
    unset($_SESSION['USU_EMAIL']);
    
    header('Location: index.php');

?>

