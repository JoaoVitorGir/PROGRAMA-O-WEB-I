<?php
    include "lib/dbconn.php";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .desc {
            text-decoration: none;
            color: black;
            pointer-events: none;
        }
        .descItens{
          text-decoration: none;
          color: black;
        }
        .descItens:hover{
            text-decoration: none;
            color: black;
        }

        .col-10 {
          padding-right: 0;
          padding-left: 0;
        }
        .col-2 {
          padding-right: 0;
          padding-left: 0;
        }

        .h5-card{
          display: -webkit-box;
          height: 30px;
          overflow: hidden;
          text-overflow: ellipsis;
          white-space: normal;
          -webkit-box-orient: vertical;
          -webkit-line-clamp: 1;
          padding-top: 4px;
          color: #000000;
          text-align: center;
        }

        .p_Descricao {
          display: -webkit-box;
          height: 70px;
          /* width: 220px; */
          overflow: hidden;
          text-overflow: ellipsis;
          white-space: normal;
          -webkit-box-orient: vertical;
          -webkit-line-clamp: 3;
          text-align: center;
          margin-inline: auto;
        }
        .hr {
          margin: 10px 0;
        }
        .p_Valor_Produto{
          font-weight: 900;
          text-align: center;
          font-size: 17px;
        }
        .menu {
          color: #6b1a88;
          font-weight: 700;
        }
    </style>

</head>
<body > 
    <div class="container-fluid" >

    <nav class="navbar navbar-expand-lg navbar-light" style="border: solid 1px; border-radius: 5px;  margin: 0px 10px 25px 0px">
  <div class="container" >
    <a class="navbar-brand" style="color: #6b1a88;font-weight: 700;" href="index.php">E-Commerce</a>
    <button style="border-color: #6b1a88;" class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#" style="color: #6b1a88;">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#" style="color: #6b1a88;">Link</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: #6b1a88;">Produtos</a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" style="color: #6b1a88;" href="#">Categorias</a></li>
            <li><a class="dropdown-item" style="color: #6b1a88;" href="#">Compras</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" style="color: #6b1a88;" href="#">Carinho</a></li>
          </ul>
        </li>
        
      </ul>
      <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Pesquisar" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Pesquisar</button>
      </form>
    </div>
  </div>
