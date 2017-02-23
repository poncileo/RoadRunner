<?php
    /*ini_set('display_errors',1);
    ini_set('display_startup_errors',1);
    error_reporting(E_ALL);*/
	$conexao = mysql_connect('localhost','root','L30#p0nc1');
    mysql_select_db('dbroadrunner');
    /*$conexao = mysql_connect('192.168.0.2','20162pc32','senai127');
    mysql_select_db('db20162pc32');*/

    function CMSlogin($inlogin, $insenha){
        
        $usuario = $inlogin;
		$senha = $insenha;
		
		$result = mysql_query("select u.*, nu.idnivel as niveluser from tblusuario u inner join tblnivel_usuario nu on u.idnivel = nu.idnivel where usuario = '".$usuario."' and senha = '".$senha."'");
		
        if(mysql_num_rows ($result) > 0 ){
			$rs = mysql_fetch_array($result);
			$_SESSION['nomeUser'] = $rs['nome'];
            $_SESSION['id'] = $rs['idusuario'];
			$_SESSION['nivelUser'] = $rs['niveluser'];
			header('location:CMS/home.php');
		}
		else{
            
			unset ($_SESSION['usuario']);
			unset ($_SESSION['senha']);
			function phpAlert($msg) {
				echo '<script type="text/javascript">alert("'.$msg.'")</script>';
			}
			phpAlert("Usuário e/ou senha incorretos!!"); 
		}
    }
    function CMSvalidation(){
        if($_SESSION['nomeUser'] == ""){
            //header('location: http://www.pc32.com.br');
            header('location: ../index.php');
        }
    }
    function CMSlogout(){
        unset($_SESSION['nomeUser']);
        
        //header('location: http://www.pc32.com.br');
        header('location: ../index.php');
    }
?>