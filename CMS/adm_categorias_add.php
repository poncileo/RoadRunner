<!DOCTYPE html>
<?php
    session_start();
    require_once('../include/dbconnect.php');
    $_SESSION['categoria'] = "";
	$result = mysql_query("select * from tblusuario as u inner join tblnivel_usuario as nu on u.idnivel = nu.idnivel");
	$rs = mysql_fetch_array($result);
	
	if($_SESSION['nomeUser'] == ""){
		header('location:http://localhost/LeonardoPonciano/projeto_final/mainpage.php');
	}else{
		if(isset($_POST['btnlogout'])){
			$_SESSION['nomeUser'] = "";
			header('location:http://localhost/LeonardoPonciano/projeto_final/mainpage.php');
		}
		if($_SESSION['modo'] == "editar"){
			
			$idcategoria = $_SESSION['idcat'];
			$sql = "select * from tbl_categoria where idcategoria=".$idcategoria;
			$select = mysql_query($sql);
			$rs = mysql_fetch_array($select);
			
			$_SESSION['categoria'] = $rs['descricao'];
			$botao= "Atualizar";
		}
		else{
			$botao = "Salvar";
		}
		if(isset($_POST['btnsalvar'])){
			$categoria = $_POST['categoria'];

            if($_POST['btnsalvar'] == "Salvar"){

                $sql = "insert into tbl_categoria(descricao) values('".$categoria."')";

               mysql_query($sql);
                

            }elseif($_POST['btnsalvar'] == "Atualizar"){

                $sql = "update tbl_categoria set descricao ='".$categoria."' where idcategoria=".$_SESSION['idcat'];

                mysql_query($sql);

            }
            header('location:adm_categorias.php');
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
					<form name="frmsobre" method="post" enctype="multipart/form-data" action="adm_categorias_add.php">
                        <table>
                            <tr>
                                <td>
                                    Categoria: 
                                </td>
                                <td>
                                    <input type="text" name="categoria" required value="<?php echo($_SESSION['categoria'])?>"/>
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