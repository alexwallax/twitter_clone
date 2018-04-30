<?php

    session_start();

    //verificar se essa variavel USU_USUARIO "NÂO" existe se nao exisir encamionha par o index
    if (!isset($_SESSION['USU_USUARIO'])) {
    header('Location: index.php?erro=1');
    }
    
    
    //recuperar a classe de conexão com o banco de dados
    require_once('db.class.php'); 
    
    //instancia da classe de conexão
    $objDb = new db();
    $link = $objDb->conecta_mysql();

    $id_usuario = $_SESSION['id_usuario'];    
    
    
    // quantidade de tweets
    $sql = " SELECT COUNT(*) AS qtde_tweets FROM tweet WHERE id_usuario = $id_usuario ";

    //execução da query
    $resultado_id = mysqli_query($link, $sql);
    
    $qtde_tweets = 0;
    
    // o if vai testar para verificar se ha de fato um recurso... 
    // externo(se a execução da queru=y foi feita com sucesso)
    if($resultado_id) {
        $registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC);
        
        $qtde_tweets = $registro['qtde_tweets'];
        
    } else {
        echo "Erro na execução da query";
    }

    
    
    
    // quantidade de seguidores
    $sql = " SELECT COUNT(*) AS qtde_seguidores FROM usuarios_seguidores WHERE seguindo_id_usuario = $id_usuario ";

    //execução da query
    $resultado_id = mysqli_query($link, $sql);
    
    $qtde_seguidores = 0;
    
    // o if vai testar para verificar se ha de fato um recurso... 
    // externo(se a execução da queru=y foi feita com sucesso)
    if($resultado_id) {
        $registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC);
        
        $qtde_seguidores = $registro['qtde_seguidores'];
        
    } else {
        echo "Erro na execução da query";
    }
    
?>

<!DOCTYPE HTML>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">

        <title>Twitter clone</title>

        <!-- jquery - link cdn -->
<!--	<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>  -->
        <script src="js/jquery.js"></script> 
        <!-- bootstrap - link cdn -->
        <!--	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">  -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <script type="text/javascript">// código javascript
            		
            $(document).ready( function(){
                
                //associar o evento de clic ao botão
                $('#btn_procurar_pessoa').click( function(){
                    
                    if($('#nome_pessoa').val().length > 0) {
                    
                        $.ajax({
                            url: 'get_pessoas.php',
                            method: 'post',
                            data: $('#form_procurar_pessoas').serialize(),
                            success: function (data) {
                                $('#pessoas').html(data);
                                
                                $('.btn_seguir').click( function(){
                                    var id_usuario = $(this).data('id_usuario');
                                    
                                        $('#btn_seguir_'+id_usuario).hide();
                                        $('#btn_deixar_seguir_'+id_usuario).show();
                                        
                                        $.ajax({
                                        url: 'seguir.php',
                                        method: 'post',
                                        data: { seguir_id_usuario: id_usuario },
                                        success: function(data) {
                                            alert('Registro efetuado com sucesso!');
                                        }
                                    });
                                    
                                });
                                
                                $('.btn_deixar_seguir').click( function(){
                                    var id_usuario = $(this).data('id_usuario');
                                        
                                        $('#btn_seguir_'+id_usuario).show();
                                        $('#btn_deixar_seguir_'+id_usuario).hide();
                                        
                                    $.ajax({
                                        url: 'deixar_seguir.php',
                                        method: 'post',
                                        data: { deixar_seguir_id_usuario: id_usuario },
                                        success: function(data) {
                                            alert('Registro removido com sucesso!');
                                        }
                                    });                                    
                                    
                                });
                                
                            }
                        });
                    }
                  
                }); 
                
            }); 
            
        </script>
    </head>

    <body>

        <!-- Static navbar -->
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <img src="imagens/icone_twitter.png" />
                </div>

                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="home.php">Home</a></li>
                        <li><a href="sair.php">Sair</a></li>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </nav>


        <div class="container">



            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h4> <?= $_SESSION['USU_USUARIO'] ?> </h4>   
                        
                        <hr /> 
                        <div class="col-md-6">
                            TWEETS <br /> <?= $qtde_tweets?>
                        </div>
                        <div class="col-md-6">
                            SEGUIDORES <br /> <?= $qtde_seguidores?>
                        </div>
                    </div> 
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form id="form_procurar_pessoas" class="input-group">
                            <input type="text" id="nome_pessoa" name="nome_pessoa" class="form-control" placeholder="Quem você esta procurando?" maxlength="140" />
                            <span class="input-group-btn">
                                <button class="btn btn-default" id="btn_procurar_pessoa" type="button">Procurar</button>
                            </span>
                        </form>
                    </div>
                </div>
                
                <div id="pessoas" class="list-group"></div>
                
            </div>
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-body">
                        
                    </div>
                </div>
            </div>
        </div>




<!--	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> -->
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>



