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
                    <div id="ttl">Estatísticas de Produtos</div>
					<div class="estatisticas">
                        <div class="est_ttl">
                            <div class="est_desc">Id</div>
                            <div class="est_desc">Nome</div>
                            <div class="est_desc">Clicks</div>
                            <div class="est_desc">Porcentagem</div>
                        </div>
                        <?php 
                            $sql = "select sum(visitas) as totalvisitas from tbl_produto";
                            $soma = mysql_fetch_assoc(mysql_query($sql, $conexao))['totalvisitas'];
                            $sql1 = "select *, TRUNCATE(visitas/".$soma." * 100, 2) as percent from tbl_produto";
                            $slct = mysql_query($sql1);
                            while($res = mysql_fetch_array($slct)){
                        ?>
                        <div class="est_prod">
                            <div class="est_desc"><?php echo($res['idproduto']) ?></div>
                            <div class="est_desc"><?php echo($res['nome']) ?></div>
                            <div class="est_desc"><?php echo($res['visitas']) ?></div>
                            <div class="est_desc_porcent">
                                <div style="width: 200px;">
                                    <div style="width: <?php echo(round($res['percent'])) ?>%;
                                    height: 40px; background-color: red;">
                                    </div>
                                </div>
                                <div>
                                    <?php echo($res['percent']) ?>%
                                </div>
                                
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <footer>
            </footer>
        </div> 
    </body>
</html>