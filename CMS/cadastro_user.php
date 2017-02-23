<!DOCTYPE html>
<?php
    session_start();
    require_once('../include/dbconnect.php');
	$_SESSION['lvl'] = 0;
    $_SESSION['username'] = "";
    $_SESSION['name'] = "";
    $_SESSION['surname'] = "";
    $_SESSION['pass'] = "";
	
	if($_SESSION['nomeUser'] == ""){
		header('location:http://localhost/LeonardoPonciano/projeto_final/index.php');
	}else{
		if(isset($_POST['btnlogout'])){
			$_SESSION['nomeUser'] = "";
			header('location:http://localhost/LeonardoPonciano/projeto_final/index.php');
		}
		if($_SESSION['modo'] == "editar"){

			$id = $_SESSION['iduser']; 
			$sql="select * from tblusuario as u inner join tblnivel_usuario as nu on u.idnivel = nu.idnivel where idusuario=".$id;
			$select = mysql_query($sql);
			$rs=mysql_fetch_array($select);
			$_SESSION['username'] = $rs['usuario'];
			$_SESSION['name'] = $rs['nome'];
			$_SESSION['surname'] = $rs['sobrenome'];
			$_SESSION['pass'] = $rs['senha'];
			$_SESSION['lvl'] = $rs['idnivel'];
			$_SESSION['lvldesc'] = $rs['descricao'];
			$botao = "Atualizar";

		}else{
			$botao = "Salvar";
			
		}
		if(isset($_POST['btncadastrar'])){
				$nome=$_POST['nome'];
				$sobrenome=$_POST['sobrenome'];
				$usuario=$_POST['usuario'];
				$senha=$_POST['senha'];
				$nivel=$_POST['slctvalor'];
				if($_POST['btncadastrar'] == "Salvar"){
					$sql = "insert into tblusuario (nome, sobrenome, usuario, senha, idnivel) values ('".$nome."','".$sobrenome."','".$usuario."','".$senha."',".$nivel.")";
				
				}elseif($_POST['btncadastrar'] == "Atualizar"){
					$sql = "update tblusuario set nome='".$nome."',sobrenome='".$sobrenome."',usuario='".$usuario."',senha='".$senha."',idnivel=".$nivel." where idusuario =".$_SESSION['iduser'];
				}
				mysql_query($sql);
				header('location:usuarios.php');
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
                   <form name="frmcadastro" method="post" action="cadastro_user.php">
						<table id="formulario">
							<tr>
								<td>
									Nome:
								</td>
								<td>
									<input type="text" name="nome" value="<?php echo($_SESSION['name']);?>" required />
								</td>
							</tr>
							<tr>
								<td>
									Sobrenome:
								</td>
								<td>
									<input type="text" name="sobrenome" value="<?php echo($_SESSION['surname']);?>" required />
								</td>
							</tr>
							<tr>
								<td>
									Usuario:
								</td>
								<td>
									<input type="text" name="usuario" value="<?php echo($_SESSION['username']);?>" required />
								</td>
							</tr>
							<tr>
								<td>
									Senha:
								</td>
								<td>
									<input type="text" name="senha" value="<?php echo($_SESSION['pass']);?>" required />
								</td>
							</tr>
							<?php 
								$sql = "select * from tblnivel_usuario where idnivel <>".$_SESSION['lvl'];
								$select = (mysql_query($sql));								
							?>
							<tr>	
								<td>
									Nível de usuário:
								</td>
								<td>
                                    <select name="slctvalor">
                                        <?php 
                                            if($_SESSION['modo'] =="editar")
                                            {
                                                ?>
                                                <option value="<?php echo($_SESSION['lvl']) ?>" selected><?php echo(utf8_encode($_SESSION['lvldesc'])) ?></option>
                                                <?php
                                            }else{
                                            ?>
                                                <option selected>Selecionar..</option>

                                        <?php 
                                            }

                                            while ($rs=mysql_fetch_array($select))
                                            {

                                        ?>
                                            <option value="<?php echo($rs['idnivel']) ?>"> <?php echo(utf8_encode($rs['descricao'])) ?> </option>

                                        <?php 
                                            }
                                        ?>	
                                    </select>
								</td>						
							</tr>
							<tr>
								<td>
									<input type="submit" name="btncadastrar" value="<?php echo($botao)?>"/>
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