<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt">
<?php 
	session_start();
	require_once('include/dbconnect.php');
	
	if(isset($_POST['btnlogar'])){
		
		$outusuario = $_POST['usuario'];
		$outsenha = $_POST['senha'];
		
		CMSlogin($outusuario, $outsenha);
	}
	if(isset($_POST['btnenviar'])){
		
		$nome=$_POST['nome'];
		$telefone=$_POST['telefone'];
		$celular=$_POST['celular'];
		$email=$_POST['email'];
		$homepage=$_POST['homepage'];
		$facepage=$_POST['facepage'];
		$sugestao=$_POST['sugestao'];
		$infoprod=$_POST['infoprod'];
		$sexo=$_POST['sexo'];
		$profissao=$_POST['profissao'];
		
		$sql = "insert into dbroadrunner.tblcontato (nome, telefone, celular, email, homepage, facepage, sugestao, infoprod, sexo, profissao) values ('".$nome."','".$telefone."','".$celular."','".$email."','".$homepage."','".$facepage."','".$sugestao."','".$infoprod."','".$sexo."','".$profissao."')";
		mysql_query($sql);
	}
?>

	<head>
	   <link href="https://fonts.googleapis.com/css?family=Kavoon|Londrina+Solid" rel="stylesheet">
		<title>
			Road Runner Cross Bikes
		</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width" />
		<link rel="stylesheet" type="text/css" href="css/style.css" />
				
		<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
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
				<div id="formulario">
					<form name="frmcontato" method="post" action="contato.php">
						<table id="tabela">
							<tr >
								<td >
									*Nome: 
								</td>
								<td>
									<input type="text" name="nome" required /> 
								</td>
							</tr>
							<tr >
								<td >
									Telefone: 
								</td>
								<td>
									<input type="text" name="telefone" />
								</td>
							</tr>
							<tr >
								<td >
									*Celular: 
								</td>
								<td>
									<input type="text" name="celular" required /> 
								</td>
							</tr>
							<tr >
								<td >
									*E-mail: 
								</td>
								<td>
									<input type="email" name="email" required /> 
								</td>
							</tr>
							<tr >
								<td >
									Home Page: 
								</td>
								<td>
									<input type="text" name="homepage" /> 
								</td>
							</tr>
							<tr >
								<td >
									Link Facebook: 
								</td>
								<td>
									<input type="text" name="facepage" /> 
								</td>
							</tr>
							<tr >
								<td >
									Sugestão/Críticas: 
								</td>
								<td>
									<textarea name="sugestao" cols="40" rows="5" style="resize:none" ></textarea>
								</td>
							</tr>
							<tr >
								<td >
									Informações de Produtos: 
								</td>
								<td>
									<textarea name="infoprod" cols="40" rows="5" style="resize:none" ></textarea>
								</td>
							</tr>
							<tr >
								<td >
									*Sexo: 
								</td>
								<td>
									<input type="radio" name="sexo" value="M" checked /> Masculino
									<input type="radio" name="sexo" value="F" /> Feminino
								</td>
							</tr>
							<tr >
								<td >
									*Profissão: 
								</td>
								<td>
									<input type="text" name="profissao" required />
								</td>
							</tr>
							<tr>
								<td colspan="2"><input id="button" type="submit" name="btnenviar" value="Enviar" /></td>
							</tr>
						</table>
					</form>
				</div>
			</div>
		</div>
		<footer>
			Av. Senador Coyote, nº 666 - © Copyright 2016 Road Runner Cross Bikes SA - All Rights Reserved
		</footer>
	</body>
</html>