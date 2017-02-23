<!DOCTYPE html>
<?php
    session_start();
    require_once('../include/dbconnect.php');
	$_SESSION['nome'] = "";
    $_SESSION['descricao'] = "";
    $_SESSION['preco'] = "";
    $_SESSION['promocao'] = "";
	$codcategoria = 0;
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
			$_SESSION['descricao'] = $rs['descricao'];
			$_SESSION['preco'] = $rs['preco'];
			$_SESSION['promocao'] = $rs['promocao'];
            
            $sql = "select * from tbl_categoria c inner join tbl_cat_prod cp on c.idcategoria = cp.idcategoria where cp.idproduto=".$idproduto;
            $select = mysql_query($sql);
            $res = mysql_fetch_array($select);
            
            $_SESSION['idcateg'] = $res['idcategoria'];
			$_SESSION['catdesc'] = $res['descricao'];
            
			$botao= "Atualizar";
		}
		else{
			$botao = "Salvar";
		}
		if(isset($_POST['btnsalvar'])){
            
			$produto = $_POST['produto'];
			$descricao = $_POST['descricao'];
			$preco = $_POST['preco'];
			$desconto = $_POST['desconto'];
            $categoria = $_GET['codcategoria'];
            $subcategoria = $_POST['slctsubcat'];
			$nome_arq = basename($_FILES['filefoto']['name']);
			$uploaddir ="arquivos/";
			$uploadfile = $uploaddir.$nome_arq;
			
				if(strstr($nome_arq, '.jpg') || strstr($nome_arq, '.png')){
					
					if(move_uploaded_file($_FILES['filefoto']['tmp_name'],$uploadfile)){
                        
                        if($_POST['btnsalvar'] == "Salvar"){
                            
						  $sql = "insert into tbl_produto(imagem, nome, descricao, preco, promocao, visitas) values('".$uploadfile."','".$produto."','".$descricao."',".$preco.",".$desconto.", 0)";
                            
                            mysql_query($sql);
                            
                            $sql1 = "select * from tbl_produto where nome='".$produto."'";
                        
                            $slct = mysql_query($sql1);
                            $res = mysql_fetch_array($slct);
                            $sql2 = "insert into tbl_cat_prod(idcategoria, idproduto) values(".$categoria.",".$res['idproduto'].")";
                            $sql3 = "insert into tbl_subcat_prod(idsubcategoria, idproduto) values(".$subcategoria.",".$res['idproduto'].")";
                            
                            
                        }elseif($_POST['btnsalvar'] == "Atualizar"){
                            
                            $sql = "update tbl_produto set imagem='".$uploadfile."',nome='".$produto."',descricao='".$descricao."',preco=".$preco.",promocao=".$desconto." where idproduto=".$_SESSION['idproduto'];
                            
                            mysql_query($sql);
                            
                            $sql2 = "update tbl_cat_prod set idcategoria=".$categoria." where idproduto=".$_SESSION['idproduto'];
                            
                            $sql3 = "update tbl_subcat_prod set idsubcategoria=".$subcategoria." where idproduto=".$_SESSION['idproduto'];
                        }
                         mysql_query($sql2);
                         mysql_query($sql3);
                         header("location:adm_produtos_view.php");
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
			                    
             function MM_jumpMenu(targ,selObj,restore){ //v3.0

                eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");

                 if (restore) selObj.selectedIndex=0;

             }
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
                    <?php
                        if(isset($_GET['nomecat'])){
                                $codcategoria = $_GET['jumpcod'];
                            }
                    ?>
					<form name="frmsobre" method="post" enctype="multipart/form-data" action="adm_produtos_add.php?codcategoria=<?php echo($codcategoria) ?>">
                        <table>
                            <tr>
                                <td>
                                    <?php
                            
                                        $sql = "select * from tbl_categoria where idcategoria<>".$codcategoria;
                                        $select = mysql_query($sql);

                                    ?>
                                    Categoria: 
                                </td>
                                <td>
                                    <select name="slctvalor"  onChange="MM_jumpMenu('parent',this,0)">
                                        
                                        <?php      
                                            if($_SESSION['modo'] =="editar")
                                            {
                                                ?>
                                                <option value="adm_produtos_add.php?jumpcod=<?php echo($_SESSION['idcateg']) ?>" selected><?php echo($_SESSION['catdesc']) ?></option>
                                                <?php echo($_SESSION['catdesc'])?>
                                                <?php
                                            }else{
                                            ?>
                                                <?php
                                                if(isset($_GET['nomecat'])){
                                                ?>    
                                                    <option value="adm_produtos_add.php?jumpcod=<?php echo($_GET['jumpcod']) ?>&nomecat=<?php echo($$_GET['nomecat']) ?>" selected> <?php echo($_GET['nomecat']) ?> </option>
                                            <?php }else{ ?>
                                                <option selected>Selecionar..</option>
                                            <?php } ?>
                                        <?php 
                                            }

                                            while ($rs=mysql_fetch_array($select))
                                            {

                                        ?>
                                            <option value="adm_produtos_add.php?jumpcod=<?php echo($rs['idcategoria']) ?>&nomecat=<?php echo($rs['descricao']) ?>"> <?php echo($rs['descricao']) ?> </option>

                                        <?php 
                                            }
                                        ?>	
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Subcategoria:
                                </td>
                                <td>
                                    <select name="slctsubcat">
                                        <?php
                                            if(isset($_GET['jumpcod'])){
                                                $jumpcod = $_GET['jumpcod'];
                                                
                                                $sqll = "select sc.idsubcategoria, sc.descricao from tbl_subcategoria sc inner join tbl_cat_subcat cs on sc.idsubcategoria = cs.idsubcategoria inner join tbl_categoria c on cs.idcategoria = c.idcategoria where c.idcategoria =".$jumpcod;
                                                
                                                $slct = mysql_query($sqll);
                                                while($r=mysql_fetch_array($slct)){
                                                    
                                            
                                        ?>
                                        <option value="<?php echo($r['idsubcategoria'])?>"><?php echo $r['descricao']?></option>
                                        <?php   
                                            
                                                } 
                                            }?>
                                    </select>
                                </td>
                            </tr>
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
                                    Nome do produto: 
                                </td>
                                <td>
                                    <input type="text" name="produto" value="<?php echo($_SESSION['nome'])?>" required />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Descrição do produto: 
                                </td>
                                <td>
                                    <textarea name="descricao" cols="40" rows="5" style="resize:none" required><?php echo($_SESSION['descricao']) ?></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Preço do produto: 
                                </td>
                                <td>
                                    <input type="text" name="preco" value="<?php echo($_SESSION['preco']) ?>" required />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Porcentagem de desconto:
                                </td>                       
                                <td>
                                    <input type="text" name="desconto" value="<?php echo($_SESSION['promocao'])?>" required />
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