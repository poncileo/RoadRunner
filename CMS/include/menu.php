<?php
	
	$sql = "select descricao from tblnivel_usuario where idnivel=".$_SESSION['nivelUser'];
    $slct = mysql_query($sql);
    while($nivel = mysql_fetch_array($slct)){

        if($nivel['descricao'] == "Administrador de sistema"){

            $link_conteudo = "conteudo.php";
            $link_faleconosco = "faleconosco.php";
            $link_produtos = "adm_produtos.php";
            $link_usuarios = "usuarios.php";
            $user_img = "images/icon_userss.png";
            $prod_img = "images/icon_product.png";
            $contact_img = "images/icon_contato.png";
            $content_img = "images/icon_content.png";
        }
        else if($nivel['descricao'] == "Operador básico"){

            $link_conteudo = "conteudo.php";
            $link_faleconosco = "faleconosco.php";
            $link_produtos = "";
            $link_usuarios = "";
            $user_img = "images/icon_users_blocked.png";
            $prod_img = "images/icon_product_blocked.png";
            $contact_img = "images/icon_contato.png";
            $content_img = "images/icon_content.png";
        }
        else if($nivel['descricao'] == "Cataloguista"){

            $link_conteudo = "";
            $link_faleconosco = "";
            $link_produtos = "adm_produtos.php";
            $link_usuarios = "";
            $prod_img = "images/icon_product.png";
            $user_img = "images/icon_users_blocked.png";
            $contact_img = "images/icon_contato_blocked.png";
            $content_img = "images/icon_content_blocked.png";
        }
    }
?>
<nav>
    <div id="menu">
        <ul id="lstmenu">
            <li><a href="<?php echo($link_conteudo) ?>"><img src="<?php echo($content_img) ?>" alt="conteudos" /></a></li>
            <li><a href="<?php echo($link_faleconosco) ?>"><img src="<?php echo($contact_img) ?>" alt="fale conosco" /></a></li>
            <li><a href="<?php echo($link_produtos) ?>"><img src="<?php echo($prod_img) ?>" alt="produtos" /></a></li>
            <li><a href="<?php echo($link_usuarios) ?>"><img src="<?php echo($user_img) ?>" alt="usuarios" /></a></li>
        </ul>  
    </div>
    <div id="logout">
        <div id="logName">
            Bem-vindo, <?php echo($_SESSION['nomeUser']);?>
        </div>
        <div id="logBtn">
            <form name="frmlogout" method="post" action="home.php">
                <input type="submit" name="btnlogout" value="Logout"/>
            </form>
        </div>
    </div>	
</nav>