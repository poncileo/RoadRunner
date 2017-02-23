<!DOCTYPE html>
<?php
    session_start();
    require_once('../include/dbconnect.php');
    $_SESSION['atlnome'] = "";
    $_SESSION['descfoto'] = "";
    $_SESSION['trajetoria'] = "";
    $_SESSION['atlfoto'] = "";
	
	if($_SESSION['nomeUser'] == ""){
		header('location:http://localhost/LeonardoPonciano/projeto_final/index.php');
	}else{
		if(isset($_POST['btnlogout'])){
			$_SESSION['nomeUser'] = "";
			header('location:http://localhost/LeonardoPonciano/projeto_final/index.php');
		}
		if($_SESSION['modo'] == "editar"){
			
			$idatleta = $_SESSION['idatleta'];
			$sql = "select * from tbl_atleta_destaque where idatleta =".$idatleta;
			$select = mysql_query($sql);
			$rs = mysql_fetch_array($select);
			
			$_SESSION['atlnome'] = $rs['nome'];
			$_SESSION['descfoto'] = $rs['descfoto'];
			$_SESSION['trajetoria'] = $rs['trajetoria'];
			$_SESSION['atlfoto'] = $rs['foto'];
			$botao= "Atualizar";
		}
		else{
			$botao = "Salvar";
		}
		if(isset($_POST['btnsalvar'])){
			$nome = $_POST['nome'];
			$trajetoria = $_POST['trajetoria'];
			$descfoto = $_POST['descricao'];
			$nome_arq = basename($_FILES['filefoto']['name']);
			$visivel = (int) $_POST['visivel'];
			$uploaddir ="arquivos/";
			$uploadfile = $uploaddir.$nome_arq;
			
			if(strstr($nome_arq, '.jpg') || strstr($nome_arq, '.png')){
				
				if(move_uploaded_file($_FILES['filefoto']['tmp_name'],$uploadfile)){
					
					if($_POST['btnsalvar'] == "Salvar"){
						if($_POST['visivel'] == "1"){
                            $sql = "update tbl_atleta_destaque set visivel = 0";
                            mysql_query($sql);
						}
						$sql = "insert into tbl_atleta_destaque(foto, descfoto, nome, trajetoria, visivel) values('".$uploadfile."','".$descfoto."','".$nome."','".$trajetoria."', ".$visivel.")";
						mysql_query($sql);
						
						header('location:adm_eventos.php');
					}elseif($_POST['btnsalvar'] == "Atualizar"){
						
						if($_POST['visivel'] == "1"){
                            $sql = "update tbl_atleta_destaque set visivel = 0";
                            mysql_query($sql);
						}
						$sql = "update tbl_atleta_destaque set foto ='".$uploadfile."', descfoto='".$descfoto."', nome='".$nome."', trajetoria='".$trajetoria."', visivel=".$visivel." where idatleta=".$_SESSION['idatleta'];
						mysql_query($sql);
						
						header('location:adm_eventos.php');
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
					<form name="frmsobre" method="post" enctype="multipart/form-data" action="adm_eventos_add.php">
                        <table>
                            <tr>
                                <td>
                                    Escolha uma foto:
                                </td>
                                <td>
                                    <input type="file" name="filefoto" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Descrição da foto: 
                                </td>
                                <td>
                                    <input type="text" name="descricao" required value="<?php echo($_SESSION['descfoto']) ?>" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Nome Atleta: 
                                </td>
                                <td>
                                    <input type="text" name="nome" required value="<?php echo($_SESSION['atlnome']) ?>" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Trajetória: 
                                </td>
                                <td>
						              <textarea name="trajetoria" cols="40" rows="5" style="resize:none" required><?php echo($_SESSION['trajetoria']) ?></textarea><br>
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