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

    <style>
        .desc {
            text-decoration: none;
            color: black;
            pointer-events: none;
        }
        
        /* *, ::after,::before {
           box-sizing: content-box; 
        } */

        .col-10 {
          padding-right: 0;
          padding-left: 0;
        }
        .col-2 {
          padding-right: 0;
          padding-left: 0;
        }
        .p_Descricao {
          /* max-width: 25ch; */
          max-height: 5ch;
          overflow: hidden;
          text-overflow: ellipsis;
          /* white-space: nowrap; */
        }
    </style>

</head>
<body>
    <div class="container-fluid" >
    <nav class="navbar navbar-expand-lg navbar-light bg-light" style="border: solid 1px; border-radius: 5px;  margin: 0px 10px 25px 0px">
  <div class="container" >
    <a class="navbar-brand" href="#">E-Commerce</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Produtos</a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="#">Categorias</a></li>
            <li><a class="dropdown-item" href="#">Compras</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Carinho</a></li>
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
      <div class="container" >
        <div class="row" >
            
        </div>
        <div class="row" >
          
        
            <!-- Lista de produtos Incio -->
            <div class="col-2" > <!-- style="margin-left: 90px;" -->
              <!-- lista Inicio -->
              
                <ul class="list-group list-group">
                    <?php
                        $sql = "SELECT * FROM meu_commerce.categorias WHERE categoria_pai is null";
                        $consulta = $conn->prepare($sql);
                        $consulta->execute();
                       //for que vai listar as categorias principais 
                        foreach($consulta as $linha){
                    ?>


                                <li class="list-group-item d-flex justify-content-between " style="border-bottom: none;">
                                    <div>
                                      <div class="fw-bold">
                                        <a style="color:black; text-decoration:none; font-size: 18px;" href="?categoria=<?php echo $linha['id'];?>">

                                          <!-- aqui passa o valor da categoria principal " AQUI " -->
                                          <div class="item-menu">
                                            <?php echo $linha['descricao'];?>
                                          </div>
                                        </a>
                                      </div>
                                      <?php

                                      //listar as sub-categorias
                                      $sql_itens = "SELECT * FROM meu_commerce.categorias WHERE categoria_pai = ".$linha['id'];
                                      $subitens = $conn->prepare($sql_itens);
                                      $subitens->execute();
                                      foreach($subitens as $item){
                                     ?>
                                                  <!-- aqui passa os sub produtos da categoria principal " AQUI "-->
                                               <a style="color:black ; text-decoration:none; font-size: 15px;" 
                                               onMouseOver="this.style.color='#87cefa'" onMouseOut="this.style.color='#111'"
                                               href="?categoria=<?php echo $item['id'];?>"><?php echo $item['descricao'];?></a><br>
                                              <?php
                                              }
                          }
                    ?>   
                                    </div>
                        </li>
              
                </ul>

                
              <!-- lista Final -->
                          
            </div> <!-- final lista de produtos -->
            <!-- Inicio lista de Imgens -->
            <div class="col-10" >
              <div style="text-align: justify; padding: 0px 30px 10px 30px;">
                <?php
                    if(isset($_GET['categoria'])){
                        $sql = "SELECT p.id as id_produto, 
                                       p.categoria_id, 
                                       p.imagem, 
                                       p.descricao, 
                                       p.resumo, 
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
                                       p.resumo 
                                  FROM produtos p 
                              ORDER BY RAND()";
                    }
                    $consulta = $conn->prepare($sql);
                    $consulta->execute();
                   
                    foreach($consulta as $linha){?>

                    <div class="card" style="display: inline-flex; margin: 0px 13px 13px 13px; border-radius: 12px">
                        <!-- Imagem Item -->
                        <div style="align-self: center;">
                          <img style="width: 17rem;  border-radius: 12px; margin-top: 15px;" src="<?php echo $linha['imagem'];?>" alt="...">
                        </div>
                        <div class="card-body">
                          <div style="width: 17rem;">
                            <!-- Nome do produto -->
                            <a style="text-align: center;" class="desc" href="descricao.php">
                              <h5 class="card-title"><?php echo $linha['descricao'];?></h5>
                            </a>
                            <!-- Descrição -->
                            <div>
                              <p class= "p_Descricao"><?php echo $linha['resumo']?></p>
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
    <div class="container-fluid" style="padding:0px">
    <nav class="navbar navbar-expand-lg navbar-light bg-light" style="border-top: ridge;">
  <div class="container" >
    <a class="navbar-brand" href="#">E-Commerce</a>
    <a class="navbar-brand" style = "font-size: inherit;" href="#">E-MAIL E-Commerce@gmail.com</a>
    <a class="navbar-brand" style = "font-size: inherit;" href="#">whatsapp (47) 12345-1234</a>
    </div>
  </div>
    
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>

