<?php
	session_start();

	$conexion = mysql_connect("localhost","root","");
	error_reporting(0);
	mysql_select_db("proyecto",$conexion);

	function protect($v) {
	$v = mysql_real_escape_string($v);
	$v = htmlentities($v, ENT_QUOTES);
	$v = trim($v);
	return $v;
	}

		
	$nombre = protect($_POST["nombre"]);
	$password = protect($_POST["password"]);

	if ($_POST['nombre'] != "" && $_POST['password'] != "")
	{

	$consulta = mysql_query("SELECT * FROM usuario WHERE nombre='$nombre' AND password='$password'",$conexion); 
	$array_consulta = mysql_fetch_array($consulta);
	  
		  if($array_consulta == false) {

		  		?>
		  		<script type="text/javascript" language="javascript">
				alert("Usuario y/o contrasena inconrectos.");
				location.href="home.php";
				</script>
				<?php

			 
		  } else {

		  	if($_POST['nombre']=="Administrador"){
			  	$_SESSION['NombreAutenticado'] = $_POST['nombre'];
			  	$_SESSION['autenticados'] = "si";
				header("Location:home-adm.php");
			} else {
				$_SESSION['NombreAutenticado'] = $_POST['nombre'];
			  	$_SESSION['autenticados'] = "si";
                                $_SESSION['dispositivo'] = "pc";
			  	header("Location:home-priv.php");

			}
			  
		  }
	}

	else {
		$_SESSION['llene'] = "Llene los campos";
		header ("Location:index.html");
	}
	@mysql_close($conexion);

?>