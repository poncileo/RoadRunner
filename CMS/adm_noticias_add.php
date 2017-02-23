<!DOCTYPE html>
<?php
    session_start();
    require_once('../include/dbconnect.php');
	$_SESSION['titulo'] = "";
	$_SESSION['noticia'] = "";
	$_SESSION['foto'] = "";	
	
	if($_SESSION['nomeUser'] == ""){
		header('location:http://localhost/LeonardoPonciano/projeto_final/index.php');
	}else{
		if(isset($_POST['btnlogout'])){
			$_SESSION['nomeUser'] = "";
			header('location:http://localhost/LeonardoPonciano/projeto_final/index.php');
		}
		if($_SESSION['modo'] == "editar"){
			
			$idnoticia = $_SESSION['idnoticia'];
			$sql = "select * from tbl_noticia where idnoticia =".$idnoticia;
			$select = mysql_query($sql);
			$rs = mysql_fetch_array($select);
			$_SESSION['titulo'] = $rs['ttlnoticia'];
			$_SESSION['noticia'] = $rs['txtnoticia'];
			$_SESSION['foto'] = $rs['imagem'];
			$botao= "Atualizar";
		}
		else{
			$botao = "Salvar";
		}
		if(isset($_POST['btnsalvar'])){
			$ttlnoticia = $_POST['ttlnoticia'];
			$txtnoticia = $_POST['txtnoticia'];
			$nome_arq = basename($_FILES['filefoto']['name']);
			$uploaddir ="arquivos/";
			$uploadfile = $uploaddir.$nome_arq;
			
			if($_POST['btnsalvar'] == "Salvar"){
				if(strstr($nome_arq, '.jpg') || strstr($nome_arq, '.png')){
					
					if(move_uploaded_file($_FILES['filefoto']['tmp_name'],$uploadfile)){
						
						$sql = "insert into tbl_noticia(imagem, ttlnoticia, txtnoticia) values('".$uploadfile."','".$ttlnoticia."','".$txtnoticia."')";
					}
				}else{
					echo("Arquivo inválido");
				}
			}elseif($_POST['btnsalvar'] == "Atualizar"){
				if(strstr($nome_arq, '.jpg') || strstr($nome_arq, '.png')){
					
					if(move_uploaded_file($_FILES['filefoto']['tmp_name'],$uploadfile)){
						
						$sql = "update dbroadrunner.tbl_noticia set imagem='".$uploadfile."',ttlnoticia='".$ttlnoticia."',txtnoticia='".$txtnoticia."' where idnoticia=".$_SESSION['idnoticia'];
					}
				}else{
					echo("Arquivo inválido");
				}
			}
			mysql_query($sql);
			header('location:adm_noticias.php');
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
					<form name="frmsobre" method="post" enctype="multipart/form-data" action="adm_noticias_add.php">
                        <table>
                            <tr>
                                <td>
                                    Escolha uma foto:     
                                </td>
                                <td>
                                    <input type="file" name="filefoto" required />    
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Título da Notícia:
                                </td>
                                <td>
                                 <input type="text" name="ttlnoticia" value="<?php echo($_SESSION['titulo'])?>" required />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                     Notícia:
                                </td>
                                <td>
                                    <textarea name="txtnoticia" cols="40" rows="5" style="resize:none" required><?php echo($_SESSION['noticia'])?></textarea>
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