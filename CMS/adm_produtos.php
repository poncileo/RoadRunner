<!DOCTYPE html>
<?php
    session_start();
    require_once('../include/dbconnect.php');
    $_SESSION['modo'] = "";
	
	if($_SESSION['nomeUser'] == ""){
		header('location:http://localhost/LeonardoPonciano/projeto_final/index.php');
	}else{
		if(isset($_POST['btnlogout'])){
			$_SESSION['nomeUser'] = "";
			header('location:http://localhost/LeonardoPonciano/projeto_final/index.php');
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
		<script src="JQUERY/jquery-3.1.0.min.js"></script>
		<script type="text/javascript" >		
			jQuery(document).ready(function ($) {
			                    
                 
			}); 
		</script>
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
				<div id="content">
					<div id="boxes">
						<div class="adm_box">
							<div class="box_image">
								<img src="images/news.png" />
							</div>
							<div class="box_txt">
								<a href="adm_produtos_view.php">Adm. Produtos</a>
							</div>
						</div>
						<div class="adm_box">
							<div class="box_image">
								<img src="images/loja.png" />
							</div>
							<div class="box_txt">
								<a href="adm_categorias.php">Adm. Categorias</a>
							</div>
						</div>	
                        <div class="adm_box">
							<div class="box_image">
								<img src="images/statistics.png" />
							</div>
							<div class="box_txt">
								<a href="adm_estatistica.php">Estatísticas de Produto</a>
							</div>
						</div>						
					</div>
                </div>
            </div>
            <footer>
            </footer>
        </div> 
    </body>
</html>