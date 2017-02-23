<?php
    require_once("include/dbconnect.php");
    $idproduto = $_GET['idproduto'];
    
    $sql = "select visitas from tbl_produto where idproduto =".$idproduto;
    $visitas = (int) mysql_fetch_assoc(mysql_query($sql, $conexao))["visitas"];
    $visitas = $visitas+1;
    $update = "update tbl_produto set visitas = ".$visitas." where idproduto =".$idproduto;
    mysql_query($update, $conexao);    
?>