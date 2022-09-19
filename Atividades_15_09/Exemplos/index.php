<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atividade_Exemplo</title>
</head>
<body>
    <?php
        $nome = '';
        $email = '';
        echo "<h1>".$email."</h1>";
        echo "<h1>".$nome."</h1>";
        
        //isset --> verifica se a variavel existe
        //empty --> verifica se a variavel esta vazia
        if (isset($_POST['enviar'])) {
            if (empty($_POST['email'])) {
               echo 'Informe um e-mail. <br>';
            } else {
               $email = $_POST['email']; 
            }
            if (empty($_POST['nome'])) {
                echo 'Informe um nome. <br>';
            } else {
                $nome = $_POST['nome'];
            }
            
        }

    ?>
    <hr>
    <!-- todo input precisa ter um name -->
    <form method="post">
        <input type="text" name="email" value="<?php echo $email?>">
        <input type="text" name="nome" value="<?php echo $nome?>">

        <input type="Submit" name="enviar" value="Enviar">
    </form>

</body>
</html>