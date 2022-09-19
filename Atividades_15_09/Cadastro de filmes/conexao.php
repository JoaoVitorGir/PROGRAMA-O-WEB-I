<?php
$username = 'root';
$password = '';

try{
    $conn = new PDO('mysql:host-localhost;dbname-nortwind',$username,$password);

} catch(PDOException $e){
    echo 'ERRO: ' . $e->getMessage();
}
?>