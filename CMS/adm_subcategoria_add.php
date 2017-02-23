<!DOCTYPE html>
<?php
    session_start();
    require_once('../include/dbconnect.php');
    $_SESSION['subcategoria'] = "";
	$result = mysql_query("select * from tblusuario as u inner join tblnivel_usuario as nu on u.idnivel = nu.idnivel");
	$rs = mysql_fetch_array($result);
	
	if($_SESSION['nomeUser'] == ""){
		header('location:http://localhost/LeonardoPonciano/projeto_final/index.php');
	}else{
		if(isset($_POST['btnlogout'])){
			$_SESSION['nomeUser'] = "";
			header('location:http://localhost/LeonardoPonciano/projeto_final/index.php');
		}
		if($_SESSION['subcatmodo'] == "editar"){
			
			$idsubcat = $_SESSION['idsubcat'];
			$sql = "select * from tbl_subcategoria where idsubcategoria =".$idsubcat;
            $select = mysql_query($sql);
			$rs = mysql_fetch_array($select);
			
			$_SESSION['subcategoria'] = $rs['descricao'];
			$botao= "Atualizar";
		}
		else{
			$botao = "Salvar";
		}
		if(isset($_POST['btnsalvar'])){
			
			$subcategoria = $_POST['subcategoria'];
			
			if($_POST['btnsalvar'] == "Salvar"){
				
                $sql = "insert into tbl_subcategoria(descricao) values('".$subcategoria."')";
                mysql_query($sql);
                
                $sql = "select * from tbl_subcategoria where descricao ='".$subcategoria."'";
                $select = mysql_query($sql);
                $rs = mysql_fetch_array($select);
                
                $sql1 = "insert into tbl_cat_subcat(idcategoria, idsubcategoria) values(".$_SESSION['idcat'].", ".$rs['idsubcategoria'].")";
				mysql_query($sql1);
				header('location:adm_categorias.php');
			}
			elseif($_POST['btnsalvar'] == "Atualizar"){
				$sql1 = "update tbl_subcategoria set descricao='".$subcategoria."' where idsubcategoria =".$_SESSION['idsubcat'];
				mysql_query($sql1);
				header('location:adm_categorias.php');
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
					<form name="frmsobre" method="post" action="adm_subcategoria_add.php">
						<div id="ttl">
                            <?php $sql="select * from tbl_categoria where idcategoria=".$_SESSION['idcat'];
                                  $select = mysql_query($sql);
                                  $rs = mysql_fetch_array($select);?>
                            Categoria: <?php echo($rs['descricao']) ?>
                        </div> 
                        <table>
                            <tr>
                                <td>
                                    Subcategoria: 
                                </td>
                                <td>
                                    <input type="text" name="subcategoria" required value="<?php echo($_SESSION['subcategoria']) ?>"/>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="submit" name="btnsalvar" value="<?php echo($botao) ?>" />
                                </td>
                            </tr>
                        </table>
					</form>
                </div>
            </div>
            <footer>
            </footer>
        </div> 
    </body>
</html>
</html>