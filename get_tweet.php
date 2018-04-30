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

    $sql = " SELECT DATE_FORMAT(t.data_inclusao, '%d %b %Y %T') AS data_inclusao_formatada, t.tweet, u.USU_USUARIO ";
    $sql.= " FROM tweet AS t JOIN TB_USUARIOS AS u ON (t.id_usuario = u.USU_ID) ";
    $sql.= " WHERE id_usuario = $id_usuario ";
    $sql.= " OR id_usuario IN (select seguindo_id_usuario from usuarios_seguidores where id_usuario = $id_usuario) ";
    $sql.= " ORDER BY data_inclusao DESC "; 

    
    $resultado_id = mysqli_query($link, $sql);
    
    if($resultado_id) {
        
        while($registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC)) {
            
            echo '<a href="#" class="list-group-item">';
            echo '<h4 class="list-group-item-heading">'.$registro['USU_USUARIO'].' <small> - '.$registro['data_inclusao_formatada'].'</small></h4>';
            echo '<p class="list-group-item-text">'.$registro['tweet'].'</p>';
            echo '</a>';
            
        }
        
    } else {
        echo 'Erro na consulta de tweets no banco de dados!';
    }
    
?>

