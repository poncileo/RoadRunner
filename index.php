<!DOCTYPE html>
<?php
    session_start();
	require_once('include/dbconnect.php');
	$_SESSION['filter'] = "select * from tbl_produto order by rand()";

	if(isset($_POST['btnlogar'])){
		
		$outusuario = $_POST['usuario'];
		$outsenha = $_POST['senha'];
        CMSlogin($outusuario, $outsenha);
        
	}
    if(isset($_GET['srcfilter'])){
        $srcfilter = $_GET['srcfilter'];
        
        if($srcfilter == "categoria"){
            
            $filter = $_GET['filter'];
            
            $sqlfilter = "select * from tbl_produto p inner join tbl_cat_prod cp on p.idproduto = cp.idproduto inner join tbl_categoria c on cp.idcategoria = c.idcategoria where c.descricao ='".$filter."'";
            $_SESSION['filter'] = $sqlfilter;
            
        }elseif($srcfilter == "subcategoria"){
            
            $filter = $_GET['filter'];
                                   
            $sqlfilter = "select * from tbl_produto p inner join tbl_subcat_prod sp on p.idproduto = sp.idproduto inner join tbl_subcategoria s on sp.idsubcategoria = s.idsubcategoria where s.descricao = '".$filter."'";
            			
            $_SESSION['filter'] = $sqlfilter;

        }
       
    }
    if(isset($_POST['btnpesquisar'])){
            $flt_pesquisa = $_POST['flt_pesquisa'];
            
            $filter = "select * from tbl_produto where nome like'%".$flt_pesquisa."%' or descricao like'%".$flt_pesquisa."%'";
            
            $_SESSION['filter'] = $filter;
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
                
                var btn = document.getElementsByClassName('details_opener');
                    
                    $(btn).click(function(){
                        var lojas = $(this).parents(".itens_content")[0];
                        var dialog = lojas.querySelectorAll(".dialog")[0];
                        dialog.style.display = "flex";
                        $(dialog).addClass("active_dialog");
                        
                        var box_item = $(this).parents(".item")[0];
                        var id_produto = box_item.getAttribute("data-id");
                        
                        var url = "incrementar_visita.php?idproduto=" + id_produto;
                        
                        $.get(url, function(data) {
                            console.log(data);
                        });
                        
                    });
                                
                    window.onclick = function(event){
                        var modal = document.getElementsByClassName('active_dialog')[0];
                        
                        if(event.target == modal){
                            modal.style.display = "none";
                            $(modal).removeClass("active_dialog");
                        }
                    }
					var span = $(".close");
					$(span).click( function(){
						var modal = document.getElementsByClassName('active_dialog')[0];
						modal.style.display = "none";
						$(modal).removeClass("active_dialog");
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
						<li><img src="images/image1.jpg" alt="image1" /></li>
						<li><img src="images/image2.jpg" alt="image2" /></li>
						<li><img src="images/image3.jpg" alt="image3" /></li>
						<li><img src="images/image4.jpg" alt="image4" /></li>
					</ul>  
					
				</div>
                <div id="img_mobile">
                    <img src=" " />
                </div>
			</div>
			<div id="sociais">
				<div class="rsociais"><img src="images/facebook_icon.png" alt="Facebook" /></div>
				<div class="rsociais"><img src="images/Twitter_icon.png" alt="Twitter" /></div>
				<div class="rsociais"><img src="images/Instagram_icon.png" alt="Instagram" /></div>
			</div>
			<div id="conteudo2">
				<?php
                    include("include/menulado.php")
                ?>
				<div id="galeria">
                    <div class="pesquisa">
                        <form name="frmpesquisa" method="post" id="frm_pesquisa">
                            <input type="text" name="flt_pesquisa" id="inpt_pesquisa"/>
                            <input type="submit" name="btnpesquisar" value="" id="btn_pesquisa"/>
                        </form>
                    </div>
                   
					<div class="itens">
                         <?php
                            $select = mysql_query($_SESSION['filter']);
                            while($rs=mysql_fetch_array($select)){
                        ?>
                        <div class="itens_content">
                            <div class="item" data-id="<?php echo $rs["idproduto"]; ?>">
                                <div class="descimage">
                                    <img src="CMS/<?php echo($rs['imagem']) ?>" alt="bike" />
                                </div>
                                <div class="desctxt">
                                    <p><span class="nomeitem"><?php echo($rs['nome']) ?></span><br />
                                    <?php echo($rs['descricao']) ?><br />
                                    R$ <?php echo($rs['preco']) ?></p>
                                </div>
                                <div class="detalhes">
                                    <div class="alinhamentodtls"><button id="opener" class="details_opener">Detalhes</button></div>
                                </div>

                            </div>
                            <div id="dialog" class="dialog">
                                <div id="modal" class="modal">
                                    <div class="modal_prod">
                                        <div class="close"><span>X</span></div>
                                        <div class="prod_img">
                                            <img src="CMS/<?php echo($rs['imagem']) ?>" />
                                        </div>
                                        <div class="prod_ttl">
                                            <?php echo(utf8_encode($rs['nome']))?>
                                        </div>
                                        <div class="prod_desc">
                                            <?php echo(utf8_encode($rs['descricao']))?>
                                        </div>
                                        <div class="prod_preco">
                                            R$ <?php echo($rs['preco'])?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
					</div>
				</div>
			</div>
		</div>
		<footer>
			Av. Senador Coyote, nº 666 - © Copyright 2016 Road Runner Cross Bikes SA - All Rights Reserved
		</footer>
	</body>
</html>