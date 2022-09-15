<?php
  $Linhas = 10;
  $Colunas = 5;
  $NumRegistros = 2;
  $PaginaAtual = 0;
  

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

    for($iCount = $PaginaAtual * $NumRegistros; $iCount < $PaginaAtual * $NumRegistros + $NumRegistros; $iCount++) {
            var_dump($_SESSION['Matriz'][$iCount]);
           echo'<br>';
    };

    if($PaginaAtual != 0){
        $PaginaBotao = $PaginaAtual-1;
        echo "<a href='?pagina={$PaginaBotao}'><input type='button' name = 'volta' value='voltar'></a>";
    }
 if ( $PaginaAtual+1 < ($Linhas / $NumRegistros) ){
        $PaginaBotao = $PaginaAtual+1;
        echo "<a href='?pagina={$PaginaBotao}'><input type='button' name = 'prox' value='proximo'></a>";
    }
    
    $PaginaAtual++;
    echo "<p>Pagina atual : {$PaginaAtual }</p>"
      

?>

<!-- <a href="?pagina=0"><input type='button' name = 'volta' value='voltar'></a> -->