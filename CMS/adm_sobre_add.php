<!DOCTYPE html>
<?php
    session_start();
    require_once('../include/dbconnect.php');
    $_SESSION['titulo'] = "";
	$_SESSION['id'] = "";
	$_SESSION['texto'] = "";
	
	if($_SESSION['nomeUser'] == ""){
		header('location:http://localhost/LeonardoPonciano/projeto_final/index.php');
	}else{
		if(isset($_POST['btnlogout'])){
			$_SESSION['nomeUser'] = "";
			header('location:http://localhost/LeonardoPonciano/projeto_final/index.php');
		}
		if($_SESSION['modo'] == "editar"){
			
			$idsobre = $_SESSION['idsobre'];
			$sql = "select * from tblsobre_loja where id=".$idsobre;
			$select = mysql_query($sql);
			$rs = mysql_fetch_array($select);
			
			$_SESSION['titulo'] = $rs['titulo'];
			$_SESSION['id'] = $rs['id'];
			$_SESSION['texto'] = $rs['texto'];
			$botao= "Atualizar";
		}
		else{
			$botao = "Salvar";
		}
		if(isset($_POST['btnsalvar'])){
			$titulo = $_POST['ttlhistoria'];
			$historia = $_POST['historia'];
            $visivel = (int) $_POST['visivel'];
			$nome_arq = basename($_FILES['filefoto']['name']);
			$uploaddir ="arquivos/";
			$uploadfile = $uploaddir.$nome_arq;
			
            if(strstr($nome_arq, '.jpg') || strstr($nome_arq, '.png')){
					
					if(move_uploaded_file($_FILES['filefoto']['tmp_name'],$uploadfile)){
						
                        if($_POST['btnsalvar'] == "Salvar"){
                            if($_POST['visivel'] == "1"){
                                $sql = "update tblsobre_loja set visivel = 0";
                                mysql_query($sql);
						      }
				            $sql = "insert into tblsobre_loja(imagem, titulo, texto, visivel) values('".$uploadfile."','".$titulo."','".$historia."',".$visivel.")";	
                            mysql_query($sql);
                            header('location:adm_sobre.php');
                            
			             }elseif($_POST['btnsalvar'] == "Atualizar"){
                            if($_POST['visivel'] == "1"){
                                $sql = "update tblsobre_loja set visivel = 0";
                                mysql_query($sql);
						      }
                            $sql = "update dbroadrunner.tblsobre_loja set imagem='".$uploadfile."',titulo='".$titulo."',texto='".$historia."', visivel=".$visivel." where id=".$_SESSION['idsobre'];
                            mysql_query($sql);
                            header('location:adm_sobre.php');
                        }					
					}
                       
				}else{
					echo("Arquivo inválido");
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
					<form name="frmsobre" method="post" enctype="multipart/form-data" action="adm_sobre_add.php">
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
                                    Titulo Sobre Loja:
                                </td>
                                <td>
                                    <input type="text" name="ttlhistoria" required value="<?php echo($_SESSION['titulo']) ?>"/>      
                                </td>
                            </tr>                             
                            <tr>
                                <td>
                                     Historia da Loja:
                                </td>
                                <td>
                                    <textarea name="historia" cols="40" rows="5" style="resize:none" required><?php echo($_SESSION['texto']) ?></textarea>        
                                </td>                            
                            </tr>
                            <tr>
                                <td>
                                    <input type="radio" name="visivel" value="1"/>Visível
                                    <input type="radio" name="visivel" value="0" checked/>Não visível
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