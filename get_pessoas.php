<?php
    //iniciar a sessão
    session_start();

    //verificar se essa variavel USU_USUARIO "NÂO" existe se nao exisir encamionha par o index
    if (!isset($_SESSION['USU_USUARIO'])) {
    header('Location: index.php?erro=1');
    }
    //recuperar a classe de conexão com o banco de dados
    require_once('db.class.php'); 
    
    $nome_pessoa = $_POST['nome_pessoa'];
    $id_usuario = $_SESSION['id_usuario'];
    //instancia da classe de conexão
    $objDb = new db();
    $link = $objDb->conecta_mysql();

    $sql = " SELECT * FROM TB_USUARIOS WHERE USU_USUARIO like '%$nome_pessoa%' AND USU_ID <> $id_usuario "; 
     
    $resultado_id = mysqli_query($link, $sql);
    
    if($resultado_id) {
        
        while($registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC)) {
            
            echo '<a href="#" class="list-group-item">';
                echo '<strong>'.$registro['USU_USUARIO'].'</strong> <small> - '.$registro['USU_EMAIL'].' </small>';
                echo '<p class="list-group-item-text pull-right">';
                    echo '<button type="button" class="btn btn-default btn_seguir" data-id_usuario="'.$registro['USU_ID'].'">Seguir</button>';
                    echo '<button type="button" class="btn btn-primary btn_deixar_seguir" data-id_usuario="'.$registro['USU_ID'].'">Deixar de Seguir</button>';                   
                echo '</p>';
                echo '<div class="clearfix"></div>';
            echo '</a>';
            
        }
        
    } else {
        echo 'Erro na consulta de usuários no banco de dados!';
    }
    
?>

