<!DOCTYPE html>
<?php
    session_start();
    require_once('../include/dbconnect.php');
    $_SESSION['modo'] = "";
    $_SESSION['modloja'] = "";
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
				$_SESSION['idnl'] = $cod;
				$_SESSION['modo'] = "editar";
				header('location:adm_lojas_add.php');
			}elseif($modo == "excluir"){
				$cod=$_GET['codigo'];
				$sql = "delete from tbl_loja where idnl =".$cod;
				$sql2 = "delete from tbl_nossas_lojas where idnl=".$cod;
				mysql_query($sql);
				mysql_query($sql2);
				header('location:adm_lojas.php');
			}elseif($modo == "addloja"){
				$cod=$_GET['codigo'];
				$_SESSION['idnl'] = $cod;
				header('location:adm_lojas_addloja.php');
			}
		}
		if(isset($_GET['lojamodo'])){
			$ljmodo = $_GET['lojamodo'];
			
			if($ljmodo == "editar"){
				$codloja = $_GET['lojacodigo'];
				$_SESSION['idloja'] = $codloja;
				$_SESSION['modloja'] = "editar";
				header('location:adm_lojas_addloja.php');
				
			}elseif($ljmodo == "excluir"){
				$codloja = $_GET['lojacodigo'];
				$sql = "delete from tbl_loja where idloja =".$codloja;
				mysql_query($sql);
				header('location:adm_lojas.php');
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
                        var lojas = $(this).parents(".lojas")[0];
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
						Lojas
					</div>
					<?php
						$sql = "select * from tbl_nossas_lojas";
						$select = mysql_query($sql);
						while($rs = mysql_fetch_array($select)){
							$id = $rs['idnl'];
					?>
					<div class="lojas">
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
						<div class="imgloja">
							<img src="<?php echo($rs['imagem']) ?>" alt="imagem"/>
						</div>
						<div class="loja">
							<div class="ttlloja">
								<?php echo($rs['titulo']) ?>
							</div>
							<div class="endloja">
								<?php 
									$sql2 = "select * from tbl_loja where idnl =".$id;
									$selec = mysql_query($sql2);
									while($res = mysql_fetch_array($selec)){
								?>
								<?php echo($res['endereco']) ?> -  <?php echo($res['telefone']) ?> <br>
									<?php } ?>
							</div>
							<div class="btndeta">
								<button id="opener" class="details_opener">Ver mais</button>
							</div>
						</div>	
						<div class="lojaopt">
							<div class="option"><a href="adm_lojas.php?modo=editar&codigo=<?php echo($rs['idnl']) ?>">Editar</a></div>
							<div class="option"><a href="adm_lojas.php?modo=addloja&codigo=<?php echo($rs['idnl']) ?>">Adicionar Loja</a></div>
							<div class="option"><a href="adm_lojas.php?modo=excluir&codigo=<?php echo($rs['idnl']) ?>">Excluir</a></div>
						</div>
						<div id="dialog" class="dialog" >
                            <div id="modal" class="modal">
                               <div class="modal_loja">
                                    <?php 
									$sql2 = "select * from tbl_loja where idnl =".$id;
									$selec = mysql_query($sql2);
									while($res = mysql_fetch_array($selec)){
                                    ?>
                                   <div class="enditens">
                                        <div class="enderecos">
                                            <?php echo($res['endereco']) ?> -  <?php echo($res['telefone']) ?> <br>
                                        </div>
                                        <div class="endopt">
                                            <div class="option"><a href="adm_lojas.php?lojamodo=editar&lojacodigo=<?php echo($res['idloja']) ?>">Editar</a></div>
                                            <div class="option"><a href="adm_lojas.php?lojamodo=excluir&lojacodigo=<?php echo($res['idloja']) ?>">Excluir</a></div>
                                        </div>
                                   </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
					</div>
						<?php } ?>
					<div id="add">
						<a href="adm_lojas_add.php" ><img src="images/map_add.png" /></a>
					</div>
                </div>
            </div>
            <footer>
            </footer>
        </div> 
    </body>
</html>