<!DOCTYPE html>
<?php
    session_start();
    require_once('../include/dbconnect.php');
    $_SESSION['modo'] = "";
    $_SESSION['subcatmodo'] = "";
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
				$_SESSION['idcat'] = $cod;
				$_SESSION['modo'] = "editar";
				header('location:adm_categorias_add.php');
			}elseif($modo == "excluir"){
				$cod=$_GET['codigo'];
				$sql = "delete from tbl_categoria where idcategoria =".$cod;
				mysql_query($sql);
				header('location:adm_categorias.php');
			}elseif($modo == "addsubcat"){
                $cod=$_GET['codigo'];
                $_SESSION['idcat'] = $cod;
                header('location:adm_subcategoria_add.php');
            }
		}
        if(isset($_GET['subcatmodo'])){
            $subcatmodo = $_GET['subcatmodo'];
            
            if($subcatmodo == "editar"){
                $subcatcodigo = $_GET['subcatcodigo'];
                $_SESSION['idsubcat'] = $subcatcodigo;
                $_SESSION['subcatmodo'] = "editar";
                $_SESSION['idcat'] = $cod;
                                
                header('location:adm_subcategoria_add.php');
                
            }elseif($subcatmodo == "excluir"){
                $subcatcodigo = $_GET['subcatcodigo'];
                $sql = "delete from tbl_cat_subcat where idsubcategoria =".$subcatcodigo;
                $sql1 = "delete from tbl_subcategoria where idsubcategoria =".$subcatcodigo;
                mysql_query($sql);
                mysql_query($sql1);
                //header('location:adm_categorias.php');
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
                        var lojas = $(this).parents(".categorias")[0];
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
						Categorias de produtos
					</div>
					<?php 
						$sql = "select * from tbl_categoria";
						$select = (mysql_query($sql));
						while($rs=(mysql_fetch_array($select))){
					?>
					<div class="categorias">
						<div class="categoria">
							<div class="ttlcategoria">
								<?php echo($rs['descricao'])?>
							</div>
                            <div class="noticiabtn">
								<button id="opener" class="details_opener">Subcategorias</button>
							</div>
						</div>
						<div class="options">
							<div class="option"><a href="adm_categorias.php?modo=editar&codigo=<?php echo($rs['idcategoria']) ?>">Editar</a></div>
							<div class="option"><a href="adm_categorias.php?modo=excluir&codigo=<?php echo($rs['idcategoria']) ?>">Excluir</a></div>
                            <?php
                                /*$sql1 = "select * from tbl_subcategoria sc inner join tbl_cat_subcat cs on sc.idsubcategoria = cs.idsubcategoria where idcategoria =".$rs['idcategoria'];
                                echo($sql1);
                                //$select1 = mysql_query($sql1);
                                //$res=mysql_fetch_array($select1)*/
                            ?>
                            <div class="option"><a href="adm_categorias.php?modo=addsubcat&codigo=<?php echo($rs['idcategoria']) ?>">Add Subcategoria</a></div>
                            
						</div>
						<div id="dialog" class="dialog" >
                            <div id="modal" class="modal">
								<div class="modal_cat">
									<p class="ttl_modal">Subcategorias</p>
									<?php
                                        
                                        $sql1 = "select * from tbl_subcategoria sc inner join tbl_cat_subcat cs on sc.idsubcategoria = cs.idsubcategoria where idcategoria =".$rs['idcategoria'];
                                        $select1 = mysql_query($sql1);
                                        while($res = mysql_fetch_array($select1)){
                                        
                                    ?>
                                    <div class="subcat">
                                        <div class="subcat_ttl">
                                            <?php echo($res['descricao']) ?>
                                        </div>
                                        <div class="subcat_opt">
                                             <div class="option"><a href="adm_categorias.php?subcatmodo=editar&subcatcodigo=<?php echo($res['idsubcategoria']) ?>">Editar</a></div>
                                            <div class="option"><a href="adm_categorias.php?subcatmodo=excluir&subcatcodigo=<?php echo($res['idsubcategoria']) ?>">Excluir</a></div>
                                        </div>
                                    </div>
                                   <?php } ?> 
								</div>
							</div>
                        </div>
					</div>
						<?php }?>
					<div id="add">
						<a href="adm_categorias_add.php"> <img src="images/news_add.png" /></a>
					</div>
                </div>
            </div>
            <footer>
            </footer>
        </div> 
    </body>
</html>