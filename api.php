<?php
	require_once('include/dbconnect.php');
	
	$sql= "select p.*, c.descricao as categoria from tbl_produto p inner join tbl_cat_prod cp on cp.idproduto = p.idproduto inner join tbl_categoria c on cp.idcategoria = c.idcategoria";
	$slct = mysql_query($sql);
	$lista=[];
	while($rs=mysql_fetch_array($slct)){
		$lista[] = array('id' => $rs['idproduto'],
						'imagem' => $rs['imagem'],
						'nome' => $rs['nome'],
						'descricao' => $rs['descricao'],
						'preco' => $rs['preco'],
                        'categoria' => $rs['categoria']); 
		 
	}
	echo json_encode($lista);
?>