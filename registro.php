<?php
        session_start();
        error_reporting(0);
        
        
        $conexion = pg_connect("host='localhost' dbname='cursos_rbc' user='postgres' password='%froac$'");
        $nombre = $_POST["nombre"];
	    $password = $_POST["password"];
        $repassword = $_POST["repassword"];
        $nombreEstu = $_POST["nombreEstu"];
        $email = $_POST["email"];
        $genero = $_POST["genero"];
        $language = $_POST["language"];
                
        if (strlen($nombre)<4) {

                header("Location:error2.php");
                exit();
        }

        $GetUser = mysql_query("SELECT * FROM usuario WHERE nombre = '$nombre'");
        if(mysql_num_rows($GetUser) > 0)
        {
                header("Location:error3.php");
                $Fail = true;
        }

        if (strlen($password)<4) {

                header("Location:error4.php");
        }

        if (strlen($email)<4) {

                header("Location:error5.php");
        }

        if($repassword != $password ) {

                header("Location:error6.php");
        }

        if($Fail == false)
        {
            $registrar = pg_query("INSERT INTO usuario VALUES('$nombre', '$password')") 
                or die("Ha ocurrido un error en el registro &iexclIntentalo de nuevo m&aacutes tarde! 1");
            $registrar2 = pg_query("INSERT INTO estudiante(id_estudiante, nombre, email, genero, idiomapreferencia) 
                                    VALUES('$nombre', '$nombreEstu', '$email', '$genero', '$language')") 
                or die("Ha ocurrido un error en el registro &iexclIntentalo de nuevo m&aacutes tarde! 2");
            
               // if (($registrar2 == 1)&&($registrar == 1)) {

                        $_SESSION['NombreAutenticado'] = $_POST['nombre'];
                        $_SESSION['autenticados'] = "si";
                        $_SESSION['nombre'] = $nombre
						$_SESSION['dispositivo'] = "pc";
                        header("Location:estu/test.php");

                //}
        }
	@pg_close($conexion);
?>