<?php
		session_start();
		error_reporting(0);
		$conexion = @mysql_connect("localhost","root","");
		mysql_select_db("proyecto",$conexion);

		function protect($v) {
			$v = mysql_real_escape_string($v);
			$v = htmlentities($v, ENT_QUOTES);
			$v = trim($v);
			return $v;
		}
				
		$nombre = protect($_POST["nombre"]);
		$cedula = protect($_POST["cedula"]);
		$numero = protect($_POST["numero"]);
		$email = protect($_POST["email"]);
		$password = protect($_POST["password"]);
		$repassword = protect($_POST["repassword"]);

		if (strlen($nombre)<4) {

			?>
			<script type="text/javascript" language="javascript">
				alert("Usuario y/o contraseña inconrectos.");
				location.href="home.php";
			</script>
			<?php
		}

		$GetUser = mysql_query("SELECT * FROM usuario WHERE nombre = '$nombre'");
		if(mysql_num_rows($GetUser) > 0)
		{
			?>
			<script type="text/javascript" language="javascript">
				alert("El nombre de Usuario ya existe, porfavor elige otro.");
				location.href="home.php";
			</script>
			<?php
		}

		if (strlen($password)<4) {

			?>
			<script type="text/javascript" language="javascript">
				alert("Password debe tener mas de cuatro caracteres.");
				location.href="home.php";
			</script>
			<?php
		}

		if (strlen($email)<4) {

			?>
			<script type="text/javascript" language="javascript">
				alert("Correo debe tener mas de cuatro caracteres.");
				location.href="home.php";
			</script>
			<?php
		}

		if($repassword != $password ) {

			?>
			<script type="text/javascript" language="javascript">
				alert("Las contraseñas no coinciden.");
				location.href="home.php";
			</script>
			<?php
		}

		if($Fail == false)	{

			$registrar = mysql_query("INSERT INTO usuario (nombre,cedula,numero,email,password) 
				VALUES('$nombre','$cedula','$numero','$email','$password')", $conexion) 
			or die("Ha ocurrido un error en el registro &iexclIntentalo de nuevo m&aacutes tarde!");

			if ($registrar == 1) {

				$_SESSION['NombreAutenticado'] = $_POST['nombre'];
		  		$_SESSION['autenticados'] = "si";				
				header("Location:bienvenido.php");

			}
		}
?>