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
				$_SESSION['idatleta'] = $cod;
				$_SESSION['modo'] = "editar";
				header('location:adm_eventos_add.php');
				
			}elseif($modo == "excluir"){
				
				$cod=$_GET['codigo'];
				$sql = "delete from tbl_atleta_destaque where idatleta =".$cod;
				mysql_query($sql);
				header('location:adm_eventos.php');
				
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
                        var lojas = $(this).parents(".atletas")[0];
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
                        Atleta do mês
                    </div>
                    <?php
                        $sql = "select * from tbl_atleta_destaque";
                        $select = mysql_query($sql);
                        while($rs=mysql_fetch_array($select)){
                    ?>
                    <div class="atletas">
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
                        <div class="imgatleta">
                            <img src="<?php echo($rs['foto']) ?>" />
                        </div>
                        <div class="ttlatleta">
							<div>
								<?php echo($rs['nome']) ?>
							</div>
                        </div>
                        <div class="atlop">
                            <div class="option"><a href="adm_eventos.php?modo=editar&codigo=<?php echo($rs['idatleta']) ?>">Editar</a></div>
                            <div class="option"><a href="adm_eventos.php?modo=excluir&codigo=<?php echo($rs['idatleta']) ?>">Excluir</a></div>
                            <div class="option"><button id="opener" class="details_opener">Detalhes</button></div>
                        </div>
                        <div id="dialog" class="dialog" >
                            <div id="modal" class="modal">
                                <div class="moda_atl">
                                    <div class="ttlatleta">
                                        <?php echo($rs['nome']) ?>
                                    </div>
                                    <div class="ftatleta">
                                        <img src="<?php echo($rs['foto']) ?>" />
                                        <?php echo($rs['descfoto']) ?>
                                    </div>
                                    <div class="trajet">
										<p class="ttl_modal">Trajetória</p>
                                        <?php echo($rs['trajetoria']) ?>
                                    </div>
                                </div>    
                            </div>
                        </div>
                    </div>
                    <?php } ?>
					<div id="add">
                        <a href="adm_eventos_add.php"><img src="images/calendar_add.png" /></a>
                    </div>
                </div>
            </div>
            <footer>
            </footer>
        </div> 
    </body>
</html>