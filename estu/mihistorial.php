<?php 
session_start();
if($_SESSION['autenticados'] != "si"){
        header("Location:home.php");
        exit();
}
 else {
     $nombre = $_SESSION['nombre'];
}
   
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
  <title>CVP | Mis Cursos</title>
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
                <h3>Mi historial</h3>
                <section id="form-producto">
                <form id="forml-prod" name="forml-prod" method="post" action="plancursoh.php">
                    <p>Seleccione curso:</p>
                    <?php 
                        $conexion = pg_connect("host='localhost' dbname='cursos_rbc' user='postgres' password='%froac$'");
                        if($conexion==FALSE){
                            header("Location:../error/error-conex.html");
                        }
                        $sql = "SELECT curso.id_curso as id, curso.descripcion as descripcion FROM curso, cursoEstudiante WHERE curso.id_curso = cursoEstudiante.id_curso AND id_estudiante='$nombre'";
                        $result = pg_query($sql);

                        if($result==FALSE){
                                echo "<br> Hay errores en la consulta SQL";
                        } 
                        echo "<SELECT id=curso name=curso>
                        <OPTION value=#>-- Seleccione -- </OPTION>";

                        while($row= pg_fetch_array($result))	{
                         echo "<OPTION value=$row[id]>$row[descripcion]</OPTION>";
                        }

                        echo "</SELECT>";
                        @pg_close($conexion);?>
                    <br/>
                    <br/>
                    <button type="submit" name="mostrar" id="mostrar">Ver historial</button>
                    </form>
                    </section>
                            <hr/>
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