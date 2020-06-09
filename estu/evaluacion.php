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
  <title>CVP | Evaluación</title>
  <meta name="description" content="Pagina de venta de variedad de prendas de vestir" />
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
          <a href="../home-priv.php"><img src="../images/logo.png" alt="Litch"></img></a>
      <section id="contenedor_bot">
        <ul class="nav">
            <li><a href="../home-priv.php"><img style="width: 43px;" src="../images/icons/home.png" id="logo"/></a></li>
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
                <section id="form-producto">
                <form id="forml-prod" name="forml-prod" method="post" action="../estu/respEvaluacion.php">
                    <table width="100%">
                    <br/>
                    <br/>
                <?php 
                $id_oe=$_GET['id_oe'];
                $id_curso=$_GET['id_curso'];
                $conexion = pg_connect("host='localhost' dbname='cursos_rbc' user='postgres' password='%froac$'");
                if($conexion==FALSE){
                    header("Location:../error/error-conex.html");
                }
                $sql = "SELECT * FROM evaluacion, objetivoeducativo WHERE evaluacion.id_oe = objetivoeducativo.id_oe AND evaluacion.id_oe='$id_oe'";
                $result = pg_query($sql);

                if($result==FALSE){
                        echo "<br> Hay errores en la consulta SQL";
                }
                while($row= pg_fetch_array($result))	{
                    echo "<h3>Evaluación $row[id_oe]: $row[descripcionoe]</h3>
                    <br/>
                    <br/>
                    <tr><td><b>$row[pregunta]</b><br/>
                    <input type='radio' name='eval' value='a'><b>a) </b>$row[a] <br/>
                    <input type='radio' name='eval' value='b'><b>b) </b>$row[b] <br/>
                    <input type='radio' name='eval' value='c'><b>c) </b>$row[c] <br/>
                    <input type='radio' name='eval' value='d'><b>d) </b>$row[d] <br/>
                    <input type='hidden' name='reseval' value='$row[respuesta]'>
                    <input type='hidden' name='id_oe' value='$id_oe'>
                    <input type='hidden' name='id_curso' value='$id_curso'>
                        </td></tr>";
                }
                
                @pg_close($conexion);?>
                </table><br/>
                <button type="submit" name="mostrar" id="mostrar">Enviar Respuesta</button>
                </form>
                </section>
                </div>
         </section> <!-- end contenido -->
         <aside>
            <section id="registro">
                <form id="forml" name="forml" method="post" action="../registro.php">
                    <h3>Redes sociales</h3>
                    <a href=""><img src="../images/icons/facebook.png" alt="facebook"/></a>
                    <a href=""><img src="../images/icons/gmail.png" alt="gmail"/></a>
                    <a href=""><img src="../images/icons/twitter.png" alt="twitter"></a>
                </form>
            </section>
        </aside>
         </section> <!-- end main -->
		</section> <!-- end wrap -->
		<footer><p>Copyright &copy 2014 | Todos los derechos reservados</p></footer>
</body>
</html>