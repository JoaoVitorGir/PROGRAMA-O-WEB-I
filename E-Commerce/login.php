<?php
    include "lib/dbconn.php";
?>

<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title>Login</title>
		<meta charset="UTF-8" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <link rel="stylesheet" href="styles/estilo_login.css">
		
	</head>
	<body>
		<div class="global">
            <a class="nav-link" href="index.php" style="color: white; margin-bottom: 50px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                </svg> Voltar ao site
            </a>
			<form name="" method="post" action="">
            
				<label>Usuário: <input type="text" name="user" /></label><br /><br />
				<label>Senha: <input type="password" name="pass" /></label><br /><br />
				<input type="submit" name="submit" value="Login" />
			</form>
			<?php
				$user = @$_REQUEST['user'];
				$pass = @$_REQUEST['pass'];
				$submit = @$_REQUEST['submit'];
                // user tem que ser unico para não dar erro 
				$sql = "SELECT login,senha FROM meu_commerce.usuarios where login = '{$user}'";
				$consulta = $conn->prepare($sql);
				$consulta->execute();
				
                foreach($consulta as $resposta){
					if($submit){
						
						if(($user == $resposta['login'] && $pass == $resposta['senha'])){
							
							$sql_update = "UPDATE meu_commerce.usuarios SET logado = :logado where login = :login and senha = :senha";
							$stmt= $conn->prepare($sql_update);
							$stmt->execute(array(
								"logado" => 1,
								"login"  => $user,
								"senha"  => $pass
						    ));
							
							session_start();
							$_SESSION['usuario']=$user;
							$_SESSION['senha']=$pass;
							header("Location: login.php");
						} else {
							echo "Senha ou usúario não estão corretos";
						} 
					}
					
			    }
			?>
		</div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
	</body>
</html>			