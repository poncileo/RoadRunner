<!DOCTYPE html>
<?php 
	session_start();
	require_once('include/dbconnect.php');
	
	if(isset($_POST['btnlogar'])){
		
		$outusuario = $_POST['usuario'];
		$outsenha = $_POST['senha'];
        CMSlogin($outusuario, $outsenha);
        
	}
?>
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt">
	<head>
        <link href="https://fonts.googleapis.com/css?family=Kavoon|Londrina+Solid" rel="stylesheet">
		<title>
			Road Runner Cross Bikes
		</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width" />
		<link rel="stylesheet" type="text/css" href="css/style.css" />
				
		<script src="JQUERY/jquery-3.1.0.min.js"></script>
		<script type="text/javascript">
			
		</script>
		
	</head>
	<body>
		<?php
            include("include/header.php");
        ?>
		<div id="principal">
			<div id="conteudo1">
				<div id="espaco">
				</div>
			</div>
			<div id="sociais">
				<div class="rsociais"><img src="images/facebook_icon.png" alt="Facebook" /></div>
				<div class="rsociais"><img src="images/Twitter_icon.png" alt="Twitter" /></div>
				<div class="rsociais"><img src="images/Instagram_icon.png" alt="Instagram" /></div>
			</div>
			<div id="conteudo2">
				<?php
                    include("include/menulado.php");
                ?>
				<div id="atleta">
					<?php 
						$sql = "select * from tbl_atleta_destaque where visivel = 1";
						$select = (mysql_query($sql));
						$rs=(mysql_fetch_array($select));
					?>
					<div id="ttlatleta"><?php echo($rs['nome'])?> - Atleta do Mês</div>
					<div id="descatleta">
						<div id="ftatleta"><img src="CMS/<?php echo($rs['foto']) ?>" alt="Atleta" /></div>
						<div id="ftfooter"><?php echo($rs['descfoto']) ?></div>
					</div>
					<div id="txtatleta">
						<?php echo($rs['trajetoria']) ?>
					</div>
				</div>
			</div>
		</div>
		<footer>
			Av. Senador Coyote, nº 666 - © Copyright 2016 Road Runner Cross Bikes SA - All Rights Reserved
		</footer>
	</body>
</html>