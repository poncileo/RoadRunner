<!DOCTYPE html>
<?php
    session_start();
    require_once('../include/dbconnect.php');
	
	if($_SESSION['nomeUser'] == ""){
		CMSvalidation();
	}else{
		if(isset($_POST['btnlogout'])){
			CMSlogout();
		}
	}
	
?>
<html>
    <head>
        <link href="https://fonts.googleapis.com/css?family=Anton" rel="stylesheet">
        <title>
            
        </title>   
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" type="text/css" href="css/style.css" />
    </head>
    <body>
        <div id="principal">
            <header>
                <div id="pgtitle">
                    <a href="home.php">CMS - Sistema de Gerenciamento do Site </a>
                </div>
                <div id="pglogo">
                    <a href="home.php"><img src="images/logo.png" alt="logo" /></a>
                </div>
            </header>
           <?php
                include("include/menu.php");
            ?>	
            <div id="corpo">
				
            </div>
            <footer>
            </footer>
        </div> 
    </body>
</html>