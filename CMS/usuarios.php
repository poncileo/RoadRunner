<!DOCTYPE html>
<?php
    session_start();
    require_once('../include/dbconnect.php');
    $_SESSION['modo'] = "";
	
	if($_SESSION['nomeUser'] == ""){
		
		CMSvalidation();
		
	}else{
		
		if(isset($_POST['btnlogout'])){
			CMSlogout();
		}
		if(isset($_GET['modo'])){
			$modo = $_GET['modo'];
			
			if($modo == "editar"){
				$cod  =$_GET['codigo'];
				$_SESSION['iduser'] = $cod;
				$_SESSION['modo'] = "editar";
				header('location:cadastro_user.php');
			}elseif($modo == "excluir"){
				$cod=$_GET['codigo'];
				$sql = "delete from tblusuario where idusuario =".$cod;
				mysql_query($sql);
				header('location:usuarios.php');
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
                    <div id="add"><a href="cadastro_user.php"><img src="images/cadastro.png"/></a></div>
					<div id="ttl">Usuários</div>
					<div class="users">
						<div class="item_user">Usuário</div>
						<div class="item_user">Nome</div>
						<div class="item_user">Nível</div>
						<div class="item_user">Opções</div>
					</div>
					<?php 
						$sql = "select * from tblusuario as u inner join tblnivel_usuario as nu on u.idnivel = nu.idnivel";
						$select = (mysql_query($sql));						
						while($rs=mysql_fetch_array($select)) {
					?>
					<div class="users">
						<div class="item_user"><?php echo($rs['usuario']);?></div>
						<div class="item_user"><?php echo($rs['nome']);?> <?php echo($rs['sobrenome'])?></div>
						<div class="item_user"><?php echo(utf8_encode($rs['descricao']));?></div>
						<div class="item_user">
							<div class="option"><a href="usuarios.php?modo=editar&codigo=<?php echo($rs['idusuario']) ?>">Editar</a></div>
							<div class="option"><a href="usuarios.php?modo=excluir&codigo=<?php echo($rs['idusuario']) ?>">Excluir</a></div>
							
						</div>
						
					</div>
						<?php } ?>
                </div>
            </div>
            <footer>
            </footer>
        </div> 
    </body>
</html>