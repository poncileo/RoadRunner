<!DOCTYPE html>
<?php
    session_start();
    require_once('../include/dbconnect.php');

	$result = mysql_query("select * from tblusuario as u inner join tblnivel_usuario as nu on u.idnivel = nu.idnivel");
	$rs = mysql_fetch_array($result);
	$_SESSION['titulo'] = "";
	$_SESSION['endereco'] = "";
	$_SESSION['telefone'] = "";
	
	if($_SESSION['nomeUser'] == ""){
		header('location:http://localhost/LeonardoPonciano/projeto_final/index.php');
	}else{
		if(isset($_POST['btnlogout'])){
			$_SESSION['nomeUser'] = "";
			header('location:http://localhost/LeonardoPonciano/projeto_final/index.php');
		}
		if($_SESSION['modo'] == "editar"){
			
			$idnl = $_SESSION['idnl'];
			$sql = "select * from tbl_nossas_lojas nl inner join tbl_loja l on  nl.idnl = l.idnl where nl.idnl=".$idnl;
			$select = mysql_query($sql);
			$rs = mysql_fetch_array($select);
			
			$_SESSION['titulo'] = $rs['titulo'];
			$_SESSION['endereco'] = $rs['endereco'];
			$_SESSION['telefone'] = $rs['telefone'];
			$botao= "Atualizar";
		}
		else{
			$botao = "Salvar";
		}
		if(isset($_POST['btnsalvar'])){
			$titulo = $_POST['ttllojas'];
			$endereco = $_POST['endereco'];
			$telefone = $_POST['telefone'];
            $visivel = (int) $_POST['visivel'];
			$nome_arq = basename($_FILES['filefoto']['name']);
			$uploaddir ="arquivos/";
			$uploadfile = $uploaddir.$nome_arq;
			
			if(strstr($nome_arq, '.jpg') || strstr($nome_arq, '.png')){
				
				if(move_uploaded_file($_FILES['filefoto']['tmp_name'],$uploadfile)){
					
                        if($_POST['btnsalvar'] == "Salvar"){
                            if($_POST['visivel'] == "1"){
                                $sql = "update tbl_nossas_lojas set visivel = 0";
                                mysql_query($sql);
						      
                            }
                            $sql = "insert into tbl_nossas_lojas(imagem, titulo, visivel) values('".$uploadfile."','".$titulo."',".$visivel.")";

                            mysql_query($sql);

                            $select_id = "select * from tbl_nossas_lojas where titulo ='".$titulo."'";
                            $select = (mysql_query($select_id));
                            $rs=(mysql_fetch_array($select));

                            $sql1 = "insert into tbl_loja(endereco, telefone, idnl) values('".$endereco."','".$telefone."',".$rs['idnl'].")";
                            mysql_query($sql1);
                            header('location:adm_lojas.php');
                            
                        }elseif($_POST['btnsalvar'] == "Atualizar"){
                            if($_POST['visivel'] == "1"){
                                $sql = "update tbl_nossas_lojas set visivel = 0";
                                mysql_query($sql);
						      
                            }
                            $sql = "update tbl_nossas_lojas set imagem ='".$uploadfile."', titulo ='".$titulo."', visivel=".$visivel." where idnl=".$_SESSION['idnl'];

                            mysql_query($sql);

                            $select_id = "select * from tbl_nossas_lojas where titulo ='".$titulo."'";
                            $select = (mysql_query($select_id));
                            $rs=(mysql_fetch_array($select));

                            $sql1 = "update tbl_loja set endereco='".$endereco."', telefone='".$telefone."', visivel=".$visivel." idnl=".$rs['idnl']."";
                            mysql_query($sql1);
                            header('location:adm_lojas.php');
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
					<form name="frmsobre" method="post" enctype="multipart/form-data" action="adm_lojas_add.php">
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
                                    Titulo Nossas Lojas: 
                                </td>
                                <td>
                                    <input type="text" name="ttllojas" required value="<?php echo($_SESSION['titulo'])?>"/>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Endereço: 
                                </td>
                                <td>
                                     <input type="text" name="endereco" required value="<?php echo($_SESSION['endereco'])?>"/>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Telefone:
                                </td>
                                <td>
                                    <input type="text" name="telefone" value="<?php echo($_SESSION['telefone'])?>"required /><br>
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