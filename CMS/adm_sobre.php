<!DOCTYPE html>
<?php
    session_start();
    require_once('../include/dbconnect.php');
    $_SESSION['modo'] = "";
	$result = mysql_query("select * from tblusuario as u inner join tblnivel_usuario as nu on u.idnivel = nu.idnivel");
	$rs = mysql_fetch_array($result);
	
	if($_SESSION['nomeUser'] == ""){
		header('location:http://localhost/LeonardoPonciano/projeto_final/index.php');
	}else{
		if(isset($_POST['btnlogout'])){
			$_SESSION['nomeUser'] = "";
			header('location:http://localhost/LeonardoPonciano/projeto_final/index.php');
		}
		if(isset($_GET['modo'])){
			$modo = $_GET['modo'];
			
			if($modo == "editar"){
				
				$cod  =$_GET['codigo'];
				$_SESSION['idsobre'] = $cod;
				$_SESSION['modo'] = "editar";
				header('location:adm_sobre_add.php');
				
			}elseif($modo == "excluir"){
				
				$cod=$_GET['codigo'];
				$sql = "delete from tblsobre_loja where id =".$cod;
				mysql_query($sql);
				header('location:adm_sobre.php');
			}
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
                        var lojas = $(this).parents(".sobre")[0];
                        var dialog = lojas.querySelectorAll(".dialog")[0];
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
					<div id="ttl">Sobre a Loja</div>
					<?php
						$sql = "select * from tblsobre_loja";
						$select = mysql_query($sql);
						while($rs=mysql_fetch_array($select)){
					?>
					<div class="sobre">
                        <div class="imgvisivel">
                            <?php
                                if($rs['visivel'] == 1){
                                    $visivel = "images/visible_icon.png";
                                }else{
                                    $visivel = "images/nonvisible_icon.png";
                                }
                            ?>
                            <img src="<?php echo($visivel) ?>" />
                        </div>
						<div class="sobre_img">
							<img src="<?php echo($rs['imagem']) ?>" ?>
						</div>
						<div class="sobre_info">
							<div class="sobre_ttl">
								<?php echo($rs['titulo']) ?>
							</div>
							<div class="sobre_txt">
								<div class="sobre_limit">
									<?php echo($rs['texto']) ?>
								</div>
							</div>
							<div class="btndeta">
								<button id="opener" class="details_opener">Ver mais</button>
							</div>						
						</div>
						<div class="sobre_opt">
							<div class="option"><a href="adm_sobre.php?modo=editar&codigo=<?php echo($rs['id']) ?>">Editar</a></div>
							<div class="option"><a href="adm_sobre.php?modo=excluir&codigo=<?php echo($rs['id']) ?>">Excluir</a></div>
						</div>
						<div id="dialog" class="dialog" >
                            <div id="modal" class="modal">
								<div class="modal_sobre">
									<?php echo($rs['texto']) ?>
								</div>
                            </div>
                        </div>
					</div>
					<?php } ?>
					<div id="add">
						<a href="adm_sobre_add.php" ><img src="images/loja_add.png" /></a>
					</div>
                </div>
            </div>
            <footer>
            </footer>
        </div> 
    </body>
</html>