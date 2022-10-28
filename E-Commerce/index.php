<?php
    include "lib/dbconn.php";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matriz</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <style>
        .desc {
            text-decoration: none;
            color: black;
        }
        .desc:hover{
            color: blue;
            text-decoration: underline;
        }
        *, ::after, ::before {
          box-sizing: content-box;
        }
    </style>

</head>
<body>
    <div class="container-fluid" >
    <nav class="navbar navbar-expand-lg navbar-light bg-light" style="border: solid 1px; border-radius: 5px; padding: 10px; margin: 5px 5px 25px 5px">
  <div class="container-fluid" >
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
        <div class="row">
            
        </div>
        <div class="row">
          
        
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
                                        <a style="color:black; text-decoration:none; hover-back; font-size: 18px;" href="?categoria=<?php echo $linha['id'];?>">

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
                                               <a style="color:grey ; text-decoration:none; font-size: 15px;" 
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
            <div class="col-9">
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

                    <div class="card" style="width: 19rem; display: inline-block; margin: 0px 13px 13px 13px; border-radius: 12px">
                        <img style="width: 19rem; border-radius: 12px;" src="<?php echo $linha['imagem'];?>" alt="...">
                        <div class="card-body">
                          <div>
                            <a style="text-align: center;" class="desc" href="descricao.php"><h5 class="card-title"><?php echo $linha['descricao'];?></h5></a>
                            <p class="card-text"><?php echo $linha['resumo']?></p>
                          </div>

                            
                        </div>
                        <a class="btn btn-primary" href="#" role="button" style="display: flex;margin: inherit;justify-content: center;">Ver mais</a>
                    </div>
                    <?php
                    }
                ?>
            </div>  <!-- Final da lista de imagens -->


            
        </div>
        <div class="row" style="background-color: blue;">
            Rodapé
        </div>
    </div>  
    
    
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>

<!-- nova lista 
<div class="accordion" id="accordionExample">
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingOne">
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
        Accordion Item #1
      </button>
    </h2>
    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        <strong>This is the first item's accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
      </div>
    </div>  
  </div>
nova lista -->