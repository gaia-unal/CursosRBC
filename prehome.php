<?php
	session_start();
        $conexion = pg_connect("host='localhost' dbname='cursos_rbc' user='postgres' password='%froac$'");
	/*function protect($v) 
        {
            $v = mysql_real_escape_string($v);
            $v = htmlentities($v, ENT_QUOTES);
            $v = trim($v);
            return $v;
	}
        
	$nombre = protect($_POST["nombre"]);
	$password = protect($_POST["password"]);*/
    $nombre = $_POST["nombre"];
	$password = $_POST["password"];
        if ($_POST['nombre'] != "" && $_POST['password'] != "")
	{
            $consulta = pg_query($conexion, "SELECT * FROM usuario WHERE nombre='$nombre' AND password='$password'"); 
            $array_consulta = pg_fetch_array($consulta);
            if($array_consulta == false) {
                $_SESSION['error'] = "Login incorrecto";
                    header("Location:index.html");
            } else {
                if($_POST['nombre']=="admin"){
                    $_SESSION['NombreAutenticado'] = $_POST['nombre'];
                    $_SESSION['autenticados'] = "si";
                    $_SESSION['nombre'] = $nombre;
                    header("Location:home-adm.php");
		} else {
                    $_SESSION['NombreAutenticado'] = $_POST['nombre'];
                    $_SESSION['autenticados'] = "si";
                    $_SESSION['nombre'] = $nombre;
                    $_SESSION['dispositivo'] = $_POST['dispo'];
                    header("Location:home-priv.php");
                }
            }
	}
        else {
		$_SESSION['llene'] = "Llene los campos";
		header ("Location:index.html");
	}
	@pg_close($conexion);
?>