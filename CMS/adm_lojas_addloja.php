<!DOCTYPE html>
<?php
    session_start();
    require_once('../include/dbconnect.php');
    $_SESSION['endereco'] = "";
    $_SESSION['telefone'] = "";
	$result = mysql_query("select * from tblusuario as u inner join tblnivel_usuario as nu on u.idnivel = nu.idnivel");
	$rs = mysql_fetch_array($result);
	
	if($_SESSION['nomeUser'] == ""){
		header('location:http://localhost/LeonardoPonciano/projeto_final/index.php');
	}else{
		if(isset($_POST['btnlogout'])){
			$_SESSION['nomeUser'] = "";
			header('location:http://localhost/LeonardoPonciano/projeto_final/index.php');
		}
		if($_SESSION['modloja'] == "editar"){
			
			$idloja = $_SESSION['idloja'];
			$sql = "select * from tbl_loja where idloja =".$idloja;
			$select = mysql_query($sql);
			$rs = mysql_fetch_array($select);
			
			$_SESSION['endereco'] = $rs['endereco'];
			$_SESSION['telefone'] = $rs['telefone'];
			$botao= "Atualizar";
		}
		else{
			$botao = "Salvar";
		}
		if(isset($_POST['btnsalvar'])){
			
			$endereco = $_POST['endereco'];
			$telefone = $_POST['telefone'];
			
			if($_POST['btnsalvar'] == "Salvar"){
				$sql1 = "insert into tbl_loja(endereco, telefone, idnl) values('".$endereco."','".$telefone."',".$_SESSION['idnl'].")";
				mysql_query($sql1);
				header('location:adm_lojas.php');
			}
			elseif($_POST['btnsalvar'] == "Atualizar"){
				$sql1 = "update tbl_loja set endereco='".$endereco."', telefone='".$telefone."', idnl=".$_SESSION['idnl']." where idloja =".$_SESSION['idloja'];
				mysql_query($sql1);
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
					<form name="frmsobre" method="post" enctype="multipart/form-data" action="adm_lojas_addloja.php">
						<table>
                            <tr>
                                <td>
                                    Endereço:
                                </td>
                                <td>
                                    <input type="text" name="endereco" required value="<?php echo($_SESSION['endereco']) ?>"/>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Telefone:        
                                </td>
                                <td>
                                     <input type="text" name="telefone" required value="<?php echo($_SESSION['telefone']) ?>" />
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