</nav>
      </div>
      <div class="container p-3 mb-5" style="min-height: 80vh;" >
        <div class="row" >
            
        </div>
        <div class="row" >
          
        
            <!-- Lista de produtos Incio -->
            <div class="col-lg-2 col-sm-12" style="border: 1px; border-style: solid; border-radius: 15px;"> <!-- style="margin-left: 90px;" -->
              <!-- lista Inicio -->
              
                <ul class="list-group list-group">
                    <?php
                        $sql = "SELECT * FROM meu_commerce.categorias WHERE categoria_pai is null";
                        $consulta = $conn->prepare($sql);
                        $consulta->execute();
                       //for que vai listar as categorias principais 
                        foreach($consulta as $linha){
                    ?>

                          

                                <li class="list-group-item d-flex justify-content-between " style="border: thin;">
                                <!-- LISTA ITENS -->
                                <div class="accordion accordion-flush" id="ac">
                                  <div class="accordion-item">
                                    <div id="flush-heading">
                                                                                                             <!-- ref está apenas para concatenar e nao dar erro por ser so numero -->
                                      <div  style="text-align: start;" data-bs-toggle="collapse" data-bs-target="#ref<?php echo $linha['id'];?>" aria-expanded="false" aria-controls="flush-collapse">
                                      <a href="#" class="descItens" style="color: #6b1a88;"><strong><?php echo $linha['descricao'];?></strong> </a>
                        </div>
                        </div>
                                    
                                 
                              <!-- LISTA -->
                              
                                    <div>
                                      
                                      <?php

                                      //listar as sub-categorias
                                      $sql_itens = "SELECT * FROM meu_commerce.categorias WHERE categoria_pai = ".$linha['id'];
                                      $subitens = $conn->prepare($sql_itens);
                                      $subitens->execute();
                                      foreach($subitens as $item){
                                     ?>
                                                  <!-- aqui passa os sub produtos da categoria principal -->
                                                  <div id="ref<?php echo $linha['id'];?>" class="accordion-collapse collapse" aria-labelledby="flush-heading" data-bs-parent="#ac">
                                                    <div class="accordion-body" style="text-align: left; padding: inherit;">
                                                    <i class="fa fa-check" style="color: brown;"></i> <a style="color:black ; text-decoration:none; font-size: 15px;" 
                                                        onMouseOver="this.style.color='#87cefa'" onMouseOut="this.style.color='#111'"
                                                        href="?categoria=<?php echo $item['id'];?>"><?php echo $item['descricao'];?>
                                                      </a><br>
                                                    </div>
                                                  </div>
                                               
                                              <?php
                                              }
                          }
                    ?>   
                                    </div>
                                    </div>
                                </div>
                        </li>
              
                </ul>

                
              <!-- lista Final -->
                          
            </div> <!-- final lista de produtos -->
            <!-- Inicio lista de Imgens -->
            <div class="col-9" style="border-radius: 12px; margin-left: 10px;">
              <div class="row">
                <?php
                    if(isset($_GET['categoria'])){
                        $sql = "SELECT p.id as id_produto, 
                                       p.categoria_id, 
                                       p.imagem, 
                                       p.descricao, 
                                       p.resumo, 
                                       p.valor,
                                       c.categoria_pai, 
                                       c.id as id_categoria
                                  FROM produtos p
                            INNER JOIN categorias c
                                    ON p.categoria_id = c.categoria_pai OR p.categoria_id = c.id
                                 WHERE p.categoria_id = {$_GET['categoria']} OR c.categoria_pai = {$_GET['categoria']}
                              ORDER BY RAND()";
                    }
                    else {
                        $sql = "SELECT p.id as id_produto, 
                                       p.categoria_id, 
                                       p.imagem, 
                                       p.descricao, 
                                       p.resumo, 
                                       p.valor
                                  FROM produtos p 
                              ORDER BY RAND()";
                    }
                    $consulta = $conn->prepare($sql);
                    $consulta->execute();
                   
                    foreach($consulta as $linha){?>
                      
                      <div class="card col-lg-3 col-md-6 col-sm-12 p-2" style="margin-top: 10px; border: none;">
                          <!-- Imagem Item -->
                          <div class="text-center" style="height: 172px; display: flex;">
                            <img class="img-fluid" src="<?php echo $linha['imagem'];?>" alt="...">
                          </div>
                          <hr class="hr">
                          <div class="card-body" style="padding-top: 0px; padding-bottom: 0px;">
                            <div >
                              <!-- Nome do produto -->
                              <a style="text-align: center;" class="desc" href="descricao.php"></a>
                              <h5 class="h5-card"><?php echo $linha['descricao'];?></h5>
                              
                              <!-- Descrição -->
                              <div>
                                <p class= "p_Descricao"><?php echo $linha['resumo']?></p>
                                <!-- Valor-->
                              
                                <p class="p_Valor_Produto">R$<?php echo $linha['valor']?></p>
                              
                              </div>
                              
                            </div>

                          </div>
                          <a class="btn btn-primary" href="#" role="button" style="display: flex;margin: inherit;justify-content: center;">Ver mais</a>
                      </div>
                      
                    <?php
                    }
                ?>
              </div>  <!-- Final da lista de imagens -->
              </div>

            
        </div>
    </div>  
    
    
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
<footer>
<div class="container-fluid" style="padding:0px">
      <nav class="navbar navbar-expand-lg navbar-light bg-light" style="border-top: ridge;">
        <div class="container" >
          <a class="navbar-brand" href="#">E-Commerce</a>
          <a class="navbar-brand" style = "font-size: inherit;" href="#">E-MAIL E-Commerce@gmail.com</a>
          <a class="navbar-brand" style = "font-size: inherit;" href="#">whatsapp (47) 12345-1234</a>
        </div>
    </div>
</footer>
</html>

