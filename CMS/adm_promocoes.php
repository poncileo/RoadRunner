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
				$_SESSION['idproduto'] = $cod;
				$_SESSION['modo'] = "editar";
				header('location:adm_promocoes_add.php');
				
			}elseif($modo == "excluir"){
				$cod=$_GET['codigo'];
				$sql = "update tbl_produto set promocao = 0 where idproduto =".$cod;
				mysql_query($sql);
				header('location:adm_promocoes.php');
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
					<div id="ttl">Promoções</div>
					<div id="prod_itens">
					<?php
						$sql = "select *, preco - (preco * promocao/100) as preco_promo from tbl_produto where  promocao > 0";
						$select = mysql_query($sql);
						while($rs=mysql_fetch_array($select)){
					?>
						<div class="prod_item">
							<div class="prod_img">
								<img src="<?php echo($rs['imagem']) ?>" />
							</div>
							<div class="prod_text"> 
								<p>
									<span class="prod_nm"><?php echo($rs['nome']) ?></span> <br/>
									<?php echo($rs['descricao']) ?><br/>
									<span class="prod_preco">R$<?php echo($rs['preco']) ?></span> R$<?php echo(round($rs['preco_promo'],2)) ?>
								</p>
							</div>
							<div class="prod_opt">
								<div class="option"><a href="adm_promocoes.php?modo=editar&codigo=<?php echo($rs['idproduto']) ?>">Editar</a></div>
								<div class="option"><a href="adm_promocoes.php?modo=excluir&codigo=<?php echo($rs['idproduto']) ?>">Excluir</a></div>
							</div>
						</div>
						<?php } ?>
					</div>
					<div id="add">
						<a href="adm_promocoes_add.php" ><img src="images/sale_add.png" /></a>
					</div>
                </div>
            </div>
            <footer>
            </footer>
        </div> 
    </body>
</html>