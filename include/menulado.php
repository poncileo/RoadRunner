<div id="menulado">
    <ul id="lstmenulado">
         <?php
            $sql = "select * from tbl_categoria";
            $slct = mysql_query($sql);
            while($rs=mysql_fetch_array($slct)){
        ?>
        <li><a href="index.php?srcfilter=categoria&filter=<?php echo($rs['descricao']) ?>"><?php echo(utf8_encode($rs['descricao'])) ?></a>
            <div class="submenu">
            
                <ul id="sublist">
                <?php
                    $sql1 = "select * from tbl_subcategoria sc inner join tbl_cat_subcat cs on sc.idsubcategoria = cs.idsubcategoria where cs.idcategoria =".$rs['idcategoria']." order by sc.descricao desc";
                    $select = mysql_query($sql1);
                    while($res = mysql_fetch_array($select)){
                ?>
                    <li><a href="index.php?srcfilter=subcategoria&filter=<?php echo($res['descricao']) ?>"><?php echo(utf8_encode($res['descricao'])) ?></a></li>
                    <?php } ?>
                </ul>
            </div>
            
        </li>
        <?php } ?>
    </ul>
</div>