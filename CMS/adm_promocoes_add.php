<!DOCTYPE html>
<?php
    session_start();
    require_once('../include/dbconnect.php');
	$_SESSION['nome'] = "";
	$_SESSION['id'] = "";
	$_SESSION['promocao'] = "";	
	
	if($_SESSION['nomeUser'] == ""){
		header('location:http://localhost/LeonardoPonciano/projeto_final/index.php');
	}else{
		if(isset($_POST['btnlogout'])){
			$_SESSION['nomeUser'] = "";
			header('location:http://localhost/LeonardoPonciano/projeto_final/index.php');
		}
		if($_SESSION['modo'] == "editar"){
			
			$idproduto = $_SESSION['idproduto'];
			$sql = "select * from tbl_produto where idproduto =".$idproduto;
			$select = mysql_query($sql);
			$rs = mysql_fetch_array($select);
			
			$_SESSION['nome'] = $rs['nome'];
			$_SESSION['id'] = $rs['idproduto'];
			$_SESSION['promocao'] = $rs['promocao'];
			$botao= "Atualizar";
		}
		else{
			$botao = "Salvar";
		}
		if(isset($_POST['btnsalvar'])){
			$promocao = $_POST['promocao'];
			$produto = $_POST['slctvalor'];
			
			if($_POST['btnsalvar'] == "Salvar"){
				
						
				$sql = "update tbl_produto set promocao =".$promocao." where idproduto =".$produto;

			}elseif($_POST['btnsalvar'] == "Atualizar"){
				
						
				$sql = "update tbl_produto set promocao =".$promocao." where idproduto =".$_SESSION['id'];
				
			}
			mysql_query($sql);
			header('location:adm_promocoes.php');
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
					<form name="frmsobre" method="post" enctype="multipart/form-data" action="adm_promocoes_add.php">
                        <table>
                            <tr>
                                <td>
                                    <?php
                                        $sql = "select * from tbl_produto";
                                        $select = mysql_query($sql);

                                    ?>
                                    Produto:
                                </td>
                                <td>
                                     <select name="slctvalor">
                                        <?php 
                                            if($_SESSION['modo'] =="editar")
                                            {
                                                ?>
                                                <option value="<?php echo($_SESSION['id']) ?>" selected><?php echo($_SESSION['nome']) ?></option>
                                                <?php
                                            }else{
                                            ?>
                                                <option selected>Selecionar..</option>

                                        <?php 
                                            }

                                            while ($rs=mysql_fetch_array($select))
                                            {

                                        ?>
                                            <option value="<?php echo($rs['idproduto']) ?>"> <?php echo($rs['nome']) ?> </option>

                                        <?php 
                                            }
                                        ?>	
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Porcentagem de desconto: 
                                </td>
                                <td>
                                    <input type="text" name="promocao" value="<?php echo($_SESSION['promocao'])?>" required />
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