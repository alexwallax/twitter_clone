<?php



require_once('db.class.php');


//podemos recuperar apenas usuario e email poe ex - select usu_usuario, usu_email from ...
$sql = "SELECT * FROM TB_USUARIOS";

$objDb = new db(); //instacia da classe 
$link = $objDb->conecta_mysql(); // execução do mysql
//executando a consulta ao banco de dados(retorna false caso algum erro na consulta)
$resultado_id = mysqli_query($link, $sql);

if ($resultado_id) {
    //mysql_fecth_array - recupera em formato de array o retorno da pesquisa do banco de dados
    $dados_usuario = array();
    
    while($linha = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC)) {
        $dados_usuario[] = $linha;
    }

    // MTSQLI_NUM busca no BD indices apenas de numeros (id = 1 ,2, 3, etc)
    // MYSQLI_ASSOC busca no BD indices vias asosiaçoes (nome, email, senha, etc)
    //  MYSQLI_BOTH busca os dois
    foreach ($dados_usuario as $usuario) {
            
        echo $usuario['USU_USUARIO'];  
        
    //var_dump($usuario); // se quiser recuperar somente o email = var_damp($usuario['email']);
        echo '<br /><br />';
    }
   
} else { //este else é para testar se a configuração esta correta e não verifica se o usuario ou senha esta correto ou existe 
    echo "Erro na execução da consulta, entrar em contato com o admin do site";
}


?>

