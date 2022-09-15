<?php
    //EXEPLO AULA 
    //$valores[] 0
    //$valores[] 1
    //$valores[] 2
    //$valores[] 3
    $valores[1]['nome'] = 'Marcondes';
    $valores[1]['sobrenome'] = 'Maçaneiro';
    $valores[1]['email'] = 'marcondes@unidavi.edu.br';
    $valores[2]['nome'] = 'Leticia';
    $valores[2]['sobrenome'] = 'Maçaneiro';
    $valores[2]['email'] = 'leticia@gmail.com';


    for ($i=1;$i<=2;$i++) {
        print_r($valores[$i]);
        echo '<br>';
    }

?>