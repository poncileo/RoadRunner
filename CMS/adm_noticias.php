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
				$_SESSION['idnoticia'] = $cod;
				$_SESSION['modo'] = "editar";
				header('location:adm_noticias_add.php');
			}elseif($modo == "excluir"){
				$cod=$_GET['codigo'];
				$sql = "delete from tbl_noticia where idnoticia =".$cod;
				mysql_query($sql);
				header('location:adm_noticias.php');
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
                        var lojas = $(this).parents(".noticias")[0];
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
					
					<div id="ttl">
						Notícias em destaque
					</div>
					<?php 
						$sql = "select * from tbl_noticia";
						$select = (mysql_query($sql));
						while($rs=(mysql_fetch_array($select))){
					?>
					<div class="noticias">
						<div class="imgnoticia">
							<img src="<?php echo($rs['imagem']) ?>" alt="noticia" />
						</div>
						<div class="noticia">
							<div class="ttlnoticia">
								<?php echo($rs['ttlnoticia'])?>
							</div>
							<div class="noticiabtn">
								<button id="opener" class="details_opener">Ver mais</button>
							</div>
						</div>
						<div class="options">
							<div class="option"><a href="adm_noticias.php?modo=editar&codigo=<?php echo($rs['idnoticia']) ?>">Editar</a></div>
							<div class="option"><a href="adm_noticias.php?modo=excluir&codigo=<?php echo($rs['idnoticia']) ?>">Excluir</a></div>
						</div>
						<div id="dialog" class="dialog" >
                            <div id="modal" class="modal">
								<div class="modal_noticia">
									<p class="ttl_modal">Notícia</p>
									<?php echo($rs['txtnoticia']) ?>
								</div>
							</div>
                        </div>
					</div>
						<?php }?>
					<div id="add">
						<a href="adm_noticias_add.php"> <img src="images/news_add.png" /></a>
					</div>
                </div>
            </div>
            <footer>
            </footer>
        </div> 
    </body>
</html>