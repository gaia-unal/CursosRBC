<?php 
session_start();
if($_SESSION['autenticados'] != "si"){
        header("Location:home.php");
        exit();
}
 else {
     $nombre = $_SESSION['nombre'];
     $dispositivo = $_SESSION['dispositivo'];
}

 ?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
  <title>CVP | Guardar Estilo de Aprendizaje</title>
  <meta name="description" content="Plataforma para la generación de cursos virtuales personalziados" />
  <link href='http://fonts.googleapis.com/css?family=Raleway:300' rel='stylesheet' type='text/css'>
  <link type="text/css" href="../css/stylesheetHome.css"  rel="stylesheet"  />
  <link rel="shortcut icon" href="../images/icons/favicon.ico" type="image/x-ic"/>

  <link href='http://fonts.googleapis.com/css?family=Candal' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Nunito:300' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
  
  <link href="../css/skitter.styles.css" type="text/css" media="all" rel="stylesheet" />
  <script type="text/javascript" language="javascript" src="../js/jquery-1.6.3.min.js"></script>
  <script type="text/javascript" language="javascript" src="../js/jquery.easing.1.3.js"></script>
  <script type="text/javascript" language="javascript" src="../js/jquery.animate-colors-min.js"></script>
  <script type="text/javascript" language="javascript" src="../js/jquery.skitter.min.js"></script>
   
  <script type="text/javascript" language="javascript">
    $(document).ready(function(){
      $('.box_skitter_large').skitter({label: false, numbers: false, theme: 'square'});
      $('.box_skitter_small').skitter({label: false, numbers: false, interval: 1000, theme: 'clean'});
      $('.box_skitter_medium').css({width: 500, height: 200}).skitter({show_randomly: true, dots: true, interval: 4000, numbers_align: 'center', theme: 'round'});
      $('.box_skitter_normal').css({width: 400, height: 300}).skitter({animation: 'blind', interval: 2000, hideTools: true, theme: 'minimalist'});
    });
  </script>
</head>

<body>
    <header>
        <section id="subheader">
            <a href="../home-adm.php"><img src="../images/logo.png" alt="Litch"></img></a>
        <section id="contenedor_bot">
        <ul class="nav">
            <li><a href="../home-adm.php"><img style="width: 43px;" src="../images/icons/home.png" id="logo"/></a></li>
            <li><img src="../images/icons/settings.png"/>
                 <ul>
                    <li><a href="../logout.php">Cerrar sesi&oacuten</a></li>
                 </ul>
            </li>    
            <li><label for="switch"></label></li>
        </ul>
        </section>
        </section>
    </header>
    <section id ="wrap">
    <section id="main">
        <section id="menu_nav">
            <input type="checkbox" id="switch" checked>
            <nav>
               <ul>
                  <li id="menu"><p>Men&uacute</p></li>
                  <li><a href="../estu/miperfil.php"><img src="../images/icons/perfil.png"/></a></li>
                  <li><a href="../estu/miscursos.php"><img src="../images/icons/miscursos.png"/></a></li>
                  <li><a href="../estu/mihistorial.php"> <img src="../images/icons/mihistorial.png"/></a></li>
                  <li><a href="../estu/otros.php"><img src="../images/icons/otros.png"/></a></li>
                </ul>
              </nav>
        </section>
        <section id="contenido">
            <div id="consulta">
                <?php
                $conexion = pg_connect("host='localhost' dbname='cursos_rbc' user='postgres' password='%froac$'");
                if($conexion==FALSE){
                    header("Location:../error/error-conex.html");
                }
				$ii=0;
				$a=0;
				$aa=0;
				$aaa=0;
				$b=0;
				$bb=0;
				$bbb=0;
				$c=0;
				$cc=0;
				$ccc=0;
				$d=0;
				$dd=0;
				$ddd=0;
				while($ii<44){
                    if($_POST[$ii+1]=='a'){
                        $a=$a+1;
					}
                    else {
                        $aa=$aa+1;
                    }
					if($_POST[$ii+2]=='a'){
                        $b=$b+1;
					}
                    else {
                        $bb=$bb+1;
                    }
					if($_POST[$ii+3]=='a'){
                        $c=$c+1;
					}
                    else {
                        $cc=$cc+1;
                    }
					if($_POST[$ii+4]=='a'){
                        $d=$d+1;
					}
                    else {
                        $dd=$dd+1;
                    }
					$ii=$ii+4;
                }
				if($a>$aa){
                        $aaa=$a-$aa;
						$aaa=$aaa*-1;					
					}
                    else {
                        $aaa=$aa-$a;
                    }
				    if($b>$bb){
                        $bbb=$b-$bb;
						$bbb=$bbb*-1;					
					}
                    else {
                        $bbb=$bb-$b;
                    }
					if($c>$cc){
                        $ccc=$c-$cc;
						$ccc=$ccc*-1;					
					}
                    else {
                        $ccc=$cc-$c;
                    }
					if($d>$dd){
                        $ddd=$d-$dd;
						$ddd=$ddd*-1;					
					}
                    else {
                        $ddd=$dd-$d;
                    }
				echo "</br></br>ESTILO DE APRENDIZAJE</br>";
				
				echo "</br></br>ACTIVO - REFLEXIVO =$aaa";
				echo "</br>SENSORIAL - INTUITIVO =$bbb";
				echo "</br>VISUAL - VERBAL =$ccc";
				echo "</br>SECUENCIAL - GLOBAL=$ddd";
                
                $sql = "UPDATE estudiante
							SET activoreflexivo='$aaa', sensorialintuitivo='$bbb', visualverbal='$ccc', secuencialglobal='$ddd'
							WHERE estudiante.id_estudiante = '$nombre'";
                $result = pg_query($sql);
                if($result==FALSE){
                        echo "<br> Hay errores en la consulta SQL";
                }
                else {
                    echo"<h2>Estilo de aprendizaje  Registrado Correctamente!!!</h2><br/>";
                }
            @pg_close($conexion);?>
             </div>
        </section>
        <aside>
            <section id="registro">
                <form id="forml" name="forml" method="post" action="registro.php.php">
                    <h3>Redes sociales</h3>
                    <a href=""><img src="../images/icons/facebook.png" alt="facebook"/></a>
                    <a href=""><img src="../images/icons/gmail.png" alt="gmail"/></a>
                    <a href=""><img src="../images/icons/twitter.png" alt="twitter"></a>
                </form>
            </section>
        </aside>
      </section>
  </section>
  <footer><p>Copyright &copy 2014 | Todos los derechos reservados</p></footer>
</body>
</html>