
<!DOCTYPE html>
<html>
<head>
    <title>Título da página</title>
    <meta charset="utf-8"/>
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</head>
<body>

<?php
  $Linhas = 10;
  $Colunas = 5;
  $NumRegistros = 2;
  $PaginaAtual = 1;
  

  session_start();
  if (isset($_GET['pagina'])) {
      $PaginaAtual = $_GET['pagina'];

  };

  if (!isset($_SESSION['Matriz'])){

    for($iCount = 0; $iCount < $Linhas; $iCount++) {
        for ($iCount2 = 0; $iCount2 < $Colunas; $iCount2++){
            $_SESSION['Matriz'][$iCount][$iCount2] = rand(0,100);
        };
    };
    
  };
    echo "<div class='container pt-5'>
    <div class='row'>
    <table class='table table-bordered'";
    for($iCount =  $PaginaAtual; $iCount < $PaginaAtual+2; $iCount++) {
      echo "<tr>";
      for ($iCount2 = 0; $iCount2 < $Colunas; $iCount2++){

        echo "<th> {$_SESSION['Matriz'][$iCount][$iCount2]} </th>";  
     };
     echo "</tr> ";
    };

    
    echo "</table> </div> </div>";
    echo "<div class='container'> <div class='row'> <div class='col-12 text-center'";

    if($PaginaAtual > 1){
        $PaginaBotao = $PaginaAtual-1;
        echo "<a href='?pagina={$PaginaBotao}'><input type='button' name = 'volta' value='voltar'></a>";
    }else{
        echo "<a href='?'><input type='button' name = 'volta' value='voltar'></a>";
    };

    if ( $PaginaAtual < ($Linhas / $NumRegistros)){
        $PaginaBotao = $PaginaAtual+1;
        echo "<a href='?pagina={$PaginaBotao}'><input type='button' name = 'prox' value='proximo'></a>";
    }else{
        echo "<a href='?'><input type='button' name = 'prox' value='proximo'></a>";
    };

    //$PaginaAtual++;
    echo "<p>Pagina atual : {$PaginaAtual}</p>";

    echo "</table> </div> </div> </div> ";
?>

</body>
</html>