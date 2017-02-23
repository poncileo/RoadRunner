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
			
			jQuery(document).ready(function ($) {
								
				var slideCount = $('#slider ul li').length;
				var slideWidth = $('#slider ul li').width();
				var slideHeight = $('#slider ul li').height();
				var sliderUlWidth = slideCount * slideWidth;
				
				$('#slider').css({ width: slideWidth, height: slideHeight });
				
				$('#slider ul').css({ width: sliderUlWidth, marginLeft: - slideWidth });
				
				$('#slider ul li:last-child').prependTo('#slider ul');

				function moveLeft() {
					$('#slider ul').animate({
						left: + slideWidth
					}, 200, function () {
						$('#slider ul li:last-child').prependTo('#slider ul');
						$('#slider ul').css('left', '');
					});
				};

				function moveRight() {
					$('#slider ul').animate({
						left: - slideWidth
					}, 200, function () {
						$('#slider ul li:first-child').appendTo('#slider ul');
						$('#slider ul').css('left', '');
					});
				};

				$('a.control_prev').click(function () {
					moveLeft();
				});

				$('a.control_next').click(function () {
					moveRight();
				});
				
				 $(function(){
					setInterval(function () {
						moveRight();
					}, 3000);
				});
			});    

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
				<div id="slider">
					<a href="#" class="control_next">▶</a>
					<a href="#" class="control_prev">◀</a>
					<ul>
						<li><img src="images/image5.jpg" alt="image1" /></li>
						<li><img src="images/image2.jpg" alt="image2" /></li>
						<li><img src="images/image3.jpg" alt="image3" /></li>
						<li><img src="images/image4.jpg" alt="image4" /></li>
					</ul>  
					
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
						<?php
							$sql = "select * from tblsobre_loja where visivel = 1";
							$select = (mysql_query($sql));
							$rs=(mysql_fetch_array($select));
						?>
				<div id="sobrealoja">
					<div id="logoloja">
						
						<img src="CMS/<?php echo($rs['imagem'])?>" alt="logo" />
					</div>
					<div id="historialoja">
						<div id="ttlhistoria">
							<?php echo($rs['titulo']) ?>
						</div>
						<div id="txthistoria">
							<?php echo($rs['texto']) ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<footer>
			Av. Senador Coyote, nº 666 - © Copyright 2016 Road Runner Cross Bikes SA - All Rights Reserved
		</footer>
	</body>
</html>