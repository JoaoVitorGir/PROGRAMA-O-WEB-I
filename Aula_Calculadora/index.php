<?php
$op = "";
$num = "";
    
    session_start();
    if (isset($_GET['op'])) {
        session_destroy();
        session_start();
    }
	if (isset($_POST["op"])) {
        $_SESSION['op'] = $_POST["op"];

        $_SESSION['display'] = $_POST["display"];
        $num = "";

    };
    if (isset($_POST["botao"])) {
        $num = $_POST["display"].$_POST["botao"];

    };
    if (isset($_POST["igual"])) {

        switch ($_SESSION['op']) {
            case "+": $num = $_SESSION['display'] + $_POST['display']; 
			break;
            case "-": $num = $_SESSION['display'] - $_POST['display']; 
			break;
            case "*": $num = $_SESSION['display'] * $_POST['display']; 
			break;
            case "/": $num = $_SESSION['display'] / $_POST['display']; 
			break; 
        };

        $_SESSION["display"] = '';
        $_SESSION['op'] = '';
    };
?>
<form method="post">
	<input type="number" name="display" value="<?php echo $num; ?>">
	<br>
			<input type="submit" name="botao" value="7" >
			<input type="submit" name="botao" value="8" >
			<input type="submit" name="botao" value="9" >
			<input type="submit" name="op"    value="/">

			<br>

			<input type="submit" name="botao" value="4">
			<input type="submit" name="botao" value="5">
			<input type="submit" name="botao" value="6">
			<input type="submit" name="op"    value="+">

			<br>

			<input type="submit" name="botao" value="1" >
			<input type="submit" name="botao" value="2" >
			<input type="submit" name="botao" value="3" >
			<input type="submit" name="op"    value="-">

			<br>
			
			<input type="submit" name="botao" value="0">	
			<input type="submit" name="igual"    value="=">
			<input type="submit" name="op"    value="*">
</form>


