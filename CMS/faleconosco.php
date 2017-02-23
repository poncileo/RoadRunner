<!DOCTYPE html>
<?php
    session_start();
    require_once('../include/dbconnect.php');
	
	if($_SESSION['nomeUser'] == ""){
		header('location:http://localhost/LeonardoPonciano/projeto_final/index.php');
	}else{
		if(isset($_POST['btnlogout'])){
			$_SESSION['nomeUser'] = "";
			header('location:http://localhost/LeonardoPonciano/projeto_final/index.php');
		}
		if(isset($_GET['modo'])){
			$modo = $_GET['modo'];
			$cod=$_GET['codigo'];
			$sql = "delete from tblcontato where id =".$cod;
			mysql_query($sql);
			header('location:faleconosco.php');
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
			                    
                    var btn = document.getElementsByClassName('details_opener');
                    
                    $(btn).click(function(){
                        var item_box = $(this).parents(".item_box")[0];
                        var dialog = item_box.querySelectorAll(".dialog")[0];
                        dialog.style.display = "flex";
                        $(dialog).addClass("active_dialog");
                    });
                                
                    window.onclick = function(event){
                        var modal = document.getElementsByClassName('active_dialog')[0];
                        
                        if(event.target == modal){
                            modal.style.display = "none";
                            $(modal).removeClass("active_dialog");
                        }
                    }
					var span = document.getElementsByClassName('close')[0];
					span.onclick = function(){
						var modal = document.getElementsByClassName('active_dialog')[0];
						modal.style.display = "none";
						$(modal).removeClass("active_dialog");
					}
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
					<div id="ttl">Fale Conosco</div>
                    <div id="definition">
						<div class="defitem">Nome</div>
						<div class="defitem">Telefone</div>
						<div class="defitem">Celular</div>
						<div class="defitem">E-mail</div>
						<div class="defitem">Opcoes</div>
                    </div>
					<?php 
						$sql = "select * from tblcontato order by nome";
						$select = (mysql_query($sql));
						
						while($rs=mysql_fetch_array($select)) {
					?>
					<div id="item_box" class="item_box">
                        <div class="item"><?php echo($rs['nome'])?></div>
                        <div class="item"><?php echo($rs['telefone'])?></div>
                        <div class="item"><?php echo($rs['celular'])?></div>
                        <div class="item"><?php echo($rs['email'])?> </div>
                        <div class="item"><a href="faleconosco.php?modo=excluir&codigo=<?php echo($rs['id'])?>">Excluir</a><button id="opener" class="details_opener">Detalhes</button></div>
                        <div id="dialog" class="dialog" >
                            <div id="modal" class="modal">
								<div id="info">
									<div class="modttl">Sugestão</div>
									<div class="modtxt">
										<p><?php echo($rs['sugestao'])?></p>
									</div>
									
								</div>
								<div id="sugestao">
									<div class="modttl">Informações do Produto</div>
									<div class="modtxt">
										<p><?php echo($rs['infoprod'])?></p>
									</div>
									
								</div>
								<span class="close">X</span>
                            </div>
                        </div>
                    </div>                    
					<?php } ?>					
                </div>				    
            </div>
            <footer>
            </footer>
        </div> 
    </body>
</html>